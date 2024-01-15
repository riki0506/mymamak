<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(Restaurant $restaurant)
    {
    return view('restaurants.index')->with(['posts' => $restaurant->getByRestaurant()]);
    }
}
