<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saved(function (OrderPayment $payment) {
            $order = Order::find($payment->order_id);
            $customer = User::find($order->customer_id);
            $orders_ids = Order::where("customer_id", $customer->id)->pluck("id")->toArray();
            $paid_amount = OrderPayment::whereIn("order_id", $orders_ids)->where("status", "completed")->sum("amount");
            $customer->loyalty_points = $paid_amount * 100;
            $customer->save();
        });

        static::deleted(function (OrderPayment $payment) {
            $order = Order::find($payment->order_id);
            $customer = User::find($order->customer_id);
            $orders_ids = Order::where("customer_id", $customer->id)->pluck("id")->toArray();
            $paid_amount = OrderPayment::whereIn("order_id", $orders_ids)->where("status", "completed")->sum("amount");
            $customer->loyalty_points = $paid_amount * 100;
            $customer->save();
        });
    }
}
