<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            "data" => User::all()
        ]);
    }
    public function store(StoreUserRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->name,
            'login' => $request->login,
            'password' => $request->password,
            'role' => $request->role
        ]);
        if ($user){
            return response()->json([
                "data" => [
                    "code" => "QSASE"
                ]
            ]);
        } else {
            return response()->json([
                "error" => [
                    "code" => 422,
                    "message" => "Validation error",
                    "errors" => array()
                ]
            ]);
        }
    }
    public function show($id)
    {
        return response()->json(User::query()->where('id', $id)->first());
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::query()->where('id', $id)->update([
            'name' => $request->name,
            'login' => $request->login,
            'password' => $request->password,
            'role' => $request->role
        ]);
        if ($user){
            return response()->json([
                "data" => [
                    "code" => "QSASE"
                ]
            ]);
        } else {
            return response()->json([
                "error" => [
                    "code" => 422,
                    "message" => "Validation error",
                    "errors" => array()
                ]
            ]);
        }
    }
    public function destroy($id)
    {
        return response()->json(User::query()->where('id', $id)->delete());
    }
}
