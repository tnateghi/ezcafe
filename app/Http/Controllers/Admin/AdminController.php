<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::oldest()->paginate(20);

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string',
            'username' => 'required|string|unique:admins,username',
            'mobile'   => ['required', 'unique:admins,mobile'],
            'password' => 'required|string|min:6|confirmed'
        ]);

        $data['password'] = Hash::make($data['password']);

        Admin::create($data);

        notifyMessage('success', 'مدیر با موفقیت ایجاد شد');

        return response('success');
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        if ($admin->id == 1) abort(403);

        $data = $request->validate([
            'name'     => 'required|string',
            'username' => 'required|string|unique:admins,username,' . $admin->id,
            'mobile'   => ['required', 'unique:admins,mobile,' . $admin->id],
        ]);

        if ($request->password) {
            $request->validate([
                'password' => 'string|min:6|confirmed'
            ]);

            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        notifyMessage('success', 'مدیر با موفقیت ویرایش شد');

        return response('success');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->id == 1) abort(403);

        $admin->delete();

        return response('success');
    }
}
