<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginAuthRequest $request)
    {
        if(Auth::check()){
            return response()->json([
                "error" => [
                    "code" => 401,
                    "message" => "Authentication failed"
                ]
            ]);
        } else {
            if (($user = User::where('login', $request->login)->first())  && ($user->password === $request->password)){
                Auth::login($user);
                return response()->json([
                    "data" => [
                        "user_token" => $user::generateToken()
                    ]
                ]);
            }
            return response()->json([
                "error" => [
                    "code" => 401,
                    "message" => "Authentication failed 2"
                ]
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            "data" => [
                "message" => "logout"
            ]
        ]);
    }
}
