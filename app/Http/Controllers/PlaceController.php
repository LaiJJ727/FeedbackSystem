<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Branch;
use App\Models\Zone;
use App\Services\Services;

class PlaceController extends Controller
{
    protected $services;
    public function __construct()
    {
        $this->services = new Services();
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'branch' => 'required',
            'zone' => 'required',
            'placeCnName' => 'required|string',
            'placeImage' => 'image|mimes:png,jpg,jpeg,gif,svg',
        ]);

        $image = $request->file('placeImage') ? $request->file('placeImage') : null;
        $publicPath = 'place_images';
        $imageName  = $this->services->ImageResizeService($image, $publicPath);

        $addPlace = Place::create([
            'zone_id' => $request->zone,
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

        $image = $request->file('placeImage') ? $request->file('placeImage') : null;
        $publicPath = 'place_images';
        $imageName  = $this->services->ImageResizeService($image, $publicPath);

        $editPlace = Place::find($request->placeId);

        $editPlace->zone_id = $request->zone;
        $editPlace->c_name = $request->placeCnName;
        $editPlace->e_name = $request->placeEngName ? $request->placeEngName : $editPlace->e_name;
        $editPlace->branch_id = $request->branch;
        $editPlace->image = $imageName ? $imageName : $editPlace->image;

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
