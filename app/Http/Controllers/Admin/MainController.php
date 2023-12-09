<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    public function dashboard()
    {
        return redirect()->route('admin.foods.index');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function updateSettings(Request $request)
    {
        $settings = $request->only([
            'smspanel_username',
            'smspanel_password',
            'smspanel_fromnumber',
            'referral_enabled',
            'referral_credit_amount',
        ]);

        foreach ($settings as $setting => $value) {
            option_update($setting, $value);
        }

        return response('success');
    }

    public function profile()
    {
        $admin = auth('admin')->user();

        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'username'         => 'required|string|unique:admins,username,' . $admin->id,
            'current_password' => 'nullable|string',
            'password'         => 'nullable|required_with:current_password|min:8|confirmed'
        ]);

        if ($request->current_password) {
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                throw ValidationException::withMessages(['current_password' =>  "رمز عبور فعلی اشتباه است"]);
            }

            $password = Hash::make($request->password);

            $admin->update([
                'password'       => $password,
                'remember_token' => null,
            ]);
        }

        $admin->update([
            'username' => $request->username
        ]);

        return response('success');
    }
}
