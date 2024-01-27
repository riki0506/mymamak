<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;

class UserController extends Controller
{
    public function index(User $user)
    {
    return view('User.index')->with(['own_posts' => $user->getOwnPaginateByLimit()]);
    }
    
    public function likedPosts(User $user, Request $request)
    {
    // Retrieve the liked posts for the currently authenticated user
    $likedPosts = auth()->user()->likedPosts();

    // return view('User.liked-posts', compact('likedPosts'));
    
    if($request['sort'] == "created_at"){
        $likedPosts = $likedPosts->orderBy('created_at', 'desc')->paginate(5);
    }
    elseif($request['sort'] == "like"){
        $likedPosts = $likedPosts->withCount('likes')->orderByDesc('likes_count')->paginate(5);
    }
    else
    {
    // Default sorting if none of the conditions are met
        $likedPosts = $likedPosts->orderBy('created_at', 'desc')->paginate(5);
    }

    return view('User.liked-posts', compact('likedPosts'));
    }
    
    public function show(User $user, Request $request)
    {
         // Check if the authenticated user is viewing their own profile
        if (Auth::user() && Auth::user()->id === $user->id) {
            return redirect()->route('User.index'); // Redirect to the "my posts" page
        }
        
        $user = User::find($user->id); //idが、リクエストされた$userのidと一致するuserを取得
        
        if($request['sort'] == "created_at"){
            $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        }
        elseif($request['sort'] == "like"){
            $posts = Post::where('user_id', $user->id)->withCount('likes')->orderByDesc('likes_count')->paginate(5);
        }
        else
        {
        // Default sorting if none of the conditions are met
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        }
        
        return view('User.show', [
            'user_name' => $user->name, // $user名をviewへ渡す
            'posts' => $posts, // $userの書いた記事をviewへ渡す
            'user' => $user,
        ]);
    }  
    
    public function follow(User $user)
    {
        auth()->user()->following()->attach($user);
    
        return back()->with('success', 'You are now following ' . $user->name);
    }
    
    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user);
    
        return back()->with('success', 'You have unfollowed ' . $user->name);
    }
    
    public function follower(User $user)
    {
        
        $user = auth()->user();
        
        // dd($user->followers()->get());
        
        $followers = $user->followers()->get();
        $followings = $user->following()->get();
        
        return view('User.followers', [
            'followers' => $followers,
            'followings' => $followings,
            ]);
    }
}