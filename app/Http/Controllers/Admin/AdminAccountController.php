<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAccountController extends RoutingController
{
    public function show()
    {
        /** @var User $admin */
        $admin = Auth::user();

        return view('admin.account.show', compact('admin'));
    }

    public function edit()
    {
        /** @var User $admin */
        $admin = Auth::user();

        return view('admin.account.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        /** @var User $admin */
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');
            $admin->avatar = $path;
        }

        $admin->save();

        return redirect()->route('admin.account.show')->with('success', 'Account updated successfully.');
    }

    public function destroy()
    {
        /** @var User $admin */
        $admin = Auth::user();

        Auth::logout();
        $admin->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
