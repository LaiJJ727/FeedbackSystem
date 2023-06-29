<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use Auth;
use Illuminate\Support\Facades\Validator;
use Hash;
class UserController extends Controller
{
    public function view()
    {
        $data['users'] = User::whereNot('id', '1')->get();

        return view('/auth/userManagement', $data);
    }
    public function deactivateUser($id)
    {
        $deactivateUser = User::find($id);
        $deactivateUser->role = $deactivateUser->role . 'ban';
        $deactivateUser->save();

        return redirect()->route('user_view');
    }

    public function reactivateUser($id)
    {
        $deactivateUser = User::find($id);
        $deactivateUser->role = str_replace('ban', '', $deactivateUser->role);
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
        $branches = Branch::where('status', 'exist')->get();

        return view('auth/profile', compact('profile', 'branches'));
    }
    public function profileUpdate(Request $request)
    {
        //valdiate
        if ($request->password || $request->resetPassword) {
            $validated = $request->validate([
                'phone' => 'required|regex:/^\d{10,11}$/',
                'password' => 'required_with:confirmPassword|same:confirmPassword|min:6',
                'confirmPassword' => 'required_with:password|same:password|min:6',
            ]);
        } else {
            $validated = $request->validate([
                'phone' => 'required|regex:/^\d{10,11}$/',
            ]);
        }

        $profile = User::find($request->id);
        $profile->username = $request->username;
        $profile->name = $request->name;
        $profile->phone = $request->phone;
        $profile->language = $request->language ? $request->language : $profile->language;
        $profile->branch_id = $request->branch_id ? $request->branch_id : $profile->branch_id;
        $profile->password = $request->password ? Hash::make($request->password) : $profile->password;
        $profile->save();

        if ($profile->role == 'Admin') {
            return redirect()->route('profile_view');
        } else {
            return redirect()->route('user_view');
        }
    }
}
