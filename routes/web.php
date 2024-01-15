<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DishController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/posts/{post}', [PostController::class ,'show']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [PostController::class, 'index'])->name('index');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    // Route::get('/', 'index')->name('index');
    Route::get('/posts/create', 'create')->name('create');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');

});

Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');

//Routing for each country, restaurant and dish
Route::get('/countries/{country}', [CountryController::class,'index']);
Route::get('/restaurants/{restaurant}', [RestaurantController::class,'index']);
Route::get('/dishes/{dish}', [DishController::class,'index']);


Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/liked-posts', [UserController::class, 'likedPosts'])->name('user.liked-posts')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// いいねボタン
    Route::get('/posts/like/{post}', [LikeController::class, 'like'])->name('like');
    Route::get('/posts/unlike/{post}', [LikeController::class, 'unlike'])->name('unlike');

require __DIR__.'/auth.php';
