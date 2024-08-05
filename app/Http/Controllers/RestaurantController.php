<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($user = request()->attributes->get("user")) {
            if($user->role == "Manager") {
                return Restaurant::where("manager_id", $user->id)->get();
            }
        }

        return Restaurant::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->category = $request->category;
        $restaurant->address = $request->address;
        $restaurant->phone_number = $request->phone_number;
        $restaurant->status = "Pending";
        $restaurant->manager_id = request()->attributes->get("user")->id;
        $restaurant->save();

        return $restaurant;
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return $restaurant;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant->name = $request->name ?? $restaurant->name;
        $restaurant->category = $request->category ?? $restaurant->category;
        $restaurant->address = $request->address ?? $restaurant->address;
        $restaurant->phone_number = $request->phone_number ?? $restaurant->phone_number;
        $restaurant->status = $request->status ?? $restaurant->status;
        $restaurant->manager_id = $request->manager_id ?? $restaurant->manager_id;
        $restaurant->save();

        return $restaurant;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return $restaurant;
    }
}
