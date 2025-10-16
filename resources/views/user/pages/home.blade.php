@extends('user.layout')
@section('content')
    <section class="h-full w-full grid grid-cols-9 gap-3 mt-3 overflow-y-auto ">

        <!-- Profile -->
        <div class="col-span-2 flex flex-col gap-3">
            <div class="bg-white rounded-lg p-4 shadow-sm flex flex-col items-center justify-center">
                <div class="h-20 w-20 rounded-full bg-gray-700 overflow-hidden flex items-center justify-center">
                    @if (Auth::user() && Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="user-avatar" class="w-full h-full object-cover">
                    @else
                        <span class="text-white text-2xl font-semibold">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </span>
                    @endif
                </div>

                <h1 class="text-lg font-semibold">{{ Auth::user()->name ?? 'Jhon Deo' }}</h1>
                <p class="text-xs text-gray-800 mt-1">{{ Auth::user()->email ?? 'example@gmail.com' }}</p>
                <p class="text-xs text-gray-500 mt-1 text-center">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, voluptatem?
                </p>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-sm flex flex-col items-center justify-center gap-2">
                <div class="flex w-full justify-between items-center p-1">
                    <span class="text-xs font-semibold ">Total blogs</span>
                    <span class="text-xs font-semibold text-blue-600">{{ $posts ?? 0 }}</span>
                </div>
                <div class="flex w-full justify-between items-center p-1">
                    <span class="text-xs font-semibold ">Top blogs</span>
                    <span class="text-xs font-semibold text-blue-600">0</span>
                </div>
                <div class="flex w-full justify-between items-center p-1">
                    <span class="text-xs font-semibold ">Deleted blogs</span>
                    <span class="text-xs font-semibold text-red-600">{{ $deleted_posts ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- Posts -->
        <div class="col-span-7 flex flex-col gap-3" id="postListContainer">
            <div class="bg-white rounded-lg p-4 shadow-sm flex items-center justify-between">
                <div class="flex items-center justify-center gap-2">
                    <div class="h-8 w-8 rounded-full bg-gray-700 overflow-hidden flex items-center justify-center">
                        @if (Auth::user() && Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="user-avatar" class="w-full h-full object-cover">
                        @else
                            <span class="text-white text-2xl font-semibold">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center px-2 border border-gray-400 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <rect width="24" height="24" fill="none" />
                            <path fill="none" stroke="#364153" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m20 20l-4.05-4.05m0 0a7 7 0 1 0-9.9-9.9a7 7 0 0 0 9.9 9.9" />
                        </svg>
                        <input type="text" class="h-full text-sm border-none outline-none  py-2 px-2 "
                            placeholder="Search">
                    </div>
                </div>
                <button id="openCreate"
                    class="rounded-full text-xs py-2 cursor-pointer px-4 bg-gray-700 hover:bg-gray-600 text-white">Create
                    Post</button>


            </div>
            <div id="createPostModal"
                class="bg-white hidden rounded-lg shadow-sm border border-gray-200 p-3 hover:shadow-md transition-all duration-300 w-full mx-auto">

                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-lg font-semibold text-gray-700">Create a New Post</h2>
                    <svg id="closeCreate" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                        viewBox="0 0 24 24" class="hover:text-gray-500 cursor-pointer">
                        <rect width="24" height="24" fill="none" />
                        <path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
                    </svg>
                </div>

                <form id="postCreateForm" class="space-y-2">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" id="title" name="title"
                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-lg text-gray-700 placeholder-gray-400 
                       focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent"
                            placeholder="Enter your post title" required>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea id="content" name="content" rows="5"
                            class="w-full px-3 py-2 border text-sm border-gray-300 rounded-lg text-gray-700 placeholder-gray-400 
                       focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent resize-none"
                            placeholder="Write your thoughts..." required></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-1">
                        <button type="reset" id="formReset"
                            class="px-4 text-xs py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition cursor-pointer">
                            Clear
                        </button>
                        <button type="submit"
                            class="px-4 text-xs py-2 cursor-pointer bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition font-semibold">
                            Post
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex flex-col gap-3" id="postList">

            </div>
        </div>


        <!-- Post Details -->
        <div class=" flex flex-col gap-3" id="postDetail">

        </div>
        <!-- Post Edit -->
        <div class="" id="postEdit">

        </div>




    </section>
@endsection

@push('script')
    <script>
        let focusedPost = 0;

        function fetchPosts() {
            $('#postList').html('')
            $.ajax({
                type: "GET",
                url: "{{ route('post.list') }}",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        const data = response.data;
                        if (data.length > 0) {
                            let html = '';
                            data.forEach(element => {
                                html += `<div
                                class="bg-white rounded-lg cursor-pointer shadow-sm p-4 hover:shadow-md transition-all duration-300 post" data-post="${element?.id}">
                                <div class="flex justify-between items-center mb-2">
                                    <div>
                                        <h2 class="text-lg font-semibold text-gray-800 hover:text-blue-600 cursor-pointer">
                                            ${element?.title}
                                        </h2>
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            by <span class="font-medium text-gray-700">${element?.user?.name}</span> •
                                            <span>${formatDate(element?.created_at)}</span>
                                        </p>
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v.01M12 12v.01M12 18v.01" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    ${element?.content}
                                </p>

                                <div class="flex items-center justify-between mt-3 text-xs text-gray-500">
                                    <div class="flex items-center gap-3">
                                        <button class="flex items-center gap-1 hover:text-blue-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 15l7-7 7 7" />
                                            </svg>
                                            Like
                                        </button>
                                        <button class="flex items-center gap-1 hover:text-green-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8h2a2 2 0 012 2v9l-4-4H7a2 2 0 01-2-2V6a2 2 0 012-2h8" />
                                            </svg>
                                            Comment
                                        </button>
                                    </div>
                                    <span class="text-gray-400">2 min read</span>
                                </div>
                            </div>`
                            });
                            $('#postList').append(html)
                        } else {
                            $('#postList').html(
                                '<p class="text-xs text-center text-gray-500">No any post created yet!</p>')
                        }
                    }
                },
                error: function(xhr) {

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            const messages = Object.values(errors).flat().join("\n");
                            showToast(messages, 'error');
                        } else {
                            showToast("Validation failed!", 'error');
                        }
                    } else if (xhr.status === 401) {
                        showToast("Please login", 'error');
                    } else {
                        showToast("Something went wrong!", 'error');
                    }

                }
            });
        }

        function addComment(id) {
            const comment = $('#commentText').val()
            const data = {
                '_token': "{{ csrf_token() }}",
                "post_id": id,
                "comment": comment
            }

            $.ajax({
                type: "POST",
                url: "{{ route('create.comment') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        showDetails(response.data.post_id, true)
                    } else {
                        showToast("Something wrong!", 'error')
                    }

                },
                error: function(xhr) {

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            const messages = Object.values(errors).flat().join("\n");
                            showToast(messages, 'error');
                        } else {
                            showToast("Validation failed!", 'error');
                        }
                    } else if (xhr.status === 401) {
                        showToast("Please login", 'error');
                    } else {
                        showToast("Something went wrong!", 'error');
                    }

                }
            });

        }

        function showDetails(id, refresh = false) {
            if (focusedPost === id && !refresh) {
                return false;
            }
            $('#postDetail').html('')
            $.ajax({
                type: "GET",
                url: "{{ route('post.detail') }}",
                data: {
                    "post_id": id
                },
                dataType: "json",
                success: function(response) {

                    $('#postDetail').addClass('col-span-3')
                    $('#postListContainer').removeClass('col-span-7')
                    $('#postListContainer').addClass('col-span-4')

                    if (response.success) {
                        focusedPost = id
                        const post = response.data
                        const comments = post.post_comments


                        const author = post.user
                        let html = ``;
                        let commentsHtml = '';

                        comments.forEach(comment => {
                            commentsHtml += `
                                <div class="flex items-start gap-2 ">
                                    <div class="bg-gray-50 rounded-md p-3 w-full">
                                        
                                        <div class="flex items-center gap-1">

                                            <div class="h-7 w-7 rounded-full bg-gray-700 overflow-hidden flex items-center justify-center text-white font-semibold">
                                                ${comment?.user?.avatar
                                                    ? `<img src="${comment.user.avatar}" alt="user-avatar" class="w-full h-full object-cover">`
                                                    : `${comment?.user?.name?.charAt(0).toUpperCase() ?? '?'}`}
                                                </div>

                                            <div class="flex flex-col items-start">
                                                <h3 class="text-xs font-semibold text-gray-800">${comment.user.name}</h3>
                                            <span class="text-xs text-gray-400">${formatDate(comment.created_at)}</span>
                                                </div>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">${comment.comment}</p>
                                         <div class="flex justify-end items-center gap-1">
                                            <button onclick="deleteComment(${comment?.id})"
                                                class="text-xs cursor-pointer text-white py-1 px-4 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 12 12">
                                                    <rect width="12" height="12" fill="none" />
                                                    <path fill="#f00" d="M5 3h2a1 1 0 0 0-2 0M4 3a2 2 0 1 1 4 0h2.5a.5.5 0 0 1 0 1h-.441l-.443 5.17A2 2 0 0 1 7.623 11H4.377a2 2 0 0 1-1.993-1.83L1.941 4H1.5a.5.5 0 0 1 0-1zm3.5 3a.5.5 0 0 0-1 0v2a.5.5 0 0 0 1 0zM5 5.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5M3.38 9.085a1 1 0 0 0 .997.915h3.246a1 1 0 0 0 .996-.915L9.055 4h-6.11z" />
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>`;
                        });

                        html += `<section
                                        class="w-full mx-auto bg-white rounded-lg shadow-sm border p-4 border-b-5 border-r-5 border-green-500">
                                        <!-- Meta Info -->
                                        <div class="flex items-center gap-1 text-sm text-gray-500 mb-2">
                                           <div class="h-10 w-10 rounded-full bg-gray-700 overflow-hidden flex items-center justify-center text-white font-semibold">
                                                ${post?.user?.avatar
                                                    ? `<img src="${post.user.avatar}" alt="user-avatar" class="w-full h-full object-cover">`
                                                    : `${post?.user?.name?.charAt(0).toUpperCase() ?? '?'}`}
                                                </div>
                                            <div class="flex items-center gap-2">
                                                <div>
                                                    <p class="font-medium text-gray-700">${post?.user?.name}</p>
                                                    <p class="text-xs text-gray-400">${formatDate(post?.created_at)} • 5 min read</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Title -->
                                        <h1 class="text-2xl font-bold text-gray-800 leading-tight mb-2">
                                            ${post?.title}
                                        </h1>
                                        <!-- Content -->
                                        <article class="prose prose-sm sm:prose-base max-w-none text-gray-700 leading-relaxed">
                                            <p class="text-sm text-gray-600 leading-relaxed ">
                                                ${post?.content}
                                            </p>
                                        </article>
                                        ${post?.user?.id == '{{ Auth::user()->id ?? 0 }}' ? `<div class="flex justify-between items-center  mt-2">
                                                                                                        <p class="text-xs text-gray-500">Posted by you </p>
                                                                                                        <div class="flex gap-1 items-center">
                                                                                                            <button onclick="showEdit(${post?.id})"
                                                                                                                class="text-xs cursor-pointer text-white py-1 px-1 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                                                <rect width="24" height="24" fill="none" />
                                                                                <path fill="#00f" fill-rule="evenodd" d="M21.455 5.416a.75.75 0 0 1-.096.943l-9.193 9.192a.75.75 0 0 1-.34.195l-3.829 1a.75.75 0 0 1-.915-.915l1-3.828a.8.8 0 0 1 .161-.312L17.47 2.47a.75.75 0 0 1 1.06 0l2.829 2.828a1 1 0 0 1 .096.118m-1.687.412L18 4.061l-8.518 8.518l-.625 2.393l2.393-.625z" clip-rule="evenodd" />
                                                                                <path fill="#00f" d="M19.641 17.16a44.4 44.4 0 0 0 .261-7.04a.4.4 0 0 1 .117-.3l.984-.984a.198.198 0 0 1 .338.127a46 46 0 0 1-.21 8.372c-.236 2.022-1.86 3.607-3.873 3.832a47.8 47.8 0 0 1-10.516 0c-2.012-.225-3.637-1.81-3.873-3.832a46 46 0 0 1 0-10.67c.236-2.022 1.86-3.607 3.873-3.832a48 48 0 0 1 7.989-.213a.2.2 0 0 1 .128.34l-.993.992a.4.4 0 0 1-.297.117a46 46 0 0 0-6.66.255a2.89 2.89 0 0 0-2.55 2.516a44.4 44.4 0 0 0 0 10.32a2.89 2.89 0 0 0 2.55 2.516c3.355.375 6.827.375 10.183 0a2.89 2.89 0 0 0 2.55-2.516" />
                                                                            </svg></button>
                                                                                                            <button onclick="deletePost(${post?.id})"
                                                                                                                class="text-xs cursor-pointer text-white py-1 px-1 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 12 12">
                                                                                <rect width="12" height="12" fill="none" />
                                                                                <path fill="#f00" d="M5 3h2a1 1 0 0 0-2 0M4 3a2 2 0 1 1 4 0h2.5a.5.5 0 0 1 0 1h-.441l-.443 5.17A2 2 0 0 1 7.623 11H4.377a2 2 0 0 1-1.993-1.83L1.941 4H1.5a.5.5 0 0 1 0-1zm3.5 3a.5.5 0 0 0-1 0v2a.5.5 0 0 0 1 0zM5 5.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5M3.38 9.085a1 1 0 0 0 .997.915h3.246a1 1 0 0 0 .996-.915L9.055 4h-6.11z" />
                                                                            </svg></button>
                                                                                                        </div>
                                                                                                    </div>` : ''}

                                        <!-- Comments Section -->
                                        <section class="mt-6">
                                            <h2 class="text-lg font-semibold text-gray-800 mb-3">Comments</h2>

                                            <!-- Add Comment Box -->
                                            <div class="flex items-start gap-3 mb-1">
                                                <textarea id="commentText" placeholder="Write a comment..."
                                                    class="w-full border border-gray-300 rounded-md p-2 text-sm resize-y outline-none" rows="1"></textarea>
                                            </div>
                                            <button class="bg-gray-700 w-full text-white text-sm cursor-pointer px-4 py-1.5 rounded-sm  transition"
                                                onclick="addComment(${post?.id})">
                                                Post Comment
                                            </button>

                                            <!-- Comment List -->
                                            <div class="mt-6 space-y-4" id="commentsList">
                                                ${commentsHtml}
                                            </div>
                                        </section>
                                    </section>`

                        $('#postDetail').append(html)

                    }

                }
            });
        }

        function showEdit(id, refresh = false) {
            $.ajax({
                type: "GET",
                url: "{{ route('post.detail') }}",
                data: {
                    post_id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        const post = response.data;

                        let html = `
                            <div class="z-40 fixed top-0 left-0 backdrop-blur-sm bg-black/10 w-screen h-screen flex items-center justify-center" id="updatePostModalOverlay">
                                <div id="updatePostModal" class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 w-full max-w-md transition-all duration-300">
                                    <div class="flex items-center justify-between mb-4">
                                        <h2 class="text-lg font-semibold text-gray-700">Edit Post</h2>
                                        <button id="closeUpdate" class="text-gray-500 hover:text-gray-700">&times;</button>
                                    </div>

                                    <form id="postUpdateForm" class="space-y-4">
                                        <input type="hidden" name="post_id" value="${post.id}">

                                        <div>
                                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                            <input type="text" id="title" name="title" value="${post.title}"
                                                class="w-full px-3 py-2 border text-sm border-gray-300 rounded-lg text-gray-700 placeholder-gray-400 
                                                focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent" required>
                                        </div>

                                        <div>
                                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                                            <textarea id="content" name="content" rows="5"
                                                class="w-full px-3 py-2 border text-sm border-gray-300 rounded-lg text-gray-700 placeholder-gray-400 
                                                focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent resize-none" required>${post.content}</textarea>
                                        </div>

                                        <div class="flex justify-end space-x-2">
                                            <button type="reset"
                                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition" id="formReset2">Clear</button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition font-semibold">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>`;

                        // Append modal to body
                        $('body').append(html);

                        // Show modal
                        $('#updatePostModal').removeClass('hidden');

                        // Close modal
                        $('#closeUpdate').on('click', function() {
                            $('#updatePostModalOverlay').remove();
                        });

                        // Handle form submit
                        $('#postUpdateForm').on('submit', function(e) {
                            e.preventDefault();

                            const formData = {};
                            $(this).serializeArray().forEach(field => {
                                formData[field.name] = field.value.trim();
                            });
                            formData['_token'] = "{{ csrf_token() }}";

                            $.ajax({
                                type: "POST",
                                url: "{{ route('post.update') }}",
                                data: formData,
                                dataType: "json",
                                success: function(response) {
                                    if (response.success) {
                                        $('#formReset2').click();
                                        showToast(response.message, 'success');
                                        showDetails(formData.post_id);
                                        fetchPosts();
                                        $('#closeUpdate').click()
                                    }
                                },
                                error: function(xhr) {

                                    if (xhr.status === 422) {
                                        const errors = xhr.responseJSON?.errors;
                                        if (errors) {
                                            const messages = Object.values(errors).flat()
                                                .join("\n");
                                            showToast(messages, 'error');
                                        } else {
                                            showToast("Validation failed!", 'error');
                                        }
                                    } else {
                                        showToast("Something went wrong!", 'error');
                                    }

                                }
                            });
                        });
                    }
                }
            });
        }

        function deletePost(id) {
            if (!confirm("Are you sure you want to delete this post?")) {
                return;
            }

            $.ajax({
                type: "GET",
                url: "{{ route('post.delete') }}",
                data: {
                    post_id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        console.log(response);
                        $('#postDetail').html('');
                        fetchPosts();
                        $('#postDetail').removeClass('col-span-3')
                        $('#postListContainer').removeClass('col-span-4')
                        $('#postListContainer').addClass('col-span-7')
                        showToast(response.message, 'success');
                    } else {
                        showToast(response.message || 'Failed to delete post', 'error');
                    }
                },
                error: function() {
                    showToast("Something went wrong!", 'error');
                }
            });
        }

        function deleteComment(id) {

            $.ajax({
                type: "GET",
                url: "{{ route('comment.delete') }}",
                data: {
                    comment_id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        showDetails(response.data.post_id, true)
                        showToast(response.message, 'success');
                    } else {
                        showToast(response.message || 'Failed to delete post', 'error');
                    }
                },
                error: function() {
                    showToast("Something went wrong!", 'error');
                }
            });
        }


        $(document).ready(function() {

            fetchPosts();
            // Open modal
            $("#openCreate").on("click", function() {
                $("#overlay, #createPostModal").removeClass("hidden");
            });

            // Close modal
            $("#closeCreate, #cancelBtn").on("click", function() {
                $("#overlay, #createPostModal").addClass("hidden");
            });

            // Handle form submit
            $("#postCreateForm").on("submit", function(e) {
                e.preventDefault();

                const formData = {};
                $(this).serializeArray().forEach(field => {
                    formData[field.name] = field.value.trim();
                });
                formData['_token'] = "{{ csrf_token() }}";
                $.ajax({
                    type: "POST",
                    url: "{{ route('post.create') }}",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#formReset').click();
                            showToast(response.message, 'success');
                            fetchPosts();
                        }
                    },
                    error: function(xhr) {

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                const messages = Object.values(errors).flat()
                                    .join("\n");
                                showToast(messages, 'error');
                            } else {
                                showToast("Validation failed!", 'error');
                            }
                        } else {
                            showToast("Something went wrong!", 'error');
                        }

                    }
                });

            });

            $(document).on("click", ".post", function() {
                $(".post").removeClass("border-b-5 border-r-5 border-green-500");
                const postId = $(this).data("post");
                $(this).addClass("border-b-5 border-r-5 border-green-500");
                showDetails(postId)

            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.Echo.channel('posts')
                .listen('.post.created', (event) => {
                    const title = event.post.title
                    const user = event.post.user
                    showToast(`${user} Just Created a Post : ${title}`, "success")
                });
        });
    </script>
@endpush
