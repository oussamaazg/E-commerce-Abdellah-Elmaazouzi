<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.users.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'phone' => ['required', 'digits:10'],
            'pincode' => ['required', 'digits:6'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->username
        ]);

        $findUserInDetails = UserDetail::where('user_id', Auth::user()->id)->first();
        if ($findUserInDetails) {
            $user->userDetail()->update([
                [
                    'user_id' => Auth::user()->id,
                ],
                [
                    'phone' => $request->phone,
                    'pincode' => $request->pincode,
                    'address' => $request->address,
                ]
            ]);
            return redirect()->back()->with('message', 'User Profile Updated..!');
        } else {
            $user->userDetail()->create([
                'user_id' => Auth::user()->id,
                'phone' => $request->phone,
                'pincode' => $request->pincode,
                'address' => $request->address,
            ]);
            return redirect()->back()->with('message', 'User Profile Updated..!');
        }


        return redirect()->back()->with('message', 'User Profile Updated..!');
    }

    public function passwordCreate()
    {
        return view('frontend.users.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if ($currentPasswordStatus) {

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with(['message'=>'Password Updated Successfully'], ['status' => 'success']);
        } else {

            return redirect()->back()->with(['message'=>'Current Password does not match with Old Password'], ['status' => 'warning']);
        }
    }
}
