<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = [
            'name' => 'USER',
            'email' => 'customer1@example.com',
            'role' => 'customer',
            'profile_photo' => session('profile_photo') 
        ];

        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|max:2048', 
        ]);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            session(['profile_photo' => asset('storage/' . $path)]); // simpan sementara
        }

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}