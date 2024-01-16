<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>
    <body class="antialiased">
        <!-- Display user profile details -->
        <div>
            <p>Followers: <a href="{{ route('User.followers', Auth::user()) }}">{{ Auth::user()->followers->count() }}</a></p>
            <p>Following: <a href="{{ route('User.followers', Auth::user()) }}">{{ Auth::user()->following->count() }}</a></p>
        </div>
    </body>
    <div class="own_posts">
        @foreach ($own_posts as $post)
            <div class='post'>
                <h2 class='title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <p class='body'>{{ $post->body }}</p>
                <a href="/countries/{{ $post->country->id }}">{{ $post->country->name }}</a><br>
                <a href="/restaurants/{{ $post->restaurant->id }}">{{ $post->restaurant->name }}</a><br>
                <a href="/dishes/{{ $post->dish->id }}">{{ $post->dish->name }}</a><br>
            </div>
            <div class='edit'>
                <a href="/posts/{{ $post->id }}/edit"> edit </a>
            </div>
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})"> delete</button>
            </form>
            <br>
        @endforeach
   
        <div class='paginate'>
            {{ $own_posts->links() }}
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
        {{ Auth::user()->name }}
    </div>

</x-app-layout>