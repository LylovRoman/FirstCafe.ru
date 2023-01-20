<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        return Order::query()->create($request);
    }
    public function showAll()
    {
        return Order::all();
    }
    public function show($id)
    {
        return Order::query()->where('id', $id)->first();
    }
    public function edit(Request $request, $id)
    {
        return Order::query()->where('id', $id)->update($request);
    }
    public function delete($id)
    {
        return Order::query()->where('id', $id)->delete();
    }
}
