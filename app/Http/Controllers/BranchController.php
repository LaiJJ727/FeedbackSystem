<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BranchController extends Controller
{
    //add branch
    public function add(Request $request)
    {
        //if ($request->file('branchImage') != null) {
        $validated = $request->validate([
            'branchName' => 'required|string',
            'branchAddress' => 'required|string',
            'branchImage' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        // }

        $image = $request->file('branchImage') ? $request->file('branchImage') : null;
        $imageName = null;

        if ($image) {
            // $imageName = $image->getClientOriginalName();
            // $destinationPath = public_path('branch_images');
            // $image->move($destinationPath, $imageName); //images is the location
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('branch_images');
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->scaleDown(height:500);
            //images is the location
            $img->save($destinationPath.'/'.$imageName);
        }

        $addBranch = Branch::create([
            'name' => $request->branchName,
            'address' => $request->branchAddress,
            'description' => $request->branchDescription,
            'image' => $imageName,
            'status' => 'exist',
        ]);
        return redirect()->route('branch_view');
    }
    public function view()
    {
        $branches = Branch::all();

        return view('/branch/view')->with('branches', $branches);
    }
    public function edit($id)
    {
        $branches = Branch::all()->where('id', $id);

        return view('branch/edit')->with('branches', $branches);
    }
    public function add_view()
    {
        return view('branch/add');
    }

    //update branch
    public function update(Request $request)
    {
        $validated = $request->validate([
            'branchName' => 'required|string',
            'branchAddress' => 'required|string',
            'branchImage' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image = $request->file('branchImage') ? $request->file('branchImage') : null;
        $imageName = null;

        if ($image) {
             // $imageName = $image->getClientOriginalName();
            // $destinationPath = public_path('branch_images');
            // $image->move($destinationPath, $imageName); //images is the location
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('branch_images');
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->scaleDown(height:500);
            //images is the location
            $img->save($destinationPath.'/'.$imageName);
        }

        $editBranch = Branch::find($request->branchId);
        $editBranch->name = $request->branchName;
        $editBranch->address = $request->branchAddress;
        $editBranch->description = $request->branchDescription;
        $editBranch->image = $imageName ? $imageName : $editBranch->image;
        $editBranch->save();

        return redirect()->route('branch_view');
    }

    //deactivate the Branch
    public function deactivate($id)
    {
        $deactivateBranch = branch::find($id);

        $deactivateBranch->status = 'close';
        $deactivateBranch->save();

        return redirect()->route('branch_view');
    }
    //reactivate the Branch
    public function reactivate($id)
    {
        $reactivateBranch = branch::find($id);

        $reactivateBranch->status = 'exist';
        $reactivateBranch->save();

        return redirect()->route('branch_view');
    }
}
