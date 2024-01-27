<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--<head>-->
    <!--    <meta charset="utf-8">-->
    <!--    <title>Blog</title>-->
    <!--</head>-->
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a new Post
            </h2>
        </x-slot>
    <body class="antialiased">
        <!--<form action="/posts" method="POST" enctype="multipart/form-data">-->
        <!--    @csrf-->
        <!--    <div class="title">-->
        <!--        <h2>Title</h2>-->
        <!--        <input type="text" name="post[title]" placeholder="タイトル" value={{ old('post.title') }}>-->
        <!--        <p class='title__error' style="color:red">{{ $errors->first('post.title') }}</p>-->
        <!--    </div>-->
        <!--    <div class="body">-->
        <!--        <h2>Body</h2>-->
        <!--        <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>-->
        <!--        <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>-->
        <!--    </div>-->
        <!--    <div class="country">-->
        <!--        <h2>Country</h2>-->
        <!--        <select name="post[country_id]">-->
        <!--            @foreach($countries as $country)-->
        <!--                <option value="{{ $country->id }}">{{ $country->name }}</option>-->
        <!--            @endforeach-->
        <!--        </select>-->
        <!--        or-->
        <!--        <input type="text" name="new_country" placeholder="Enter new country">-->
        <!--        </div>-->
        <!--        <br>-->
        <!--        <div class="restaurant">-->
        <!--        <h2>Restaurant</h2>-->
        <!--        <select name="post[restaurant_id]">-->
        <!--            @foreach($restaurants as $restaurant)-->
        <!--                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>-->
        <!--            @endforeach-->
        <!--        </select>-->
        <!--        or-->
        <!--        <input type="text" name="new_restaurant" placeholder="Enter new restaurant">-->
            <!--<br>-->
            <!--    <h3>Address</h3>-->
            <!--    <input type="text" name="restaurant_address" placeholder="Enter restaurant address">-->
        <!--        </div>-->
        <!--        <br>-->
        <!--        <div class="dish">-->
        <!--        <h2>Dish</h2>-->
        <!--        <select name="post[dish_id]">-->
        <!--            @foreach($dishes as $dish)-->
        <!--                <option value="{{ $dish->id }}">{{ $dish->name }}</option>-->
        <!--            @endforeach-->
        <!--        </select>-->
        <!--        or-->
        <!--        <input type="text" name="new_dish" placeholder="Enter new dish">-->
        <!--    </div>-->
        <!--    <br>-->
        <!--    <div class="image">-->
        <!--        <input type="file" name="image">-->
        <!--    </div>-->
        <!--    <br>-->
        <!--    <input type="submit" value="store"/>-->
        <!--</form>-->
        
        <div class="mx-auto max-w-xl rounded-lg bg-white overflow-hidden shadow-lg mt-4 relative">
            <div class="px-6 py-4">
                <form action="/posts" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="title">
                        <h2>Title</h2>
                        <input type="text" name="post[title]" placeholder="Title" value={{ old('post.title') }}>
                        <p class='title__error' style="color:red">{{ $errors->first('post.title') }} </p>
                    </div>
                    <div class="body">
                        <h2>Body</h2>
                        <textarea name="post[body]" placeholder="Tell us about this dish!">{{ old('post.body') }}</textarea>
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
                        <input class="mb-4" type="file" name="image">
                    </div>
                    <x-primary-button2 type="submit" value="store">
                        Create
                    </x-primary-button2>
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