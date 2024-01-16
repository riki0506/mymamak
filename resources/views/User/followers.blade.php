<x-app-layout>
    <x-slot name="header">
        Follower/Following Page
    </x-slot>

    <div class="button-container">
        <button onclick="showContent('followers')">Followers</button>
        <button onclick="showContent('followings')">Following</button>
    </div>

    <div id="followers" class="content">
        <!-- Content for followers goes here -->
        <ul>
            @if ($followers->count() > 0)
                @foreach($followers as $follower)
                    <li>{{ $follower->name }}</li>
                @endforeach
            @else
                <p>No followers.</p>
            @endif
        </ul>
    </div>

    <div id="followings" class="content">
        <!-- Content for followings goes here -->
        <ul>
            @if ($followings->count() > 0)
                @foreach($followings as $following)
                    <li>{{ $following->name }}</li>
                @endforeach
            @else
                <p>Not following anyone.</p>
            @endif
        </ul>
    </div>

    <script>
        document.getElementById('followers').style.display = 'block';
        document.getElementById('followings').style.display = 'none';


        function showContent(contentId) {
            // Hide all content divs
            var contents = document.querySelectorAll('.content');
            contents.forEach(function(content) {
                content.style.display = 'none';
            });

            // Show the selected content
            var selectedContent = document.getElementById(contentId);
            if (selectedContent) {
                selectedContent.style.display = 'block';
            }
        }
    </script>
</x-app-layout>