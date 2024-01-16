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
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <p class='body'>{{ $post->body }}</p>
                    <a href="/countries/{{ $post->country->id }}">{{ $post->country->name }}</a><br>
                    <a href="/restaurants/{{ $post->restaurant->id }}">{{ $post->restaurant->name }}</a><br>
                    <a href="/dishes/{{ $post->dish->id }}">{{ $post->dish->name }}</a><br>
                    <a href="{{ route('User.show', $post->user_id)}}">{{ $post->user->name }}</a>
                </div>
                <br>
            @endforeach
        </div>
        <div class='paginate'>{{ $posts->links()}}</div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>