<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class DishController extends Controller
{
    // public function index(Dish $dish)
    // {
    //     return view('dishes.index')->with(['posts' => $dish->getByDish()]);
    // }
    
    public function index(Request $request, Dish $dish)
    {
        if($request['sort'] == "created_at"){
            return view('dishes.index')->with(['dish' => $dish, 'posts' => $dish->getByDish(5,'date')]);
        }
        elseif($request['sort'] == "like"){
            return view('dishes.index')->with(['dish' => $dish, 'posts' => $dish->getByDish(5, 'like')]);
        }
        else
        {
        // Default sorting if none of the conditions are met
            return view('dishes.index')->with(['dish' => $dish, 'posts' => $dish->getByDish(5, 'date')]);
        }
    }
}
