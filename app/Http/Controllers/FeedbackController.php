<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Feedback;
use App\Models\User;
use App\Models\API;
use App\Models\Title;
use App\Models\Place;
use App\Models\Category;
use App\Models\Zone;
use Auth;

class FeedbackController extends Controller
{
    public function add_view(Request $request)
    {
        $data['branches'] = Branch::whereNot('status', '=', 'close')->get();
        $data['zones'] = Zone::whereNot('status', 'close')->get();
        $data['places'] = Place::where('status', 'exist')->get();
        $data['categories'] = Category::whereNot('status', 'close')->get();
        $data['titles'] = Title::whereNot('status', 'close')->get();

        return view('feedback/add', $data);
    }
    //add new feedback
    public function add(Request $request)
    {
        // valdiate
        $request->validate([
            'branch_id' => 'required',
            'zone' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg',
            'category' => 'required',
            'place' => 'required',
            'title' => 'required',
            'description' => 'required',
            'feedbackTo' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $destinationPath = public_path('images');
        $image->move($destinationPath, $imageName); //images is the location

        $addFeedback = Feedback::create([
            'user_id' => Auth::id(),
            'branch_id' => $request->branch_id,
            'zone_id' => $request->zone,
            'place_id' => $request->place,
            'category_id' => $request->category,
            'title_id' => $request->title,
            'feedback_to' => $request->feedbackTo, //0 is Emergency 1 is General
            'description' => $request->description,
            'status' => 0,
            'image' => $imageName,
        ]);
        //send notification to whatsapp
        if (API::find(1) != null) {
            $api = API::find(1)->first();
            $apiKey = $api->api;
            $engZoneName = $addFeedback->zones->e_name ? $addFeedback->zones->e_name : ' ';
            $engPlaceName = $addFeedback->places->e_name ? $addFeedback->places->e_name : ' ';
            $engCategoryName = $addFeedback->categories->e_name ? $addFeedback->categories->e_name : ' ';
            $engTitleName = $addFeedback->titles->e_name ? $addFeedback->titles->e_name : ' ';
            $FullMessage = 'Feedback Case ID: ' . $addFeedback->id . "\nBranch: " . $addFeedback->branches->name . "\nZone: " . $addFeedback->zones->c_name . ' ' . $engZoneName . "\nPlace:" . $addFeedback->places->c_name . ' ' . $engPlaceName . "\nCategory: " . $addFeedback->categories->c_name . ' ' . $engCategoryName . "\nTitle: " . $addFeedback->titles->c_name . ' ' . $engTitleName . "\nFeedback To: " . $addFeedback->feedback_to . "\nDescription: " . $request->description;

            if ($addFeedback->feedback_to === 'Housekeeping') {
                $users = User::where('role', 'Admin')
                    ->orWhere('role', 'Housekeep')
                    ->get();
                foreach ($users as $user) {
                    $data = [
                        'phone_number' => $user->phone,
                        'message' => $FullMessage,
                    ];

                    $response = \Illuminate\Support\Facades\Http::accept('application/json')
                        ->withToken($apiKey)
                        ->post('https://onsend.io/api/v1/send', $data);

                    //dump($response->body());//check only
                }
            } else {
                $users = User::where('role', 'Admin')
                    ->orWhere('role', 'Agent')
                    ->get();
                foreach ($users as $user) {
                    $data = [
                        'phone_number' => $user->phone,
                        'message' => $FullMessage,
                    ];

                    $response = \Illuminate\Support\Facades\Http::accept('application/json')
                        ->withToken($apiKey)
                        ->post('https://onsend.io/api/v1/send', $data);

                    //dump($response->body());//check only
                }
            }
        }

        return redirect()->route('feedback_index');
    }
    public function index()
    {
        $data['feedbacks'] = Feedback::all()->where('status', '!=', 3);
        $data['branches'] = [];
        $data['levels'] = [];
        $data['statuses'] = [0,1,2,3];

        foreach ($data['feedbacks'] as $feedback) {
            array_push($data['branches'], $feedback->branches->name);
            // $data['branches'] = $feedback->branches->name;
            // $data['levels']= $feedback->feedback_to;
            array_push($data['levels'], $feedback->feedback_to);

            //later change to status
            //$data['place']  = $feedback->places->c_name;
        }

        $data['branches'] = array_unique($data['branches']);
        $data['levels'] = array_unique($data['levels']);

        return view('feedback/index', $data);
    }
    public function myFeedback()
    {
        $feedbacks = Feedback::where([['user_id', Auth::id()], ['status', '!=', 3]])->get();
        return view('feedback/myFeedback')->with('feedbacks', $feedbacks);
    }
    public function feedbackIndexComplete()
    {
        $data['feedbacks']= Feedback::all()->where('status', 3);
        $data['branches'] = [];
        $data['levels'] = [];
        $data['statuses'] = [0,1,2,3];

        foreach ($data['feedbacks'] as $feedback) {
            array_push($data['branches'], $feedback->branches->name);
            // $data['branches'] = $feedback->branches->name;
            // $data['levels']= $feedback->feedback_to;
            array_push($data['levels'], $feedback->feedback_to);

            //later change to status
            //$data['place']  = $feedback->places->c_name;
        }

        $data['branches'] = array_unique($data['branches']);
        $data['levels'] = array_unique($data['levels']);

        return view('feedback/index', $data);
    }
}
