<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Branch;
use App\Models\Zone;

class PlaceController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'branch' => 'required',
            'zone' => 'required',
            'placeCnName' => 'required|string',
            'placeImage' => 'image|mimes:png,jpg,jpeg,gif,svg',
        ]);

        $image = $request->file('placeImage') ? $request->file('placeImage') : null;
        $imageName = null;

        if ($image) {
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('place_images');
            $image->move($destinationPath, $imageName); //images is the location
        }

        $addPlace = Place::create([
            'zone' => $request->zone,
            'c_name' => $request->placeCnName,
            'e_name' => $request->placeEngName ? $request->placeEngName : null,
            'branch_id' => $request->branch,
            'image' => $imageName,
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
        $data['places'] = Place::all()->where('id', $id);

        $data['branches'] = Branch::whereNot('status', '=', 'close')->get();

        $data['zones'] = Zone::whereNot('status', '=', 'close')->get();

        return view('place/edit', $data);
    }
    public function add_view()
    {
        $data['branches'] = Branch::whereNot('status', '=', 'close')->get();
        $data['zones'] = Zone::whereNot('status', '=', 'close')->get();
        //dd($data);
        return view('place/add',$data);
    }

    //update branch
    public function update(Request $request)
    {
        $validated = $request->validate([
            'branch' => 'required',
            'zone' => 'required',
            'placeCnName' => 'required|string',
        ]);

        $editPlace = Place::find($request->placeId);

        $editPlace->zone_id = $request->zone;
        $editPlace->c_name = $request->placeCnName;
        $editPlace->e_name = $request->placeEngName ? $request->placeEngName : $editPlace->e_name;
        $editPlace->branch_id = $request->branch;

        $editPlace->save();

        return redirect()->route('place_view');
    }

    //deactivate the Branch
    public function deactivate($id)
    {
        $deactivatePlace = Place::find($id);

        $deactivatePlace->status = 'close';
        $deactivatePlace->save();

        return redirect()->route('place_view');
    }
    //reactivate the Branch
    public function reactivate($id)
    {
        $reactivatePlace = Place::find($id);

        $reactivatePlace->status = 'exist';
        $reactivatePlace->save();

        return redirect()->route('place_view');
    }
    public function search(Request $request)
    {
        $searchBranches = Branch::where('name','like','%'.$request->keyword.'%')->get();
        return view('/place/view')->with('branches', $searchBranches);
    }
}
