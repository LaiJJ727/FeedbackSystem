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
        $feedback = Feedback::find($id);

        return view('feedback/comment')->with('feedback', $feedback);
    }
    public function addComment()
    {
        $r = request();

        $feedback = Feedback::find($r->id);
        $feedback->status = $r->status ? $r->status : '';
        $feedback->save();

        $image = $r->file('image');
        if ($image) {
            $image->move('public/comment_images', $image->getClientOriginalName()); //images is the location
            $imageName = $image->getClientOriginalName();
        }else{
            $imageName= "";
        }

        $addComment = Comment::create([
            'user_id' => Auth::id(),
            'feedback_id' => $r->id,
            'description' => $r->description,
            'image' => $imageName,
        ]);

        return redirect()->route('feedback_index');
    }
}
