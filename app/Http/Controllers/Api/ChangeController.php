<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Change\StoreChangeRequest;
use App\Models\Change;
use App\Models\Order;
use Illuminate\Support\Facades\Request;

class ChangeController extends Controller
{
    public function store(StoreChangeRequest $request)
    {
        $change = Change::query()->create([
            'date' => $request->date,
        ]);
        if ($change){
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

    public function showOrders(Request $request, $id)
    {
        $change = Change::query()->where('id', $id)->first();
        if ($change) {
            $orders = Order::query()->where('created_at', $change->date)->get();
        }
        if ($orders){
            return response()->json([
                "change_orders" => [
                    "change_id" => $id,
                    "orders" => $orders
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
