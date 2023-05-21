<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

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

        $addBranch = Branch::create([
            'name' => $request->branchName,
            'address' => $request->branchAddress,
            'description' => $request->branchDescription,
            'image' => $request->branchImage,
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
    public function update(){

        $r=request();

        $editBranch=Branch::find($r->branchId);

        $editBranch->name=$r->branchName;
        $editBranch->address=$r->branchAddress;
        $editBranch->description=$r->branchDescription;
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
