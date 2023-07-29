<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $logged = Auth::attempt(
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ])
        );
        if ($logged) {
            return to_route('home-view');
        } else {
            return to_route('login-view')->with('message', ['content' => 'Email o contraseña incorrectos', 'type' => 'danger']);
        }
    }
    public function loginView()
    {
        return inertia('Auth/Login');
    }
    public function registerView()
    {
        return inertia('Auth/Register');
    }
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $validation->validate();
        $userExist = User::where('email', $request->email)->count();
        if ($userExist)
            return to_route('register-view')->with('message', 'El usuario ya existe');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return to_route('login-view')->with('message', ['content' => 'Te haz registrado', 'type' => 'success']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        // auth()->user()->tokens()->delete();
        return to_route('login');
    }
}
