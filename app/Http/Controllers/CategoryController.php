<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'categoryCnName' => 'required|string',
        ]);


        $addCategory = Category::create([
            'c_name' => $request->categoryCnName,
            'e_name' => $request->categoryEngName ? $request->categoryEngName : null,
            'status' => 'exist',
        ]);

        return redirect()->route('category_view');
    }
    public function view()
    {
        $categories = Category::all();

        return view('/category/view')->with('categories', $categories);
    }
    public function edit($id)
    {
        $data['categories'] = Category::all()->where('id', $id);

        return view('category/edit', $data);
    }
    public function add_view()
    {
        return view('category/add');
    }

    //update branch
    public function update(Request $request)
    {
        $validated = $request->validate([
            'categoryCnName' => 'required|string',
        ]);
        
        $editCategory = Category::find($request->categoryId);
        
        $editCategory->c_name = $request->categoryCnName;
        $editCategory->e_name = $request->categoryEngName ? $request->categoryEngName : $editCategory->e_name;
        $editCategory->save();

        return redirect()->route('category_view');
    }

    //deactivate the Branch
    public function deactivate($id)
    {
        $deactivateCategory= Category::find($id);

        $deactivateCategory->status = 'close';
        $deactivateCategory->save();

        return redirect()->route('category_view');
    }
    //reactivate the Branch
    public function reactivate($id)
    {
        $reactivateCategory = Category::find($id);

        $reactivateCategory->status = 'exist';
        $reactivateCategory->save();

        return redirect()->route('category_view');
    }
}
