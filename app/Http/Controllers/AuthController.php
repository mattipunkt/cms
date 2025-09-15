<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (User::count() === 0) {
            session()->flash('status', 'You are the first user, so the credentials you enter will be used to create the admin account!');

            return view('auth.register');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ]
        );
        $user = User::where('email', $validated['email'])->first();

        if (Auth::attempt($validated)) {
            session()->regenerate();

            return redirect('/');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Wrong credentials!',
        ]
        );
    }

    public function register(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]
        );

        $firstUser = User::count() === 0;
        $user = User::create($validated);

        if ($firstUser) {
            $user->is_admin = true;
            $user->save();
            Auth::login($user);
        }

        return redirect('/');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
