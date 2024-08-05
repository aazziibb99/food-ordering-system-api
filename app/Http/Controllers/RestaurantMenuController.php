<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;

class RestaurantMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Restaurant $restaurant)
    {
        return RestaurantMenu::where("restaurant_id", $restaurant->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $menu = new RestaurantMenu();
        $menu->restaurant_id = $restaurant->id;
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->category = $request->category;
        $menu->save();

        return $menu;
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant, RestaurantMenu $menu)
    {
        return $menu;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant, RestaurantMenu $menu)
    {
        $menu->name = $request->name ?? $menu->name;
        $menu->description = $request->description ?? $menu->description;
        $menu->price = $request->price ?? $menu->price;
        $menu->category = $request->category ?? $menu->category;
        $menu->save();

        return $menu;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant, RestaurantMenu $menu)
    {
        $menu->delete();
        return $menu;
    }
}
