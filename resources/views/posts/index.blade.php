<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
        <x-slot name="header">
            Index
        </x-slot>
        <body class="antialiased">
            <h1>Mymamak Blog</h1>
            <a href='/posts/create'>create</a>
            <div class='posts-grid'>
                @foreach ($posts as $post)
                    <div class='post'>
                        <div class='post-container'>
                            <h2 class='title'>
                                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                            </h2>
                            <p class='body'>{{ $post->body }}</p>
                            <a href="/countries/{{ $post->country->id }}">{{ $post->country->name }}</a><br>
                            <a href="/restaurants/{{ $post->restaurant->id }}">{{ $post->restaurant->name }}</a><br>
                            <a href="/dishes/{{ $post->dish->id }}">{{ $post->dish->name }}</a><br>
                            <a href="{{ route('User.show', $post->user_id)}}">{{ $post->user->name }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class='paginate'>{{ $posts->links()}}</div>
            <style>
                .posts-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 20px;
                }

                .post {
                    border-radius: 10px; /* Adjust the border-radius for rounded corners */
                    overflow: hidden; /* Ensure content doesn't overflow rounded corners */
                    background-color: #fff; /* Set background color to white */
                    transition: transform 0.3s ease-in-out; /* Add a smooth transition for the hover effect */
                }

                .post:hover {
                    transform: scale(1.05); /* Increase the size on hover */
                }

                .post-container {
                    padding: 15px;
                }
            </style>
        </body>
    </x-app-layout>
</html>