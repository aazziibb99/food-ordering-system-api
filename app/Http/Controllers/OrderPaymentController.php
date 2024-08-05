<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPayment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            "base_uri" => "https://api.sandbox.hit-pay.com/v1/payment-requests/",
            "headers" => [
                "X-BUSINESS-API-KEY" => env("HITPAY_API_KEY", ""),
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Order $order)
    {
        return OrderPayment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Order $order)
    {
        $payment = OrderPayment::where("order_id", $order->id)->first();

        if(!$payment) {
            $payment = new OrderPayment();
            $payment->order_id = $order->id;
            $response = $this->client->post('', [
                "json" => [
                    "amount" => $order->total_amount,
                    "currency" => "MYR",
                    "address" => [
                        "line1" => "TestLine1",
                        "line2" => "TestLine2",
                        "city" => "TestCity",
                        "country" => "TestCountry",
                        "state" => "TestState",
                        "postal_code" => "TestPostalCode",
                    ],
                    "webhook" => "https://5d94-2001-d08-d5-d722-5913-dc21-df5e-fea6.ngrok-free.app/api/orders/".$order->id."/payments",
                ],
            ]);

            $payment_request = json_decode($response->getBody()->getContents());
            $payment->payment_request_id = $payment_request->id;
            $payment->amount = $payment_request->amount;
            $payment->status = $payment_request->status;
            $payment->payment_request_url = $payment_request->url;
        } else {
            $response = $this->client->get($payment->payment_request_id);
            $payment_request = json_decode($response->getBody()->getContents());
            $payment->status = $request->status ?? $payment_request->status;
        }

        $payment->save();

        return $payment;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, OrderPayment $payment)
    {
        // $response = $this->client->get($payment->payment_request_id);
        // $payment_request = json_decode($response->getBody()->getContents());
        return $payment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order, OrderPayment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, OrderPayment $payment)
    {
        $response = $this->client->delete($payment->payment_request_id);
        $payment->delete();
        return $payment;
    }
}
