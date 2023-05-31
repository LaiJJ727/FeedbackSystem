<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Category;

class TitleController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'titlCnName' => 'required|string',
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
            'c_name' => $request->titlCnName,
            'e_name' => $request->titleEngName ? $request->titleEngName : null,
            'image' => $imageName,
            'category_id' => $request->category,
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

        $categories = Category::whereNot('status', '=', 'close')->get();

        return view('title/edit', compact('titles', 'categories'));
    }
    public function add_view()
    {
        $data['categories'] = Category::whereNot('status', '=', 'close')->get();

        return view('title/add', $data);
    }

    //update branch
    public function update(Request $request)
    {
        $validated = $request->validate([
            'titlCnName' => 'required|string',
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

        $editTitle = Title::find($request->titleId);

        $editTitle->c_name = $request->titlCnName;
        $editTitle->e_name = $request->titleEngName ? $request->titleEngName:$editTitle->e_name;
        $editTitle->image = $imageName ? $imageName : $editTitle->image;
        $editTitle->category_id = $request->category;

        $editTitle->save();

        return redirect()->route('title_view');
    }

    //deactivate the Branch
    public function deactivate($id)
    {
        $deactivateTitle = Title::find($id);

        $deactivateTitle->status = 'close';
        $deactivateTitle->save();

        return redirect()->route('title_view');
    }
    //reactivate the Branch
    public function reactivate($id)
    {
        $reactivateTitle = Title::find($id);

        $reactivateTitle->status = 'exist';
        $reactivateTitle->save();

        return redirect()->route('title_view');
    }
}
