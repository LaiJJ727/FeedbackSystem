<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;

class ZoneController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'zoneCnName' => 'required|string',
        ]);


        $addCategory = Zone::create([
            'c_name' => $request->zoneCnName,
            'e_name' => $request->zoneEngName ? $request->zoneEngName : null,
            'status' => 'exist',
        ]);

        return redirect()->route('zone_view');
    }
    public function view()
    {
        $zones = Zone::all();

        return view('/zone/view')->with('zones', $zones);
    }
    public function edit($id)
    {
        $data['zones'] = Zone::all()->where('id', $id);

        return view('zone/edit', $data);
    }
    public function add_view()
    {
        return view('zone/add');
    }

    //update branch
    public function update(Request $request)
    {
        $validated = $request->validate([
            'zoneCnName' => 'required|string',
        ]);
        
        $editZone = Zone::find($request->zoneId);
        
        $editZone->c_name = $request->zoneCnName;
        $editZone->e_name = $request->zoneEngName ? $request->zoneEngName : $editZone->e_name;
        $editZone->save();

        return redirect()->route('zone_view');
    }

    //deactivate the Branch
    public function deactivate($id)
    {
        $deactivateZone= Zone::find($id);

        $deactivateZone->status = 'close';
        $deactivateZone->save();

        return redirect()->route('zone_view');
    }
    //reactivate the Branch
    public function reactivate($id)
    {
        $reactivateZone = Zone::find($id);

        $reactivateZone->status = 'exist';
        $reactivateZone->save();

        return redirect()->route('zone_view');
    }
}

