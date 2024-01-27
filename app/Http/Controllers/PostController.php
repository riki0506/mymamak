<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Country;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Like;
use App\Models\User;
use Cloudinary;

use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    // public function index(Request $request, Post $post)
    public function index(Request $request, Post $posts)
    {
        if($request['sort'] == "created_at"){
            $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        }
        elseif($request['sort'] == "like"){
            $posts = Post::withCount('likes')->orderByDesc('likes_count')->paginate(5);
        }
        else
        {
        // Default sorting if none of the conditions are met
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        }

        return view('posts.index', compact('posts'));


    }
    
    public function show(Post $post)
    {
        // Check if the user is logged in
        if (auth()->check()) {
            $like = Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        } else {
            $like = null; // If the user is not logged in, set $like to null
    }

    return view('posts.show', compact('post', 'like'));
}
    public function create(Country $country, Restaurant $restaurant, Dish $dish)
    {
        return view('posts.create')->with(['countries' => $country->get(), 'restaurants' => $restaurant->get(), 'dishes' => $dish->get()]);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        
        $input = $request['post'];

        if($request->file('image')){
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_url' => $image_url];
        }
        
        if ($request->filled('new_country')) {
        // Create a new country
        $newCountry = Country::create([
            'name' => $request->input('new_country'),
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
    
    public function edit(Post $post, Country $country, Restaurant $restaurant, Dish $dish)
    {
        return view('posts/edit')->with(['post' => $post, 'countries' => $country->get(), 'restaurants' => $restaurant->get(), 'dishes' => $dish->get()]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        
        if($request->file('image')){
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input_post += ['image_url' => $image_url];
        }
        
        if ($request->filled('new_country')) {
        // Create a new country
        $newCountry = Country::create([
            'name' => $request->input('new_country'),
            ]);
            
        // Update the request with the new country ID
        $input_post['country_id'] = $newCountry->id;
        }
        
        if ($request->filled('new_restaurant')) {
        // Create a new restaurant
        $newRestaurant = Restaurant::create(['name' => $request->input('new_restaurant')]);

        // Update the request with the new restaurant ID
        $input_post['restaurant_id'] = $newRestaurant->id;
        }
        
        if ($request->filled('new_dish')) {
        // Create a new dish
        $newDish = Dish::create(['name' => $request->input('new_dish')]);

        // Update the request with the new dish ID
        $input_post['dish_id'] = $newDish->id;
        }
        
        $post->fill($input_post)->save();
        return redirect('/posts/'.$post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function like($id)
    {
    Like::create([
      'post_id' => $id,
      'user_id' => Auth::id(),
    ]);

    session()->flash('success', 'You Liked the Post.');

    return redirect()->back();
    }
    
    public function unlike($id)
    {
    $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();
    $like->delete();

    session()->flash('success', 'You Unliked the Post.');

    return redirect()->back();
    }
    
    public function __construct()
    {
    $this->middleware('auth')->only(['create', 'store', 'like', 'unlike']);
    }
}
