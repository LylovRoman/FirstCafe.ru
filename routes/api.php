<?php

use App\Http\Controllers\Api\ChangeController;
use App\Http\Controllers\Api\ChangeUserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('ghost')->post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/login/failed', function (){
    return response()->json([
        "error" => [
            "code" => 403,
            "message" => "Login failed"
        ]
    ]);
});

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::post('/change', [ChangeController::class, 'store']);
        Route::post('/change/user', [ChangeUserController::class, 'store']);
        Route::get('/change/{id}/orders', [ChangeController::class, 'showOrders']);
    });
    Route::middleware('waiter')->group(function () {
        Route::post('/orders/book', [OrderController::class, 'store']);
    });
});
