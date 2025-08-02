<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('welcome');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'auth'      => 'required',
            'password'  => 'required'
        ]);

        $login = Str::lower($request->input('auth'));
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = \App\Models\User::where($fieldType, $login)->first();

        if ($user) {
            $credentials = [
                $fieldType => $login,
                'password' => $request->input('password')
            ];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect('/dashboard')->with('success', 'You have successfully logged in.');
            } else {
                return back()->withErrors([
                    'auth' => 'The credentials you entered are incorrect.'
                ])->withInput($request->except('password'));
            }
        } else {
            return back()->withErrors([
                'auth' => 'The credentials you entered are incorrect.'
            ])->withInput($request->except('password'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
