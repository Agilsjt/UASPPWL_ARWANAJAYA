<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Arwana Jaya - Email Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .background-image {
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/M%C3%BCnster%2C_LVM%2C_B%C3%BCrogeb%C3%A4ude_--_2013_--_5149-51.jpg/1200px-M%C3%BCnster%2C_LVM%2C_B%C3%BCrogeb%C3%A4ude_--_2013_--_5149-51.jpg') no-repeat center center/cover;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            filter: brightness(30%);
            z-index: -1;
        }
    </style>
</head>
<body class="relative min-h-screen flex flex-col">

    <!-- Background Image -->
    <div class="background-image"></div>

    <!-- Navbar -->
    <nav class="bg-white bg-opacity-0 py-4 px-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">PT Arwana Jaya</h1>
    </nav>

    <!-- Content -->
    <div class="flex-grow flex items-center justify-center">
        <div
            id="auth-box"
            class="bg-white bg-opacity-50 backdrop-blur-md p-10 rounded-2xl shadow-2xl w-full max-w-md transform transition duration-700 ease-out opacity-0 translate-y-10"
        >
            <h2 class="text-3xl font-bold text-center text-white mb-6">{{ __('Email Verification') }}</h2>

            <p class="text-white text-sm mb-6 text-center">
                {{ __("Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you. If you didn't receive the email, we can send another one.") }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm text-green-500 text-center">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4 text-center">
                @csrf
                <button type="submit" class="text-sm text-white hover:text-blue-400 transition duration-300 underline">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white bg-opacity-0 text-center py-4 text-gray-300">
        &copy; 2025 PT Arwana Jaya. All Rights Reserved.
    </footer>

    <!-- Animation Trigger -->
    <script>
        window.addEventListener('load', () => {
            const box = document.getElementById('auth-box');
            box.classList.remove('opacity-0', 'translate-y-10');
            box.classList.add('opacity-100', 'translate-y-0');
        });
    </script>

</body>
</html>
