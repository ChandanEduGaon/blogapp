<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Blog App</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen text-gray-700">

    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md border border-gray-100">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Create Account</h2>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register.save') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your name"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-gray-700 focus:border-gray-700 outline-none"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-gray-700 focus:border-gray-700 outline-none"
                />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-gray-700 focus:border-gray-700 outline-none"
                />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">Confirm Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Re-enter password"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-gray-700 focus:border-gray-700 outline-none"
                />
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 rounded-md transition-all duration-200"
            >
                Register
            </button>
            
        </form>

        

        <!-- Divider -->
        <div class="mt-6 border-t border-gray-200"></div>

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


        <!-- Login Redirect -->
        <p class="text-center text-sm text-gray-600 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-gray-800 font-semibold hover:underline">Login</a>
        </p>
    </div>

</body>

</html>
