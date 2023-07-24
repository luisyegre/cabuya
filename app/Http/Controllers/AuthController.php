<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login-view')->with('message', 'Email o contraseña incorrectos');
        }
    }
    public function loginView()
    {
        return Inertia::render('Auth/Login');
    }
    public function registerView()
    {
        return Inertia::render('Auth/Register');
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

        // return response()->json(['message' => 'user already exist'], 400);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return to_route('login-view')->with('message', 'registrado');
    }
    public function logout(Request $request)
    {
        // auth()->user()->tokens()->delete();
        return [
            "all tokens deleted, logou succes"
        ];
    }
}
