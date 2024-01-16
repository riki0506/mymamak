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
    
    public function likedPosts(User $user)
    {
    // Retrieve the liked posts for the currently authenticated user
    $likedPosts = auth()->user()->likedPosts;

    return view('User.liked-posts', compact('likedPosts'));
    }
    
    public function show(User $user)
    {
         // Check if the authenticated user is viewing their own profile
        if (Auth::user() && Auth::user()->id === $user->id) {
            return redirect()->route('User.index'); // Redirect to the "my posts" page
        }
        
        $user = User::find($user->id); //idが、リクエストされた$userのidと一致するuserを取得
        $posts = Post::where('user_id', $user->id) //$userによる投稿を取得
            ->orderBy('created_at', 'desc') // 投稿作成日が新しい順に並べる
            ->paginate(10); // ページネーション; 
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