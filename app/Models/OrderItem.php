<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saved(function (OrderItem $item) {
            $order = Order::find($item->order_id);
            $order->total_amount = OrderItem::where("order_id", $item->order_id)->sum("price");
            $order->save();
        });

        static::deleted(function (OrderItem $item) {
            $order = Order::find($item->order_id);
            $order->total_amount = OrderItem::where("order_id", $item->order_id)->sum("price");
            $order->save();
        });
    }
}
