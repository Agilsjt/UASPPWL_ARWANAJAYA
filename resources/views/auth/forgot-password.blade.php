<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lupa Password - PT Arwana Jaya</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .background-image {
      background: url('https://i.pinimg.com/originals/1d/30/b5/1d30b5a0c298c02edaf2f501b22a6587.gif') no-repeat center center/cover;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      filter: brightness(20%);
      z-index: -1;
    }
  </style>
</head>
<body class="relative min-h-screen flex flex-col">
  <div class="background-image"></div>

  <!-- Navbar -->
  <nav class="bg-white bg-opacity-0 py-4 px-8 flex justify-between items-center">
    <a href="{{ route('home') }}" class="text-2xl font-bold text-white">PT Arwana Jaya</a>
  </nav>

  <!-- Content -->
  <div class="flex-grow flex items-center justify-center">
    <div id="reset-box" class="opacity-0 translate-y-10 transition-all duration-1000 ease-out bg-white bg-opacity-50 backdrop-blur-md p-10 rounded-2xl shadow-2xl w-full max-w-md">
      <h1 class="text-3xl font-bold text-white mb-6 text-center">Lupa Password</h1>

      <p class="text-sm text-white text-center mb-4">Masukkan email Anda untuk mendapatkan link reset password.</p>

      @if (session('status'))
        <div class="bg-green-100 text-green-800 text-sm p-3 rounded mb-4">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div>
          <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
          <input type="email" id="email" name="email" required class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-80 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="email@domain.com" />
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
          Kirim Link Reset
        </button>
      </form>

      <div class="text-center text-sm mt-4">
        <a href="{{ route('login') }}" class="text-white hover:text-blue-400 font-semibold">Kembali ke Login</a>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-white bg-opacity-0 text-center py-4 text-gray-300">
    &copy; 2025 PT Arwana Jaya. All Rights Reserved.
  </footer>

  <!-- Animation Trigger -->
  <script>
    window.addEventListener('load', () => {
      const box = document.getElementById('reset-box');
      box.classList.remove('opacity-0', 'translate-y-10');
      box.classList.add('opacity-100', 'translate-y-0');
    });
  </script>
</body>
</html>
