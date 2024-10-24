<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store()
    {
        //validate
        $validatedAttr = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);
        //create the user
        $user = User::create($validatedAttr);
        //login
        Auth::login($user);
        //redirect
        return redirect('/jobs');
    }
}
