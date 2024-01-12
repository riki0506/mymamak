<x-app-layout>
    <div class="own_posts">
        @foreach($own_posts as $post)
            <div>
                <h4><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h4>
                <small>{{ $post->user->name }}</small>
                <p>{{ $post->body }}</p>
            </div>
            <div class='edit'>
                <a href="/posts/{{ $post->id }}/edit"> edit </a>
            </div>
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})"> delete</button>
            </form>
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