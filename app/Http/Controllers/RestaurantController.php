<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    // public function index(Restaurant $restaurant)
    // {
    // return view('restaurants.index')->with(['posts' => $restaurant->getByRestaurant()]);
    // }
    
    public function index(Request $request, Restaurant $restaurant)
    {
        if($request['sort'] == "created_at"){
            return view('restaurants.index')->with(['restaurant' => $restaurant, 'posts' => $restaurant->getByRestaurant(5,'date')]);
        }
        elseif($request['sort'] == "like"){
            return view('restaurants.index')->with(['restaurant' => $restaurant, 'posts' => $restaurant->getByRestaurant(5, 'like')]);
        }
        else
        {
        // Default sorting if none of the conditions are met
            return view('restaurants.index')->with(['restaurant' => $restaurant, 'posts' => $restaurant->getByRestaurant(5, 'date')]);
        }
    }
}
