<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Order $order)
    {
        return OrderItem::where("order_id", $order->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Order $order)
    {
        $item = new OrderItem();
        $item->order_id = $order->id;
        $item->menu_id = $request->menu_id;
        $item->quantity = $request->quantity ?? 0;
        $item->price = RestaurantMenu::find($item->menu_id)->price * $item->quantity;
        $item->save();

        return $item;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, OrderItem $item)
    {
        return $item;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order, OrderItem $item)
    {
        $item->quantity = $request->quantity ?? $item->quantity;
        $item->price = RestaurantMenu::find($item->menu_id)->price * $item->quantity;
        $item->save();

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, OrderItem $item)
    {
        $item->delete();
        return $item;
    }
}
