<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;

class TitleController extends Controller
{
    public function add()
    {
        $r = request();

        $addTitle = Title::create([
            'name' => $r->titleName,
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
    public function update(){

        $r=request();

        $editTitle=Title::find($r->titleId);

        $editTitle->name=$r->titleName;

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
