<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('pictures', 'public');
        }

        Auth::user()->update([
            'picture' => asset('storage/' . $path)
        ]);


        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
