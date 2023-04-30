<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $req) {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $pass = Hash::make($req->password);
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => $pass
        ])->save();
        
        return response()->json([
            'message' => 'User created successfully',
        ]);
    }

    public function login(Request $req) {
        $credentials = $req->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        return $this->respondWithToken($token); 
    }

    public function me() {
        return response()->json(Auth::user());
    }

    public function logout(Request $req) {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()*60,
        ]);
    }
}
