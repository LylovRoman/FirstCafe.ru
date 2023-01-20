<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function create(Request $request)
    {
        return Dish::query()->create($request);
    }
    public function showAll()
    {
        return Dish::all();
    }
    public function show($id)
    {
        return Dish::query()->where('id', $id)->first();
    }
    public function edit(Request $request, $id)
    {
        return Dish::query()->where('id', $id)->update($request);
    }
    public function delete($id)
    {
        return Dish::query()->where('id', $id)->delete();
    }
}
