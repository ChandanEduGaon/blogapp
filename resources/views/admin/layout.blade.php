<!DOCTYPE html>
<html lang="en" class="bg-gray-800">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Blog App</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body class="lg:max-w-[1000px] md:max-w-[800px] mx-auto h-screen">
    <div id="toast" class="fixed top-5 right-5 hidden bg-gray-800 text-white px-4 py-2 rounded shadow-lg z-50"></div>

    <nav class="h-14 bg-white rounded-lg backdrop-blur-md shadow-sm flex justify-between items-center px-6">
        {{-- Left: Logo --}}
        <div class="text-xl font-semibold text-gray-800">
            <a href="{{ url('/') }}" class="hover:text-blue-600 transition">Admin Pannel - BlogApp</a>
        </div>


        {{-- Right: Auth Buttons --}}
        <div class="flex items-center gap-1">
            @auth
                <span class="text-sm text-gray-700">
                    Hello, {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="text-sm bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition cursor-pointer">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="text-sm border border-gray-300 text-gray-700 px-3 py-1 rounded-md hover:bg-gray-100 transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="text-sm border bg-gray-700 text-white px-3 py-1 rounded-md hover:bg-gray-700 transition">
                    Register
                </a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
    {{-- <footer>
        Footer
    </footer> --}}

    <script>
        function formatDate(dateInput) {
            const date = new Date(dateInput); // Accept string, timestamp, or Date object
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            return date.toLocaleDateString('en-US', options);
        }

        function showToast(message, type = 'success') {
            const toast = $("#toast");
            toast.removeClass("bg-green-600 bg-red-600 bg-gray-800");

            if (type === 'success') toast.addClass("bg-green-600");
            else if (type === 'error') toast.addClass("bg-red-600");
            else toast.addClass("bg-gray-800");

            toast.text(message).fadeIn();

            setTimeout(() => {
                toast.fadeOut();
            }, 3000);
        }
    </script>

    @stack('script')
</body>

</html>
