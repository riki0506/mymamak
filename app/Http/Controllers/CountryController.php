<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Post;

class CountryController extends Controller
{
    public function index(Request $request, Country $country, Post $posts)
    {
        if($request['sort'] == "created_at"){
            $posts = Country::posts()->with('country')->orderBy('created_at', 'desc')->paginate(5);
            return view('countries.index')->with(['country' => $country, 'posts' => $posts]);

            // return view('countries.index')->with(['country' => $country, 'posts' => $country->getByCountry(5,'date')]);
        }
        elseif($request['sort'] == "like"){
            $posts = Post::with('country')->orderByDesc('likes_count')->paginate(5);
            return view('countries.index')->with(['country' => $country, 'posts' => $posts]);
            // return view('countries.index')->with(['country' => $country, 'posts' => $country->getByCountry(5, 'like')]);
        }
        else
        {
        // Default sorting if none of the conditions are met
            $posts = Post::with('country')->orderBy('created_at', 'desc')->paginate(5);
            return view('countries.index')->with(['country' => $country, 'posts' => $posts]);

            // return view('countries.index')->with(['country' => $country, 'posts' => $country->getByCountry(5, 'date')]);
        }
    }
    
    // public function index(Request $request, Country $country)
    // {
    // $sortOptions = ['created_at', 'title', 'like']; // Add 'like' as an option

    // $sort = $request->input('sort');
    // $posts = $country->getPaginateByLimit(5, in_array($sort, $sortOptions) ? $sort : 'updated_at');

    // return view('countries.index', compact('posts'));
    // }
}
