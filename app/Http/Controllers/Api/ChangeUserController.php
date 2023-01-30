<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeUser\StoreOrderRequest;
use App\Models\Change;
use App\Models\ChangeUser;
use App\Models\User;

class ChangeUserController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $change = Change::query()->where('id', $request->change_id)->first();
        $user = User::query()->where('id', $request->user_id)->first();
        if ($change && $user) {
            $changeUser = ChangeUser::query()->create([
                'change_id' => $request->change_id,
                'user_id' => $request->user_id
            ]);
        }
        if ($changeUser){
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
}
