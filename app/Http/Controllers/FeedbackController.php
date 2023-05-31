<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Feedback;
use App\Models\User;
use App\Models\API;
use App\Models\Title;
use App\Models\Place;
use Auth;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function select_branch_view()
    {
        //select all branch data
        $branches = Branch::whereNot('status', '=', 'close')->get();
        $data['branches'] = [[]];
        $a = 0;
        foreach ($branches as $key => $branch) {
            if (count($data['branches'][$a]) >= 2) {
                $a++;
                array_push($data['branches'],[]);
            } 
            array_push($data['branches'][$a],['id' => $branch->id,'name' => $branch->name, 'image' => $branch->image]); 
        }
        // foreach($data['branches'] as $key => $branch){
        //     dd($branch[$key]['id']);
        // }
        return view('feedback/selectBranch',$data);
    }

    public function add_view()
    {
        $r = request();
        $branchId = $r->branch;
        $places = Place::where('branch_id', $r->branch)->get();

        $titles = Title::whereNot('status', '=', 'close')->get();

        return view('feedback/add', compact('titles', 'places', 'branchId'));
    }
    //add new feedback
    public function add()
    {
        $r = request();
        // valdiate
        $r->validate([
            'image' => 'required',
            'place' => 'required',
            'title' => 'required',
            'description' => 'required',
            'branch' => 'required',
        ]);

        $image = $r->file('image');
        $image->move('images', $image->getClientOriginalName()); //images is the location
        $imageName = $image->getClientOriginalName();

        $addFeedback = Feedback::create([
            'user_id' => Auth::id(),
            'place' => $r->place,
            'level' => $r->level, //0 is Emergency 1 is General
            'title' => $r->title,
            'description' => $r->description,
            'status' => '',
            'image' => $imageName,
            'branch_id' => $r->branch,
        ]);
        //send notification to whatsapp
        if (API::find(1) != null) {
            $api = API::find(1)->first();
            $apiKey = $api->api;

            if ($r->level == 1) {
                $level = 'Emergency';
            } else {
                $level = 'General';
            }
            $FullMessage = 'Feedback Case ID: ' . $addFeedback->id . "\nBranch: " . $addFeedback->branches->name . "\nPlace:" . $addFeedback->places->name . "\nLevel: " . $level . "\nTitle: " . $addFeedback->titles->name . "\nDescription: " . $r->description;

            $users = User::whereNot('role', 0)->get();
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

        return redirect()->route('feedback_index');
    }
    public function index()
    {
        $feedbacks = Feedback::all()->where('status', '!=', 2);

        return view('feedback/index')->with('feedbacks', $feedbacks);
    }
    public function myFeedback()
    {
        $r = request();

        $feedbacks = Feedback::where([['user_id', Auth::id()], ['status', '!=', 2]])->get();

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
