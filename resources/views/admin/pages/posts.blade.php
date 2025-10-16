@extends('admin.layout')
@section('content')
    <section class="h-full w-full grid grid-cols-9 gap-3 mt-3 overflow-y-auto ">
        <div class="col-span-2 flex w-full flex-col gap-3">
            <div class="bg-white w-full rounded-lg p-4 shadow-sm">
                @include('admin.sidebar')
            </div>
        </div>
        <div class="col-span-7 flex w-full flex-col gap-3">
            <div class="bg-white w-full rounded-lg p-6 shadow-md">
                @if ($posts && count($posts) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-[900px] border border-gray-200 rounded-lg">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                                <tr>
                                    <th class="px-4 py-3 text-left">#</th>
                                    <th class="px-4 py-3 text-left">Title</th>
                                    <th class="px-4 py-3 text-left">Author</th>
                                    <th class="px-4 py-3 text-left">Comments</th>
                                    <th class="px-4 py-3 text-left">Created At</th>
                                    <th class="px-4 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm divide-y divide-gray-100">
                                @foreach ($posts as $index => $post)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 font-medium">{{ $post->title }}</td>
                                        <td class="px-4 py-3">{{ $post->user->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 rounded-md text-xs font-medium text-green-700">
                                                {{ $post->post_comments_count ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">{{ $post->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button
                                                        class="view-btn px-3 py-1 text-blue-600 hover:bg-blue-100 rounded-md border border-blue-500 transition text-xs"
                                                        data-id="{{ $post->id }}">View</button>
                                                    <button
                                                        class="edit-btn px-3 py-1 text-yellow-600 hover:bg-yellow-100 rounded-md border border-yellow-500 transition text-xs"
                                                        data-id="{{ $post->id }}">Edit</button>
                                                    <button
                                                        class="delete-btn px-3 py-1 text-red-600 hover:bg-red-100 rounded-md border border-red-500 transition text-xs"
                                                        data-id="{{ $post->id }}">Delete</button>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-gray-500 text-sm text-center py-6">
                        No posts found.
                    </div>
                @endif
            </div>

        </div>
        <div id="viewModal" class="hidden fixed inset-0 bg-white/10 backdrop-blur-sm bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg w-full max-w-2xl p-6 overflow-y-auto max-h-[90vh]">
                <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Post Details</h2>
                <div id="viewContent"></div>
                <div class="mt-4 text-right">
                    <button id="viewClose"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition">Close</button>
                </div>
            </div>
        </div>


        <!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-white/10 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-xl w-full max-w-md p-6 relative">
        <h2 class="text-2xl font-bold mb-5 text-gray-800 dark:text-gray-100">Edit Post</h2>

        <form id="editForm" class="space-y-4">
            @csrf
            <input type="hidden" name="post_id" id="editPostId">

            <div>
                <label for="editTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Title</label>
                <input type="text" name="title" id="editTitle" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-600 dark:text-gray-100 dark:focus:ring-yellow-500 transition" placeholder="Enter post title">
            </div>

            <div>
                <label for="editContent" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Content</label>
                <textarea name="content" id="editContent" rows="5" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-600 dark:text-gray-100 dark:focus:ring-yellow-500 transition" placeholder="Enter post content"></textarea>
            </div>

            <div class="flex justify-end gap-3 mt-3">
                <button type="button" id="editClose" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">Update</button>
            </div>
        </form>
    </div>
</div>


    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            // CSRF setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $('.view-btn').click(function() {
    let id = $(this).data('id');
    $.get(`/admin/posts/${id}`, function(data) {

        // Post Author Avatar
        let authorAvatar = '';
        if (data.user.avatar) {
            authorAvatar = `<img src="${data.user.avatar}" alt="avatar" class="w-12 h-12 rounded-full object-cover border border-gray-300">`;
        } else {
            let firstLetter = data.user.name ? data.user.name.charAt(0).toUpperCase() : '?';
            authorAvatar = `<div class="w-12 h-12 rounded-full bg-gray-400 flex items-center justify-center text-white font-bold border border-gray-300">${firstLetter}</div>`;
        }

        // Render Comments
        let commentsHtml = '';
        if (data.post_comments.length > 0) {
            commentsHtml = data.post_comments.map(c => {
                let commentAvatar = '';
                if (c.user && c.user.avatar) {
                    commentAvatar = `<img src="${c.user.avatar}" alt="avatar" class="w-8 h-8 rounded-full object-cover border border-gray-300">`;
                } else {
                    let letter = c.user && c.user.name ? c.user.name.charAt(0).toUpperCase() : '?';
                    commentAvatar = `<div class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center text-white font-bold border border-gray-300">${letter}</div>`;
                }
                return `<div class="flex items-center gap-2 mb-2">
                            ${commentAvatar}
                            <div class="text-gray-800 dark:text-gray-100">
                                <p class="text-sm font-medium">${c.user ? c.user.name : 'N/A'}</p>
                                <p class="text-sm">${c.comment}</p>
                            </div>
                        </div>`;
            }).join('');
        } else {
            commentsHtml = `<p class="text-gray-500 dark:text-gray-300 text-sm">No comments found.</p>`;
        }

        $('#viewContent').html(`
            <div class="flex items-center gap-4 mb-4">
                ${authorAvatar}
                <div>
                    <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">${data.user.name}</p>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">${data.created_at}</p>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-gray-700 dark:text-gray-100 font-semibold mb-1">Title:</p>
                <p class="text-gray-800 dark:text-gray-200">${data?.title}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-700 dark:text-gray-100 font-semibold mb-1">Content:</p>
                <p class="text-gray-800 dark:text-gray-200">${data.content}</p>
            </div>

            <div>
                <p class="text-gray-700 dark:text-gray-100 font-semibold mb-2">Comments:</p>
                ${commentsHtml}
            </div>
        `);

        $('#viewModal').removeClass('hidden');
    });
});

$('#viewClose').click(function() {
    $('#viewModal').addClass('hidden');
});


            $('#viewClose').click(function() {
                $('#viewModal').addClass('hidden');
            });

            $('.edit-btn').click(function() {
                let id = $(this).data('id');
                $.get(`/admin/posts/${id}/edit`, function(data) {
                    $('#editPostId').val(data.id);
                    $('#editTitle').val(data.title);
                    $('#editContent').val(data.content);
                    $('#editModal').removeClass('hidden');
                });
            });

            $('#editClose').click(function() {
                $('#editModal').addClass('hidden');
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();
                let id = $('#editPostId').val();
                $.ajax({
                    url: `/admin/posts/${id}`,
                    method: 'PUT',
                    data: {
                        title: $('#editTitle').val(),
                        content: $('#editContent').val(),
                    },
                    success: function(res) {
                        alert(res.message);
                        location.reload();
                    },
                    error: function(err) {
                        alert('Update failed!');
                    }
                });
            });

            $('.delete-btn').click(function() {
                if (!confirm('Are you sure to delete this post?')) return;
                let id = $(this).data('id');
                $.ajax({
                    url: `/admin/posts/${id}`,
                    method: 'DELETE',
                    success: function(res) {
                        alert(res.message);
                        location.reload();
                    },
                    error: function(err) {
                        alert('Delete failed!');
                    }
                });
            });

        });
    </script>
@endpush
