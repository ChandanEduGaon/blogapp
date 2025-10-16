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
                @if ($users && count($users) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-[1000px] border border-gray-200 rounded-lg">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                                <tr>
                                    <th class="px-4 py-3 text-left">#</th>
                                    <th class="px-4 py-3 text-left">Name</th>
                                    <th class="px-4 py-3 text-left">Email</th>
                                    <th class="px-4 py-3 text-left">Posts</th>
                                    <th class="px-4 py-3 text-left">Role</th>
                                    <th class="px-4 py-3 text-left">Joined</th>
                                    <th class="px-4 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm divide-y divide-gray-100">
                                @foreach ($users as $index => $user)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 font-medium flex items-center gap-2">
                                            <div
                                                class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-semibold overflow-hidden">
                                                @if ($user->avatar)
                                                    <img src="{{ $user->avatar }}" alt="user-avatar"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-white text-2xl font-semibold">
                                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <span>{{ $user->name }}</span>
                                        </td>
                                        <td class="px-4 py-3">{{ $user->email }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 rounded-md text-xs font-medium text-green-700">
                                                {{ $user->posts_count ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="px-2 py-1 rounded-md text-xs font-medium
                                {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">{{ $user->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button
                                                    class="view-btn px-3 py-1 text-blue-600 hover:bg-blue-100 rounded-md border border-blue-500 text-xs"
                                                    data-id="{{ $user->id }}">View</button>
                                                <button
                                                    class="edit-btn px-3 py-1 text-yellow-600 hover:bg-yellow-100 rounded-md border border-yellow-500 text-xs"
                                                    data-id="{{ $user->id }}">Edit</button>
                                                <button
                                                    class="delete-btn px-3 py-1 text-red-600 hover:bg-red-100 rounded-md border border-red-500 text-xs"
                                                    data-id="{{ $user->id }}">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-gray-500 text-sm text-center py-6">
                        No users found.
                    </div>
                @endif
            </div>

        </div>
        <div id="viewModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
            <div
                class="bg-white dark:bg-gray-700 rounded-lg shadow-xl w-full max-w-2xl p-6 max-h-[90vh] overflow-y-auto relative">
                <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">User Details</h2>
                <div id="viewContent"></div>
                <div class="mt-4 text-right">
                    <button id="viewClose"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500 transition">Close</button>
                </div>
            </div>
        </div>

        <div id="editModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-xl w-full max-w-md p-6 relative">
                <h2 class="text-2xl font-bold mb-5 text-gray-800 dark:text-gray-100">Edit User</h2>
                <form id="editForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="user_id" id="editUserId">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Name</label>
                        <input type="text" name="name" id="editName"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-600 dark:text-gray-100 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Email</label>
                        <input type="email" name="email" id="editEmail"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-600 dark:text-gray-100 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Role</label>
                        <select name="role" id="editRole"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 dark:bg-gray-600 dark:text-gray-100 transition">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 mt-3">
                        <button type="button" id="editClose"
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            // VIEW USER
            $('.view-btn').click(function() {
                let id = $(this).data('id');
                $.get(`/admin/users/${id}`, function(data) {
                    // Avatar
                    let avatarHtml = data.avatar ?
                        `<img src="${data.avatar}" class="w-12 h-12 rounded-full object-cover border border-gray-300">` :
                        `<div class="w-12 h-12 rounded-full bg-gray-400 flex items-center justify-center text-white font-bold border border-gray-300">${data.name.charAt(0).toUpperCase()}</div>`;

                    // Posts
                    let postsHtml = data.posts.length ? data.posts.map(p => `<li>${p.title}</li>`)
                        .join('') : '<li>No posts</li>';

                    $('#viewContent').html(`
                <div class="flex items-center gap-4 mb-4">
                    ${avatarHtml}
                    <div>
                        <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">${data.name}</p>
                        <p class="text-gray-500 dark:text-gray-300 text-sm">${data.email}</p>
                        <p class="text-gray-500 dark:text-gray-300 text-sm">Joined: ${data.created_at}</p>
                    </div>
                </div>
                <div>
                    <p class="font-semibold text-gray-700 dark:text-gray-100">Posts:</p>
                    <ul class="list-disc ml-6 text-gray-700 dark:text-gray-200">${postsHtml}</ul>
                </div>
            `);

                    $('#viewModal').removeClass('hidden');
                });
            });
            $('#viewClose').click(() => $('#viewModal').addClass('hidden'));

            // EDIT USER
            $('.edit-btn').click(function() {
                let id = $(this).data('id');
                $.get(`/admin/users/${id}/edit`, function(data) {
                    $('#editUserId').val(data.id);
                    $('#editName').val(data.name);
                    $('#editEmail').val(data.email);
                    $('#editRole').val(data.role);
                    $('#editModal').removeClass('hidden');
                });
            });
            $('#editClose').click(() => $('#editModal').addClass('hidden'));

            $('#editForm').submit(function(e) {
                e.preventDefault();
                let id = $('#editUserId').val();
                let formData = $(this).serialize();
                $.ajax({
                    url: `/admin/users/${id}`,
                    method: 'PUT',
                    data: formData,
                    success: function(res) {
                        alert(res.message);
                        location.reload(); // or update table row dynamically
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            // DELETE USER
            $('.delete-btn').click(function() {
                if (!confirm('Are you sure to delete this user?')) return;
                let id = $(this).data('id');
                $.ajax({
                    url: `/admin/users/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        alert(res.message);
                        location.reload();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

        });
    </script>
@endpush
