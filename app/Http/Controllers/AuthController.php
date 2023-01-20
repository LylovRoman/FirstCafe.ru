<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginAuthRequest $request){
        if(Auth::check()){
            return response()->json([
                "error" => [
                    "code" => 400,
                    "message" => "Вы не правы"
                ]
            ]);
        } else {
            $user = User::where('login', $request->login)->first();
            if ($user && $user->password == $request->password){
                Auth::login($user);
            }
            return response()->json([
                "data" => [
                    "user_token" => $user::generateToken()
                ]
            ]);
        }
    }
    public function register(RegisterAuthRequest $request){
        if(Auth::check()){
            return response()->json([
                "error" => [
                    "code" => 400,
                    "message" => "Вы не правы"
                ]
            ]);
        } else {
            $user = User::where('login', $request->login)->first();
            if (!$user){
                $user = User::create([
                    'name' => $request->name,
                    'login' => $request->login,
                    'password' => $request->password,
                    'role' => $request->role
                ]);
                return response()->json([
                    "data" => [
                        "user_token" => $user::generateToken()
                    ]
                ]);
            }
            return response()->json([
                "error" => [
                    "code" => 400,
                    "message" => "Вы не правы"
                ]
            ]);
        }
    }
}
