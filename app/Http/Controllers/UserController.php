<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function view()
    {
        $data["users"] = User::all();

        return view('/auth/userManagement',$data);
    }
    public function deactivateUser($id)
    {
        $deactivateUser = User::find($id);
        $deactivateUser->role = $deactivateUser->role.'ban';
        $deactivateUser->save();

        return redirect()->route('user_view');
    }

    public function reactivateUser($id)
    {
        $deactivateUser = User::find($id);
        $deactivateUser->role =  str_replace('ban','',$deactivateUser->role);
        $deactivateUser->save();

        return redirect()->route('user_view');
    }
    public function profile()
    {
        $profile = User::find(Auth::id());

        return view('auth/profile')->with('profile', $profile);
    }
    public function profileUser($id)
    {
        $profile = User::find($id);

        return view('auth/profile')->with('profile', $profile);
    }
    public function profileUpdate()
    {
        $r = request();
        //valdiate
        $rules = [
            'name' => 'required|string',
            'phone' => 'required|string|min:10',
        ];

        $validator = Validator::make($r->all(), $rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }
        $profile = User::find($r->id);

        $profile->name = $r->name;
        $profile->phone = $r->phone;
        $profile->save();
        if($profile->role==2){
            return redirect()->route('profile_view');
        }else{
            return redirect()->route('user_view');
        }
    }
}
