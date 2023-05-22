<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    //add branch
    public function add(Request $request)
    {
        
        if ($request->file('branchImage') != null) {
            $validated = $request->validate([
                'branchName' => 'required|string',
                'branchAddress' => 'required|string',
                'branchImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
        } else {
            $validated = $request->validate([
                'branchName' => 'required|string',
                'branchAddress' => 'required|string',
            ]);
        }

        $image = $request->file('branchImage') ? $request->file('branchImage') : null;
        $imageName = null;

        if ($image) {
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imageName); //images is the location
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
    public function update(Request $request){

        if ($request->file('branchImage') != null) {
            $validated = $request->validate([
                'branchName' => 'required|string',
                'branchAddress' => 'required|string',
                'branchImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
        } else {
            $validated = $request->validate([
                'branchName' => 'required|string',
                'branchAddress' => 'required|string',
            ]);
        }

        $image = $request->file('branchImage') ? $request->file('branchImage') : null;
        $imageName = null;

        if ($image) {
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imageName); //images is the location
        }

        $editBranch=Branch::find($request->branchId);

        $editBranch->name = $request->branchName;
        $editBranch->address = $request->branchAddress;
        $editBranch->description = $request->branchDescription;
        $editBranch->image = $imageName ? $imageName : $editBranch->image;
        $editBranch->save();

        return redirect()->route('branch_view');
    }

    //deactivate the Branch
    public function deactivate($id){
        $deactivateBranch=branch::find($id);

        $deactivateBranch->status = 'close';
        $deactivateBranch->save();

        return redirect()->route('branch_view');
    }
    //reactivate the Branch
    public function reactivate($id){
        $reactivateBranch=branch::find($id);

        $reactivateBranch->status = 'exist';
        $reactivateBranch->save();

        return redirect()->route('branch_view');
    }
}
