<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('assets/js/jquery-3.6.1.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $(function() {
            axios.get('/posts')
                .then((response) => {
                    const pst = response.data.datas;
                    const posted_posts = pst.map((post) => {
                        // Mapping comments to an array of HTML strings
                        const commentsHTML = post.comnts.map((fComn) => `
                            <div class="comment" >
                                <span class="comment-username">Wendell Berry:</span>
                                <span class="comment-text"  >${fComn.comment}</span>
                            </div>

                        `).join(''); // Join the comment HTML strings into a single string

                        // Creating the complete post HTML
                        return `
                        <div class="post">
                            <div class="post-header">
                                <img src="assets/images/faces/10.jpg" alt="Profile Image" class="profile-image" />
                                <span class="username">John Lubbock</span>
                            </div>

                            <div class="post-content">
                                <img src="assets/images/posts/${post.picture}" alt="Post Image" class="post-image">
                                <p class="caption">${post.caption}</p>
                            </div>

                            <div class="post-actions">
                                <i class="fas fa-heart" id="post-${post.id}" onclick="updateReaction(${post.id})" style="color: ${post.reacts.length > 0 ? post.reacts[0].reaction : ''} ;" ></i>
                                <i class="fas fa-comment"></i>
                                <i class="fas fa-share"></i>
                            </div>

                            <div class="comments" id="comments_${post.id}" >
                                ${commentsHTML} <!-- Insert the comments HTML here -->
                            </div>

                            <div class="comment-input row">
                                <div class="col-9 p-2">
                                    <input type="text" name="mess" id="${post.id}_co" class="form-control comnt mess" placeholder="Write a comment...">
                                </div>

                                <div class="col-3 p-2">
                                    <button class="btn btn-primary" onclick="SaveComment(${post.id})">Post</button>
                                </div>
                            </div> 
                        </div> `;
                    });

                    $("#postdata").append(posted_posts.join('')); // Join the post HTML strings and append
                    $("#newPost").slideDown();
                });
        });
    });

    function submitPost() {
        const caption = document.getElementById('caption').value;
        const imageInput = document.getElementById('picture');
        const picture = imageInput.files[0];
        const formData = new FormData();
        formData.append('caption', caption);
        formData.append('picture', picture);

        axios.post('/posts', formData, {
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            .then((response) => {
                const post = response.data.data;
                const newPost = `
                    <div class="post">
                        <div class="post-header">
                            <img src="assets/images/faces/10.jpg" alt="Profile Image" class="profile-image">
                            <span class="username">John Lubbock</span>
                        </div>

                        <!-- Display the newly created post -->
                        <div class="post-content">
                            <img src="assets/images/posts/${post.picture}" alt="Post Image" class="post-image">
                            <p class="caption">${post.caption}</p>
                        </div>
                        <div class="post-actions" >
                            <i class="fas fa-heart" id="post-${post.id}" onclick="updateReaction(${post.id})"  ></i>
                            <i class="fas fa-comment"></i>
                            <i class="fas fa-share"></i>
                            <!-- Add other actions as needed -->
                        </div>

                        <div class="comments">
                            <span id="comments_${post.id}">
                                <!-- Additional comments can be dynamically added here -->

                            </span>
                        </div>

                        <div class="comment-input row">
                            <div class="col-9 p-2">
                                <input type="text" name="mess" id="${post.id}_co" class="form-control comnt mess" placeholder="Write a comment...">
                            </div>

                            <div class="col-3 p-2">
                                <button class="btn btn-primary" onclick="SaveComment(${post.id})">Post</button>
                            </div>
                        </div>
                    </div>
                `;
                // Append the new post to the feed
                $("#newPost").prepend(newPost);
                $("#newPost").slideDown();
                $("#caption").val("");
                $("#picture").val("");
            })
            .catch((error) => {
                console.log(error);
            });
    }

    function updateReaction(postId) {
        const heartIcon = $(`#post-${postId}`);
        console.log(heartIcon);
        if (heartIcon.css('color') === 'rgb(255, 0, 0)') {
            // If current color is red, set to none
            const newColor = 'black';
            axios.post(`/reactions`, {
                    reaction: newColor,
                    post_id: postId,
                })
                .then((response) => {
                    // console.log(`Reaction cancelled for post ${postId}`);
                    heartIcon.css('color', newColor);
                })
                .catch((error) => {
                    console.log(error);
                });
        } else {
            // If current color is none, set to red
            const newColor = 'red';
            axios.post(`/reactions`, {
                    reaction: newColor,
                    post_id: postId,
                })
                .then((response) => {
                    // console.log(`Reaction added to post ${postId}`);
                    heartIcon.css('color', newColor);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }


    // function updateReaction(postId) {

    //     axios.post(`/reactions`, {
    //             reaction: 'red',
    //             post_id: postId,
    //         })
    //         .then((response) => {
    //             const post = response.data.data;
    //             console.log(post.reaction);
    //             const heartIcon = $(`#post-${postId}`);
    //             heartIcon.css('color', post.reaction);
    //         })
    //         .catch((error) => {
    //             console.log(error);
    //         });

    //     // After successful reaction update, fetch the latest posts again
    //     // fetchLatestPosts();
    // }

    function SaveComment(postId) {
        const comnt = document.getElementById(postId + '_co').value;
        const formData = new FormData();
        formData.append('post_id', postId);
        formData.append('comment', comnt);
        axios.post('comments', formData)
            .then((res) => {
                const comnts = res.data.data.comment;
                const cmnt = `
                    <div class="comment">
                        <span class="comment-username">Wendell Berry:</span>
                        <span class="comment-text">${comnts}</span>
                    </div> `;
                $("#comments_" + postId).prepend(cmnt);
                $("#" + postId + "_co").val('');
            });
    }
</script>

</html>