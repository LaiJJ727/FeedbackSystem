<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Feedback;
use App\Models\Comment;
use Auth;
class CommentController extends Controller
{
    public function indexComment($id)
    {
        $data['feedback'] = Feedback::find($id);

        return view('feedback/comment',$data);
    }
    public function addComment(Request $request)
    {
        // valdiate
        $request->validate([
            'description' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,gif,svg',
        ]);


        $feedback = Feedback::find($request->id);
        $feedback->status = $request->status ? $request->status : $feedback->status ;
        $feedback->save();

        $image = $request->file('image') ? $request->file('image') : null;
        $imageName = null;

        if ($image) {
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('comment_images');
            $image->move($destinationPath, $imageName); //images is the location
        }

        $addComment = Comment::create([
            'user_id' => Auth::id(),
            'feedback_id' => $request->id,
            'description' => $request->description,
            'image' => $imageName,
            'click_status' => $request->status ? $request->status: 0,
        ]);

        return back();
    }
}
