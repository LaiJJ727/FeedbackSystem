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
    // public function select_branch_view()
    // {
    //     //select all branch data
    //     $branches = Branch::whereNot('status', '=', 'close')->get();
    //     $data['branches'] = [[]];
    //     $a = 0;
    //     foreach ($branches as $key => $branch) {
    //         if (count($data['branches'][$a]) >= 2) {
    //             $a++;
    //             array_push($data['branches'],[]);
    //         } 
    //         array_push($data['branches'][$a],['id' => $branch->id,'name' => $branch->name, 'image' => $branch->image]); 
    //     }
    //     return view('feedback/selectBranch',$data);
    // }

    public function add_view(Request $request)
    {
        $data['branches'] = Branch::whereNot('status', '=', 'close')->get();
        // $data['branches'] = [[]];
        // $a = 0;
        // foreach ($branches as $key => $branch) {
        //     if (count($data['branches'][$a]) >= 2) {
        //         $a++;
        //         array_push($data['branches'],[]);
        //     } 
        //     array_push($data['branches'][$a],['id' => $branch->id,'name' => $branch->name, 'image' => $branch->image]); 
        // }
        $data['zones'] = Zone::whereNot('status','close')->get();
        $data['places'] = Place::where('status','exist')->get();
        $data['categories'] = Category::whereNot('status', 'close')->get();
        $data['titles'] = Title::whereNot('status','close')->get();

        return view('feedback/add', $data);
    }
    //add new feedback
    public function add(Request $request)
    {
        // valdiate
        $request->validate([
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
            'place_id' => $request->place,
            'feedback_to' => $request->feedbackTo, //0 is Emergency 1 is General
            'title_id' => $request->title,
            'description' => $request->description,
            'status' => 0,
            'image' => $imageName,
            'branch_id' => $request->branch,
        ]);
        //send notification to whatsapp
        // if (API::find(1) != null) {
        //     $api = API::find(1)->first();
        //     $apiKey = $api->api;

        //     $FullMessage = 'Feedback Case ID: ' . $addFeedback->id . "\nBranch: " . $addFeedback->branches->name . "\nPlace:" . $addFeedback->places->c_name . "\nLevel: " . $addFeedback->feedback_to . "\nTitle: " . $addFeedback->titles->c_name . "\nDescription: " . $request->description;

        //     $users = User::whereNot('role', 'Staff')->get();
        //     foreach ($users as $user) {
        //         $data = [
        //             'phone_number' => $user->phone,
        //             'message' => $FullMessage,
        //         ];

        //         $response = \Illuminate\Support\Facades\Http::accept('application/json')
        //             ->withToken($apiKey)
        //             ->post('https://onsend.io/api/v1/send', $data);

        //         //dump($response->body());//check only
        //     }
        // }

        return redirect()->route('feedback_index');
    }
    public function index()
    {
        $feedbacks = Feedback::all()->where('status', '!=', 2);

        return view('feedback/index')->with('feedbacks', $feedbacks);
    }
    public function myFeedback()
    {
        $feedbacks = Feedback::where([['user_id', Auth::id()], ['status', '!=', 3]])->get();
        return view('feedback/myFeedback')->with('feedbacks', $feedbacks);
    }
    public function editFeedback($id)
    {
        $feedback = Feedback::find($id);

        if ($feedback->user_id != Auth::id()) {
            redirect()->route('feedback_index');
        }
        $places = Place::where('branch_id', $feedback->branch_id)->get();

        $titles = Title::whereNot('status', '=', 'close')->get();

        return view('feedback/edit', compact('feedback', 'titles', 'places'));
    }
    public function updateFeedback()
    {
        $r = request();

        $feedback = Feedback::find($r->id);
        if ($r->file('image') != '' && $feedback->image != $r->file('image')->getClientOriginalName()) {
            $image = $r->file('image');
            $image->move('images', $image->getClientOriginalName()); //images is the location
            $imageName = $image->getClientOriginalName();
            $feedback->image = $imageName;
        }
        $feedback->place = $r->place;
        $feedback->level = $r->level;
        $feedback->title = $r->title;
        $feedback->description = $r->description;
        $feedback->save();

        return redirect()->route('my_feedback');
    }
    public function searchFeedback()
    {
        $r = request();
        $keyword = $r->keyword;
        $feedbacks = Feedback::where([['id', 'like', '%' . $keyword . '%'], ['status', '!=', 2]])->get();

        return view('feedback/index')->with('feedbacks', $feedbacks);
    }
    public function feedbackIndexComplete()
    {
        $feedbacks = Feedback::all()->where('status', 2);

        return view('feedback/index')->with('feedbacks', $feedbacks);
    }
}
