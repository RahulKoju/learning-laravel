<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        //validate
        $validatedattr = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        //attempt to login
        if (!Auth::attempt($validatedattr)) {
            throw ValidationException::withMessages([
                'email' => 'Incorrect credentials!!'
            ]);
        }
        //regenerate session token
        request()->session()->regenerate();
        //redirect
        return redirect("/jobs");
    }

    public function destroy()
    {
        Auth::logout();
        return redirect("/");
    }
}
