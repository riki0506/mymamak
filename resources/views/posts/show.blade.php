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
        <small>{{ $post->user->name }}</small>
        <div class="content">
            <div class="content__post">
                <h3>Body:</h3>
                <p>{{ $post->body }}</p>    
            </div>
            <div>
                <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
            </div>
        </div>
        <span>
        @if(Auth::check())
        <!-- もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
        @if($like)
        <!-- 「いいね」取消用ボタンを表示 -->
        	<a href="{{ route('unlike', $post) }}" class="btn btn-success btn-sm">
        		いいね
        		<!-- 「いいね」の数を表示 -->
        		<span class="badge">
        			{{ $post->likes->count() }}
        		</span>
        	</a>
        @else
        <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
        	<a href="{{ route('like', $post) }}" class="btn btn-secondary btn-sm">
        		いいね
        		<!-- 「いいね」の数を表示 -->
        		<span class="badge">
        			{{ $post->likes->count() }}
        		</span>
        	</a>
        @endif
        @else
            <!-- ユーザーがログインしていない場合、ログインページにリダイレクト -->
        <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">
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

