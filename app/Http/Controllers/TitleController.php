<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;

class TitleController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'titleName' => 'required|string',
            'titleEngName' => 'string',
            'titleImg' => 'image|mimes:png,jpg,jpeg,gif,svg',
        ]);
        $image = $request->file('titleImg') ? $request->file('titleImg') : null;
        $imageName = null;
        
        if ($image) {
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('title_images');
            $image->move($destinationPath, $imageName); //images is the location
        }

        $addTitle = Title::create([
            'c_name' => $request->titleName,
            'e_name' => $request->titleEngName,
            'image' => $imageName,
            'status' => 'exist',
        ]);
        return redirect()->route('title_view');
    }
    public function view()
    {
        $titles = Title::all();

        return view('/title/view')->with('titles', $titles);
    }
    public function edit($id)
    {
        $titles = Title::all()->where('id', $id);

        return view('title/edit')->with('titles', $titles);
    }
    public function add_view()
    {
        return view('title/add');
    }

    //update branch
    public function update(Request $request){

        $validated = $request->validate([
            'titleName' => 'required|string',
            'engTitleName' => 'string',
            'titleImg' => 'image|mimes:png,jpg,jpeg,gif,svg',
        ]);
        $image = $request->file('titleImg') ? $request->file('titleImg') : null;
        $imageName = null;
        
        if ($image) {
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('title_images');
            $image->move($destinationPath, $imageName); //images is the location
        }


        $editTitle=Title::find($request->titleId);

        $editTitle->c_name=$request->titleName;
        $editTitle->e_name=$request->engTitleName;
        $editTitle->image=$imageName;

        $editTitle->save();

        return redirect()->route('title_view');
    }

    //deactivate the Branch
    public function deactivate($id){
        $deactivateTitle=Title::find($id);

        $deactivateTitle->status = 'close';
        $deactivateTitle->save();

        return redirect()->route('title_view');
    }
    //reactivate the Branch
    public function reactivate($id){

        $reactivateTitle=Title::find($id);

        $reactivateTitle->status = 'exist';
        $reactivateTitle->save();

        return redirect()->route('title_view');
    }

}
