<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Follower/Following Page
        </h2>
    </x-slot>
    
    <body class="antialiased">

    <div class="flex mx-auto max-w-4xl min-w-xl h-28 mb-4 mt-4 bg-white">
        <div class="user-stats p-4">
            <div class="user-name font-semibold text-xl">{{ auth()->user()->name }}</div>
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
    <br>

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
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Unfollow</button>
                            </form>
                        @else
                            <form method="post" action="{{ route('User.follow', $follower) }}">
                                @csrf
                                <button type="submit" class="text-blue-700 bg-white border border-blue-700 hover:bg-blue-800 hover:text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Follow</button>
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
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Unfollow</button>
                            </form>
                        @else
                            <form method="post" action="{{ route('User.follow', $following) }}">
                                @csrf
                                <button type="submit" class="text-blue-700 bg-white border border-blue-700 hover:bg-blue-800 hover:text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Follow</button>
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
    
    </body>
</x-app-layout>