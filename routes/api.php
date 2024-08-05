<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantMenuController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post("/sign-up", [AuthController::class, "signUp"]);
Route::post("/sign-in", [AuthController::class, "signIn"]);
Route::post("/sign-out", [AuthController::class, "signOut"]);

Route::middleware(["auth"])->group(function () {



    Route::apiResource("users", UserController::class)
        ->middleware("role:Administrator");


        
    Route::apiResource('restaurants', RestaurantController::class)
        ->only(["index", "show"]);

    Route::apiResource('restaurants', RestaurantController::class)
        ->only(["store", "update", "destroy"])
        ->middleware(["role:Administrator,Manager", "permission:restaurant"]);



    Route::apiResource('/restaurants/{restaurant}/menus', RestaurantMenuController::class)
        ->only(["index", "show"])
        ->middleware(["permission:menu"]);

    Route::apiResource('/restaurants/{restaurant}/menus', RestaurantMenuController::class)
        ->only(["store", "update", "destroy"])
        ->middleware(["role:Administrator,Manager", "permission:restaurant", "permission:menu"]);



    Route::apiResource('orders', OrderController::class)
        ->only(["index", "show"])
        ->middleware(["permission:order"]);

    Route::apiResource('orders', OrderController::class)
        ->only(["store", "update", "destroy"])
        ->middleware(["role:Administrator,Customer",  "permission:order"]);



    Route::apiResource('/orders/{order}/items', OrderItemController::class)
        ->only(["index", "show"])
        ->middleware(["role:Administrator,Customer", "permission:item"]);

    Route::apiResource('/orders/{order}/items', OrderItemController::class)
        ->only(["store", "update", "destroy"])
        ->middleware(["role:Administrator,Customer", "permission:order", "permission:item"]);



    Route::apiResource("/orders/{order}/payments", OrderPaymentController::class)
        ->only(["index", "show"])
        ->middleware(["role:Administrator,Customer", "permission:payment"]);

    Route::apiResource("/orders/{order}/payments", OrderPaymentController::class)
        ->only(["store", "update", "destroy"])
        ->middleware(["role:Administrator,Customer", "permission:order", "permission:payment"]);
});

Route::apiResource("/orders/{order}/payments", OrderPaymentController::class)
        ->only(["store"]);
