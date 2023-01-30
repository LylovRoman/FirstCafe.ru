<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use App\Models\Position;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $order = Order::query()->create([
            'status' => $request->status,
            'waiter_id' => $request->waiter_id,
            'book_id' => $request->book_id
        ]);
        $dishes = $request->dishes;
        foreach ($dishes as $dish) {
            Position::query()->create([
                'order_id' => $order->id,
                'dish_id' => $dish
            ]);
        }
        if ($order){
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
