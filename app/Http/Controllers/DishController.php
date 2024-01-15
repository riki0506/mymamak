<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class DishController extends Controller
{
    public function index(Dish $dish)
    {
        return view('dishes.index')->with(['posts' => $dish->getByDish()]);
    }
}
