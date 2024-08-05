<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $model): Response
    {
        $checkFor = $model;
        $user = request()->attributes->get("user");
        $model = request()->route()->parameter($model);

        if($model && $user->role != "Administrator"){
            if($model->manager_id && $model->manager_id != $user->id) {
                return response(["message" => "forbidden"], 403);
            }
            
            if($model->customer_id && $model->customer_id != $user->id) {
                return response(["message" => "forbidden"], 403);
            }
        }

        if($model && $model->restaurant_id && request()->route()->parameter("restaurant") && $model->restaurant_id != request()->route()->parameter("restaurant")->id) {
            return response(["message" => "menu does not exist in this restaurant"], 404);
        }

        if($model && $model->order_id && request()->route()->parameter("order") && $model->order_id != request()->route()->parameter("order")->id) {
            return response(["message" => "item does not exist in this order"], 404);
        }

        return $next($request);
    }
}
