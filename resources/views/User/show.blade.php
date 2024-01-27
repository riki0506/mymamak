<!-- users/{username}/posts.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $user_name }}'s Posts
        </h2>
    </x-slot>

        <body class="antialiased">
            
            <div class="flex mx-auto max-w-4xl min-w-xl h-24 mb-4 mt-4 bg-white relative">
                <div class="user-stats w-full p-4">
                    <div class="user-name">{{ $user_name }}</div>
                    <div class="post-count">Posts: {{ $user->posts()->count() }}</div>
                    <div class="followers-following-count">
                        Followers: {{ $user->followers()->count() }} |
                        Following: {{ $user->following()->count() }}
                    </div>
                </div>
                <div>
                    <!-- Follow/Unfollow button -->
                    @auth
                        @if(auth()->user()->isNot($user))
                            @if(auth()->user()->following->contains($user))
                                <form method="post" action="{{ route('User.unfollow', $user) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="absolute top-4 right-10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Unfollow</button>
                                </form>
                            @else
                                <form method="post" action="{{ route('User.follow', $user) }}">
                                    @csrf
                                    <button type="submit" class="absolute top-4 right-10 text-blue-700 bg-white border border-blue-700 hover:bg-blue-800 hover:text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Follow</button>
                                </form>
                            @endif
                        @endif
                    @endauth          
                </div>
            </div>
            
                <div class="flex mx-auto max-w-7xl min-w-4xl mb-4 mt-4">
                    <div>
                    <form action="{{ route('User.show', $user) }}">    
                        <select name="sort" onchange="this.form.submit()" class="form-control">
                            <option value="">Sort By</option>
                            <option value="created_at">Date</option>
                            <option value="like">Likes</option>
                            <input type="hidden" name="formName" value="sort">
                        </select>
                    </form>
                    </div>
                </div>
                
            @foreach ($posts as $post)
                  <div class="flex mx-auto max-w-7xl min-w-4xl h-90px bg-white shadow-lg rounded-lg relative mb-4 hover:scale-105">
                    <a href="/posts/{{ $post->id }}">
                        <img class="h-72 w-96 flex-none bg-cover object-cover lg:rounded-t-none lg:rounded-l text-center overflow-hidden" src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                    </a>
                    <div class="w-2/3 p-4">
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
                      <div class="title">
                        <h1 class="text-gray-900 font-bold text-2xl mb-2">{{ $post->title }}</h1>
                      </div>
                      <div class="body">
                        <p class="text-gray-600 text-lg">{{ $post->body }}</p>
                      </div>
                        <span>
                            @if(Auth::id() != $post->user_id)
                                @if(Auth::check())
                                     <!--もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
                                    @if($post->is_liked_by_auth_user())
                                         <!--「いいね」取消用ボタンを表示 -->
                                        <a href="{{ route('unlike', $post) }}" class="absolute bottom-10 right-20 text-white bg-blue-700 border border-blue-700 hover:bg-white hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue dark:text-white dark:hover:text-blue-700 dark:focus:ring-blue-800 dark:hover:bg-white">
                                          <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                              <path d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z"/>
                                          </svg>
                                          <span class="sr-only">Icon description</span>
                                             <!--「いいね」の数を表示 -->
                                          <span class="badge ml-1">
                                              {{ $post->likes->count() }}
                                          </span>
                                        </a>
                                    @else
                                         <!--まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                                        <a href="{{ route('like', $post) }}" class="absolute bottom-10 right-10 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                                          <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                          <path d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z"/>
                                          </svg>
                                          <span class="sr-only">Icon description</span>
                                             <!--「いいね」の数を表示 -->
                                          <span class="badge ml-1">
                                              {{ $post->likes->count() }}
                                          </span>
                                        </a>
                                    @endif
                                @else
                                     <!--ユーザーがログインしていない場合、ログインページにリダイレクト -->
                                    <a href="{{ route('login') }}" class="absolute bottom-10 right-10 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
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
                                @endif
                            @endif
                        </span>
                      </div>
                  </div>
            @endforeach
            
            {{ $posts->links('vendor.pagination.tailwind2') }}
            <br>
            
        </body>
    </x-app-layout>