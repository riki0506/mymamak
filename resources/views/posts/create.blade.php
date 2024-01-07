<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--<head>-->
    <!--    <meta charset="utf-8">-->
    <!--    <title>Blog</title>-->
    <!--</head>-->
    <x-app-layout>
    <body>
        <h1>Blog Name</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value={{ old('post.title') }}>
                <p class='title__error' style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
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
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>