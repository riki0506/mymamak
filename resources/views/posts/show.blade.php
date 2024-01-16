<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--<head>-->
    <!--    <meta charset="utf-8">-->
    <!--    <title>Blog</title>-->
        <!-- Fonts -->
    <!--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">-->
    <!--</head>-->
    <x-app-layout>
    <body class="antialiased">
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div class="content">
            <div class="content__post">
                <h3>Body:</h3>
                <p>{{ $post->body }}</p>    
            </div>
            <div>
                <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
            </div>
            <a href="/countries/{{ $post->country->id }}">{{ $post->country->name }}</a><br>
            <a href="/restaurants/{{ $post->restaurant->id }}">{{ $post->restaurant->name }}</a><br>
            <a href="/dishes/{{ $post->dish->id }}">{{ $post->dish->name }}</a><br>
            <a href="{{ route('User.show', $post->user_id)}}">{{ $post->user->name }}</a>
        </div>
        <span>
            @if(Auth::check())
                <!-- もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
                @if($like)
                    <!-- 「いいね」取消用ボタンを表示 -->
                    <a href="{{ route('unlike', $post) }}" class="btn bg-green-400 text-white py-1.5 px-4 rounded-full">
                        いいね
                        <!-- 「いいね」の数を表示 -->
                        <span class="badge">
                            {{ $post->likes->count() }}
                        </span>
                    </a>
                @else
                    <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                    <a href="{{ route('like', $post) }}" class="btn bg-gray-300 text-white py-1.5 px-4 rounded-full">
                        いいね
                        <!-- 「いいね」の数を表示 -->
                        <span class="badge">
                            {{ $post->likes->count() }}
                        </span>
                    </a>
                @endif
            @else
                <!-- ユーザーがログインしていない場合、ログインページにリダイレクト -->
                <a href="{{ route('login') }}" class="btn bg-gray-300 text-white py-1.5 px-4 rounded-full">
                    ログインしていいね！
                </a>
            @endif
        </span>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>

