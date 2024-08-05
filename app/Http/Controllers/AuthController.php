<?php

namespace App\Http\Controllers;

use Firebase\JWT\Key;
use Illuminate\Http\Request;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public $key = "todak";
    public $algorithm = "HS256";

    public function signUp(Request $request) {

        $user = User::where("email", $request->email)->first();

        if($user) {
            return ["message" => "email taken"];
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone_number = $request->phone_number ?? "";
        $user->address = $request->address ?? "";
        $user->role =   $request->role ?? "Customer";
        $user->save();

        return ["message" => "signed up"];
    }

    public function signIn(Request $request) {
        $user = User::where("email", $request->email)->first();
        if(!$user) {
            return ["message" => "invalid email"];
        }

        if(!(\Hash::check($request->password, $user->password))) {
            return ["message" => "invalid password"];
        }

        $token = JWT::encode(["id" => $user->id, "role" => $user->role], $this->key, $this->algorithm);

        Cookie::queue("token", $token, 60);

        return [
            "token" => $token,
        ];
    }

    public function signOut(Request $request) {
        // $token = str_replace("Bearer ", "", $request->header("Authorization"));
        // $decoded = JWT::decode($token, new Key($this->key, $this->algorithm));
        // return $token;
        return ["message" => "signed out"];
    }
}
