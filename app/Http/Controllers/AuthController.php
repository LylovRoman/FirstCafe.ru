<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
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
            $user = User::where('login', $request->login)->first();
            if ($user && $user->password == $request->password){
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
                    "message" => "Authentication failed"
                ]
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            "data" => [
                "message" => "logout"
            ]
        ]);
    }
}
