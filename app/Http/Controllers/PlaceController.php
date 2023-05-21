<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Branch;
class PlaceController extends Controller
{
    public function add()
    {
        $r = request();

        $addPlace = Place::create([
            'name' => $r->placeName,
            'branch_id' => $r->branch,
            'status' => 'exist',
        ]);
        return redirect()->route('place_view');
    }
    public function view()
    {
        $branches = Branch::all();

        return view('/place/view')->with('branches', $branches);
    }
    public function edit($id)
    {
        $places = Place::all()->where('id', $id);

        $branches = Branch::whereNot('status', '=', 'close')->get();

        return view('place/edit', compact('places', 'branches'));
    }
    public function add_view()
    {
        $branches = Branch::whereNot('status', '=', 'close')->get();

        return view('place/add')->with('branches',$branches);
    }

    //update branch
    public function update(){

        $r=request();

        $editPlace=Place::find($r->placeId);

        $editPlace->name=$r->placeName;
        $editPlace->branch_id=$r->branch;

        $editPlace->save();

        return redirect()->route('place_view');
    }

    //deactivate the Branch
    public function deactivate($id){
        $deactivatePlace=Place::find($id);

        $deactivatePlace->status = 'close';
        $deactivatePlace->save();

        return redirect()->route('place_view');
    }
    //reactivate the Branch
    public function reactivate($id){

        $reactivatePlace=Place::find($id);

        $reactivatePlace->status = 'exist';
        $reactivatePlace->save();

        return redirect()->route('place_view');
    }
}
