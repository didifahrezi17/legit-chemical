<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,'.$admin->id,
            'email' => 'required|email|max:255|unique:admins,email,'.$admin->id,
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($request->filled('password')) {
            if (! Hash::check($request->input('current_password'), $admin->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        unset($validated['current_password']);

        $admin->update($validated);

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
