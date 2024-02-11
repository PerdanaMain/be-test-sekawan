<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    // For the login page
    public function login()
    {

        return view('welcome');
    }

    public function store()
    {
        $credentials = request()->validate([
            'user_email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('user_email', $credentials['user_email'])
            ->leftjoin('roles', 'users.user_id', '=', 'roles.role_id')
            ->first();

        if (!$user) {
            return back()->with([
                'auth.error' => 'The provided credentials do not match our records.',
            ]);
        }

        if (!password_verify($credentials['password'], $user->password)) {
            return back()->with([
                'auth.error' => 'The provided credentials do not match our records.',
            ]);
        }
        session()->put('user', $user->toArray());

        return redirect("/dashboard");
    }

    public function logout()
    {
        session()->forget('user');

        return redirect('/');
    }
}