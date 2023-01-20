<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        return User::query()->create($request);
    }
    public function showAll()
    {
        return User::all();
    }
    public function show($id)
    {
        return User::query()->where('id', $id)->first();
    }
    public function edit(Request $request, $id)
    {
        return User::query()->where('id', $id)->update($request);
    }
    public function delete($id)
    {
        return User::query()->where('id', $id)->delete();
    }
}
