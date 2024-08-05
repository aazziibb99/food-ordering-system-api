<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($user = request()->attributes->get("user")) {
            if($user->role == "Customer") {
                return Order::where("customer_id", $user->id)->get();
            }
        }

        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->customer_id = request()->attributes->get("user")->id;
        $order->restaurant_id = $request->restaurant_id ?? 1;
        $order->order_date = now();
        $order->total_amount = 0;
        $order->pickup_or_delivery = $request->pickup_or_delivery;
        $order->status = "Pending";
        $order->save();

        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->status = $request->status ?? $order->status;
        $order->save();

        return $order;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return $order;
    }
}
