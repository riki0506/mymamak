<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Country;
use App\Models\Restaurant;
use App\Models\Dish;
use Cloudinary;


class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    
    public function create(Country $country, Restaurant $restaurant, Dish $dish)
    {
        return view('posts/create')->with(['countries' => $country->get(), 'restaurants' => $restaurant->get(), 'dishes' => $dish->get()]);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        
        $input = $request['post'];

        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_url' => $image_url];
        
        if ($request->filled('new_country')) {
        // Create a new country
        $newCountry = Country::create([
            'name' => $request->input('new_country'),
            'address' => $request->input('post.address'),
            ]);
            
        // Update the request with the new country ID
        $input['country_id'] = $newCountry->id;
        }
        
        if ($request->filled('new_restaurant')) {
        // Create a new restaurant
        $newRestaurant = Restaurant::create(['name' => $request->input('new_restaurant')]);

        // Update the request with the new restaurant ID
        $input['restaurant_id'] = $newRestaurant->id;
        }
        
        if ($request->filled('new_dish')) {
        // Create a new dish
        $newDish = Dish::create(['name' => $request->input('new_dish')]);

        // Update the request with the new dish ID
        $input['dish_id'] = $newDish->id;
        }
        
        $input += ['user_id' => $request->user()->id];
        $post->fill($input)->save();
        return redirect('/posts/'.$post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/'.$post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function __construct()
    {
    $this->middleware('auth')->only(['create', 'store']);
    }
}
