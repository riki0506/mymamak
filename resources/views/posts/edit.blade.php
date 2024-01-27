<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--<head>-->
    <!--    <meta charset="utf-8">-->
    <!--    <title>Blog</title>-->
        <!-- Fonts -->
    <!--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">-->
    <!--</head>-->
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit: {{ $post->title }}
            </h2>
        </x-slot>
    <body class="antialiased">
        
        <div class="mx-auto max-w-xl rounded bg-white overflow-hidden shadow-lg mt-4 relative">
          <img class="w-full" src="{{ $post->image_url }}" alt="画像が読み込めません。">
          <div class="px-6 py-4">
            <div class="flex items-start mb-2">
                <div class="profile icon">
                    <a href="{{ route('User.show', $post->user_id)}}" class="text-dark">
                        <i class="fas fa-user-circle fa-3x mr-1"></i>
                    </a>  
                </div>
                <div class="user-info">
                    <div>
                        <a href="{{ route('User.show', $post->user_id)}}"
                            class="text-gray-900">
                            {{ $post->user->name }}
                        </a>
                    </div>
                    <div class="text-gray-900">
                        {{ $post->created_at->format('Y/m/d H:i') }}
                    </div>
                </div>
              </div>
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="title">
                    <h2>Title</h2>
                    <input type="text" name=post[title] placeholder="Title" value={{ $post->title }}>
                    <p class='title__error' style="color:red">{{ $errors->first('post.title') }} </p>
                </div>
                <div class="body">
                    <h2>Body</h2>
                    <textarea name="post[body]" placeholder="This is body">{{ $post->body }}</textarea>
                    <p class='body__error' style="color:red">{{ $errors->first('post.body') }} </p>
                </div>
                <div class="country">
                <h2>Country</h2>
                <select name="post[country_id]">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                or
                <input type="text" name="new_country" placeholder="Enter new country">
                </div>
                <br>
                <div class="restaurant">
                <h2>Restaurant</h2>
                <select name="post[restaurant_id]">
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                    @endforeach
                </select>
                or
                <input type="text" name="new_restaurant" placeholder="Enter new restaurant">
            <!--<br>-->
            <!--    <h3>Address</h3>-->
            <!--    <input type="text" name="restaurant_address" placeholder="Enter restaurant address">-->
                </div>
                <br>
                <div class="dish">
                <h2>Dish</h2>
                <select name="post[dish_id]">
                    @foreach($dishes as $dish)
                        <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                    @endforeach
                </select>
                or
                <input type="text" name="new_dish" placeholder="Enter new dish">
                </div>
                <br>
                <div class="image">
                    <input type="file" name="image">
                </div>
                <input type="submit" value="update">
            </form>

              </div>
        </div>
        <div class="footer mb-4 ml-4 mt-4">
            <x-primary-button>
                <a href='/'>Back</a>
            </x-primary-button>
        </div>
    </body>
    </x-app-layout>
</html>