<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liked Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Posts you have liked:</h3>

                    @if($likedPosts->count() > 0)
                        <ul>
                            @foreach ($likedPosts as $post)
                                <div class='post'>
                                    <h2 class='title'>
                                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                                    </h2>
                                    <p class='body'>{{ $post->body }}</p>
                                    <a href="/countries/{{ $post->country->id }}">{{ $post->country->name }}</a><br>
                                    <a href="/restaurants/{{ $post->restaurant->id }}">{{ $post->restaurant->name }}</a><br>
                                    <a href="/dishes/{{ $post->dish->id }}">{{ $post->dish->name }}</a><br>
                                    <small>{{ $post->user->name }}</small>
                                </div>
                                <br>
                            @endforeach
                        </ul>
                    @else
                        <p>You haven't liked any posts yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>