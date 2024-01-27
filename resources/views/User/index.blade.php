<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>
    
    <body class="antialiased">
        <!-- Display user profile details -->
    <div class="flex mx-auto max-w-4xl min-w-xl h-28 mb-4 mt-4 bg-white">
        <div class="user-stats p-4">
            <div class="user-name font-semibold text-xl">{{ auth()->user()->name }}</div>
            <div class="post-count">Posts: {{ auth()->user()->posts()->count() }}</div>
            <div class="followers-following-count">
                Followers: <a href="{{ route('User.followers', Auth::user()) }}">{{ Auth::user()->followers->count() }}</a> |
                Following: <a href="{{ route('User.followers', Auth::user()) }}">{{ Auth::user()->following->count() }}</a>
            </div>
        </div>
    </div>
    
    <div class="flex mx-auto max-w-7xl min-w-4xl mb-4 mt-4 items-stretch justify-between">
        <div>
        <form action="{{ route('index') }}">    
            <select name="sort" onchange="this.form.submit()" class="form-control">
                <option value="">Sort By</option>
                <option value="created_at">Date</option>
                <option value="like">Likes</option>
                <input type="hidden" name="formName" value="sort">
            </select>
        </form>
        </div>
        <div>
            <x-primary-button2>
                <a href='/posts/create'>create</a>
            </x-primary-button2>
        </div>
    </div>
            
    @foreach ($own_posts as $post)
          <div class="flex mx-auto max-w-7xl min-w-4xl h-80 bg-white shadow-lg rounded-lg overflow-hidden relative mb-4 hover:scale-105">
            <a href="/posts/{{ $post->id }}" class="w-1/3 bg-cover">
                <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
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
                <p class="text-gray-600 text-base">{{ $post->body }}</p>
              </div>
              </div>
            <x-primary-button class="absolute bottom-10 right-40">
                <a href="/posts/{{ $post->id }}/edit">Edit</a>
            </x-primary-button>
            
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <x-danger-button class="absolute bottom-10 right-10" onclick="deletePost({{ $post->id }})"> delete</x-danger-button>
            </form>
            </div>
    @endforeach
   
        <div class='paginate'>
            {{ $own_posts->links('vendor.pagination.tailwind2') }}
        </div>
        
        <script>
            function deletePost(id) {
                'use sctrict'
                
                if(confirm('Are you sure you want to delete this entry?')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        <br>
    </body>
</x-app-layout>