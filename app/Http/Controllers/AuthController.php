<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6)->max(20)->letters()->numbers()],
            'remember' => ['nullable', 'boolean']
        ]);

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember'] ?? false)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors(['status' => 'The provided credentials do not match our records.']);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(6)->max(20)->letters()->numbers()]
        ]);

        try {
            $user = new User();

            DB::transaction(function () use ($user, $data) {
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = $data['password'];
                $user->role = 'user';
                $user->save();
            });

            Auth::login($user, true);

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return back()->withErrors(['status' => 'Register failed. Please try again or contact us.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
