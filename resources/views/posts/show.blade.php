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
                {{ __($post->title) }}
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
            <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
            <p class="text-gray-700 text-base mb-2">{{ $post->body }}</p>
          </div>
          <div class="flex w-full justify-items-stretch px-6 gap-3 mb-2">
            <div class="font-semibold"><a href="/countries/{{ $post->country->id }}">Country: {{ $post->country->name }}</a></div>
            <div class="font-semibold"><a href="/restaurants/{{ $post->restaurant->id }}">Restaurant: {{ $post->restaurant->name }}</a></div>
            <div class="font-semibold"><a href="/dishes/{{ $post->dish->id }}">Dish: {{ $post->dish->name }}</a></div>
          </div>
          @if(Auth::id() != $post->user_id)
            @if(Auth::check())
                 <!--もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
                @if($post->is_liked_by_auth_user())
                     <!--「いいね」取消用ボタンを表示 -->
                    <div class="flex px-6">
                    <a href="{{ route('unlike', $post) }}" class="mb-2 text-white bg-blue-700 border border-blue-700 hover:bg-white hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue dark:text-white dark:hover:text-blue-700 dark:focus:ring-blue-800 dark:hover:bg-white">
                      <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                          <path d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z"/>
                      </svg>
                      <span class="sr-only">Icon description</span>
                         <!--「いいね」の数を表示 -->
                      <span class="badge ml-1">
                          {{ $post->likes->count() }}
                      </span>
                    </a>
                    </div>
                @else
                     <!--まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                    <div class="flex px-6">
                    <a href="{{ route('like', $post) }}" class="mb-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                      <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                      <path d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z"/>
                      </svg>
                      <span class="sr-only">Icon description</span>
                         <!--「いいね」の数を表示 -->
                      <span class="badge ml-1">
                          {{ $post->likes->count() }}
                      </span>
                    </a>
                    </div>
                @endif
            @else
                 <!--ユーザーがログインしていない場合、ログインページにリダイレクト -->
                <div class="flex px-6">
                <a href="{{ route('login') }}" class="mb-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                      login to like! &nbsp;
                      <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                      <path d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z"/>
                      </svg>
                      <span class="sr-only">Icon description</span>
                         <!--「いいね」の数を表示 -->
                      <span class="badge ml-1">
                          {{ $post->likes->count() }}
                      </span>
                </a>
                </div>
            @endif
        @endif
        </div>

    </body>
    
        <div class="footer mb-4 ml-4 mt-4">
            <x-primary-button>
                <a href='/'>Back</a>
            </x-primary-button>
        </div>
    </x-app-layout>
</html>

