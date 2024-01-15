<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
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
}
