<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public $key = "todak";
    public $algorithm = "HS256";

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = str_replace("Bearer ", "", $request->header("Authorization")) ?? "";

        if(!$token) {
            return response(["message" => "token unavailable"], 400);
        }

        try {
            $decoded = JWT::decode($token, new Key($this->key, $this->algorithm));
        } catch (\Exception $e) {
            return response(["message"=> "invalid token"], 400);
        }

        $request->attributes->set("user", $decoded);
        return $next($request);
    }
}
