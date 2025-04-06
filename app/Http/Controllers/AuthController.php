<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('products.index');
        };
        return to_route('login')->withErrors([
            'email' => 'Adresse mail ou mot de passe incorrect',
        ])->onlyInput('email');

    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(RegisterRequest $request)
    {
        $request->validated();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('product.index')
            ->withSuccess("c'est bon t'es connecté");
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }
}
