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
        // if ($validation->fails())
        //  return response()->json($validation->errors());

        // $user = User::where('email', $request->email)->first();

        // if (!$user)
        //  return response()->json(['message' => 'usuario no encontrado'], 404);

        // $rigthPassword = Hash::check($request->password, $user->password);

        // if (!$rigthPassword) {
        //  return response()
        //      ->json(['message' => 'la contraseña no es correctos.'], 400);
        // }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login-view');
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

        if ($validation->fails())
            return redirect()->route('register-view', $validation->errors());
        // return response()->json($validation->errors());
        $userExist = User::where('email', $request->email)->count();
        if ($userExist)
            return redirect()->route('register-view', ['message' => 'El usuario ya existe']);

        // return response()->json(['message' => 'user already exist'], 400);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login-view', ['message' => 'registrado']);
    }
    public function logout(Request $request)
    {
        // auth()->user()->tokens()->delete();
        return [
            "all tokens deleted, logou succes"
        ];
    }
}
