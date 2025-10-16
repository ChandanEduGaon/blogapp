@php
    $segment = request()->segment(2); // first segment of URL
@endphp

<div class="flex flex-col text-sm gap-3">
    <a href="{{ url('/admin') }}">
        <div
            class="flex gap-1 items-center py-2 px-3 rounded-md {{ $segment == '' ? 'bg-gray-500 text-white' : 'hover:bg-gray-400 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <rect width="24" height="24" fill="none" />
                <path fill="{{ $segment == '' ? '#fff' : '#b5b5b5' }}" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z" />
            </svg> Dashboard
        </div>
    </a>
    <a href="{{ url('/admin/posts') }}">
        <div
            class="flex gap-1 items-center py-2 px-3 rounded-md {{ $segment == 'posts' ? 'bg-gray-500 text-white' : 'hover:bg-gray-400 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <rect width="24" height="24" fill="none" />
                <path fill="{{ $segment == 'posts' ? '#fff' : '#b5b5b5' }}"
                    d="M8 5.5h8a3 3 0 0 0 3-3a.5.5 0 0 0-.5-.5h-13a.5.5 0 0 0-.5.5a3 3 0 0 0 3 3m8 13H8a3 3 0 0 0-3 3a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5a3 3 0 0 0-3-3"
                    opacity="0.5" />
                <path fill="#b5b5b5"
                    d="M5 11.5c0-1.886 0-2.828.586-3.414S7.114 7.5 9 7.5h6c1.886 0 2.828 0 3.414.586S19 9.614 19 11.5v1c0 1.886 0 2.828-.586 3.414S16.886 16.5 15 16.5H9c-1.886 0-2.828 0-3.414-.586S5 14.386 5 12.5z" />
            </svg>Posts
        </div>
    </a>
    <a href="{{ url('/admin/users') }}">
        <div
            class="flex gap-1 items-center py-2 px-3 rounded-md {{ $segment == 'users' ? 'bg-gray-500 text-white' : 'hover:bg-gray-400 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 576 512">
                <rect width="576" height="512" fill="none" />
                <path fill="{{ $segment == 'users' ? '#fff' : '#b5b5b5' }}"
                    d="M224 128a64 64 0 1 1 128 0a64 64 0 1 1-128 0m-48 208c0-61.9 50.1-112 112-112s112 50.1 112 112v8c0 13.3-10.7 24-24 24H200c-13.3 0-24-10.7-24-24zm216-192a56 56 0 1 1 112 0a56 56 0 1 1-112 0m27.2 100.4c9.1-2.9 18.8-4.4 28.8-4.4c53 0 96 43 96 96v10.7c0 11.8-9.6 21.3-21.3 21.3h-78.8c2.7-7.5 4.1-15.6 4.1-24v-8c0-34.1-10.6-65.7-28.8-91.6m-262.4 0c-18.2 26-28.8 57.5-28.8 91.6v8c0 8.4 1.4 16.5 4.1 24H53.3c-11.7 0-21.3-9.6-21.3-21.3V336c0-53 43-96 96-96c10 0 19.7 1.5 28.8 4.4M72 144a56 56 0 1 1 112 0a56 56 0 1 1-112 0M0 440c0-13.3 10.7-24 24-24h528c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24"
                    stroke-width="13" stroke="#b5b5b5" />
            </svg> Users
        </div>
    </a>
</div>
