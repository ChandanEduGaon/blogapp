<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blog App</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gray-200 flex items-center justify-center min-h-screen">

    <div class="bg-gray-50 p-8 rounded-xl shadow-lg w-full max-w-sm border border-gray-200">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login to Your Account</h2>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.check') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
                <input type="email" value="{{ old('email') }}" name="email" id="email"
                    class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:outline-none"
                    placeholder="Enter your email" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="password">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:outline-none"
                    placeholder="Enter your password" required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    <span>Remember me</span>
                </label>
                <a href="#" class="text-sm text-gray-600 hover:underline">
                    Forgot Password?
                </a>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-700 transition duration-200 font-semibold">
                Login
            </button>
        </form>

        <a href="{{ route('google.auth') }}"
            class="flex items-center justify-center gap-2 bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-700 hover:bg-gray-50 hover:shadow transition-all w-max mt-2 md:w-auto">
            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-5 h-5">
            <span class="text-sm font-medium">Continue with Google</span>
        </a>

        <a href="{{ route('facebook.auth') }}"
            class="flex items-center justify-center gap-2 bg-[#1877F2] text-white rounded-lg px-4 py-2 hover:bg-[#166FE5] hover:shadow transition-all w-max mt-2 md:w-auto">
            <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook" class="w-5 h-5">
            <span class="text-sm font-medium">Continue with Facebook</span>
        </a>


        <!-- Register Redirect -->
        <p class="text-center text-sm text-gray-600 mt-5">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-gray-800 font-semibold hover:underline">Register</a>
        </p>


    </div>

</body>

</html>
