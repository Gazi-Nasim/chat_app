@extends('layout.main')
@section('contents')
<body>
    <div class="container pt-5">
        <div class="feed">
            <div class="post-form row">
                <div class="col-12 p-2">
                    <textarea class="form-control" id="caption" placeholder="Write your post..."></textarea>
                </div>
                <div class="col-6 p-2">
                    <input type="file" name="picture" id="picture" accept="image/*" class="form-control-file" id="image-upload">
                </div>
                <div class="col-6 p-2 text-right">
                    <button class="btn btn-primary" onclick="submitPost()">Post</button>
                </div>
            </div>

            <div class="post" id="newPost" style="display: none;"></div>

            <div id="postdata"></div>
            <div class="post">
                <div class="post-header">
                    <img src="assets/images/faces/10.jpg" alt="Profile Image" class="profile-image" />
                    <span class="username">John Lubbock</span>
                </div>

                <div class="post-content">
                    <img src="assets/images/posts/weather-2.jpg" alt="Post Image" class="post-image" />
                    <p class="caption">
                        Rest is not idleness, and to lie sometimes on the grass under
                        trees on a summer's day, listening to the murmur of the water, or
                        watching the clouds float across the sky, is by no means a waste
                        of time.
                    </p>
                </div>

                <div class="post-actions">
                    <i class="fas fa-heart" style="color: black;"></i> <!-- Like icon -->
                    <i class="fas fa-comment"></i> <!-- Comment icon -->
                    <i class="fas fa-share"></i> <!-- Share icon -->
                </div>
                <div class="comments">
                    <div class="comment">
                        <span class="comment-username">Wendell Berry:</span>
                        <span class="comment-text">For a time, I rest in the grace of the world, and am free.</span>
                    </div>
                    <!-- Additional comments can be dynamically added here -->
                </div>

                <div class="comment-input row">
                    <div class="col-9 p-2">
                        <input type="text" name='comment' class="form-control" placeholder="Write a comment...">
                    </div>
                    <div class="col-3 p-2">
                        <button class="btn btn-primary">Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection