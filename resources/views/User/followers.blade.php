<x-app-layout>
    <x-slot name="header">
        Follower/Following Page
    </x-slot>
    
    <div class="user-stats-container">
        <div class="user-stats">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="post-count">Posts: {{ auth()->user()->posts()->count() }}</div>
            <div class="followers-following-count">
                Followers: {{ auth()->user()->followers()->count() }} |
                Following: {{ auth()->user()->following()->count() }}
            </div>
        </div>
    </div>



    <div class="button-container">
        <button id="followers-button" onclick="showContent('followers')" class="selected">Followers</button>
        <button id="followings-button" onclick="showContent('followings')">Following</button>
    </div>

    <div id="followers" class="content">
        <!-- Content for followers goes here -->
        <ul>
            @if ($followers->count() > 0)
                @foreach($followers as $follower)
                    <li class="user-item">
                        <span>{{ $follower->name }}</span>
                        
                        @if(auth()->user()->following->contains($follower))
                            <form method="post" action="{{ route('User.unfollow', $follower) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="follow-button unfollow">Unfollow</button>
                            </form>
                        @else
                            <form method="post" action="{{ route('User.follow', $follower) }}">
                                @csrf
                                <button type="submit" class="follow-button">Follow</button>
                            </form>
                        @endif
                    </li>
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
                    <li class="user-item">
                        <span>{{ $following->name }}</span>
                        
                        @if(auth()->user()->following->contains($following))
                            <form method="post" action="{{ route('User.unfollow', $following) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="follow-button unfollow">Unfollow</button>
                            </form>
                        @else
                            <form method="post" action="{{ route('User.follow', $following) }}">
                                @csrf
                                <button type="submit" class="follow-button">Follow</button>
                            </form>
                        @endif
                    </li>
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
    
            // Toggle class on the buttons
            var followersButton = document.getElementById('followers-button');
            var followingsButton = document.getElementById('followings-button');
    
            if (contentId === 'followers') {
                followersButton.classList.add('selected');
                followingsButton.classList.remove('selected');
            } else {
                followingsButton.classList.add('selected');
                followersButton.classList.remove('selected');
            }
        }
    </script>
    
    <style>
    
        .user-stats-container {
            width: 600px;
            height: 100px;
            margin: 20px auto; /* Center the container */
            background-color: #f0f0f0; /* Adjust the background color as needed */
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-stats {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 18px;
            font-weight: bold;
        }

        .post-count,
        .followers-following-count {
            margin-top: 10px;
            font-size: 14px;
        }
        
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px; /* Adjust the margin as needed */
        }
    
        .button-container button {
            width: 300px;
            height: 40px;
            margin: 0 10px; /* Adjust the margin as needed */
        }
    
        .selected {
            background-color: blue;
            color: white;
        }

        .content {
            display: none;
        }
    
        .user-list {
            list-style: none;
            padding: 0;
        }

        .user-item {
            text-align: center;
            margin-bottom: 20px; /* Adjust as needed */
        }

        .user-item {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 8px; /* Adjust as needed */
        }

        .user-item span {
            margin-right: 20px; /* Adjust as needed */
        
        }
    </style>
    
    
</x-app-layout>