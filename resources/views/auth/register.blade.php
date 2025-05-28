<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Selamat Datang - PT Arwana Jaya</title>
  <meta name="description" content="PT Arwana Jaya adalah perusahaan konsultan IT yang menyediakan solusi strategis dan teknis dalam transformasi digital dan sistem informasi.">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .background-image {
      background: url('https://via.placeholder.com/1920x1080.jpg'), url('https://i.pinimg.com/originals/1d/30/b5/1d30b5a0c298c02edaf2f501b22a6587.gif') no-repeat center center/cover;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      z-index: -2;
      filter: brightness(20%);
    }

    .overlay {
      background: rgba(0, 0, 0, 0.5);
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      z-index: -1;
    }
  </style>
</head>
<body class="relative min-h-screen flex flex-col text-white">
  <div class="background-image"></div>
  <div class="overlay"></div>

  <!-- Navbar -->
  <nav class="bg-transparent py-4 px-8 flex justify-between items-center z-10">
    <h1 class="text-2xl font-bold text-white">PT Arwana Jaya</h1>
  </nav>

  <!-- Main Section -->
  <main class="flex-grow flex flex-col md:flex-row items-center justify-between px-8 md:px-20 z-10">
    <!-- Left Content -->
    <div class="md:w-1/2 text-left space-y-6">
      <h2 class="text-4xl md:text-5xl font-bold leading-tight">
        Solusi Digital Inovatif<br />Untuk Masa Depan Bisnis Anda
      </h2>
      <p class="text-lg text-white max-w-lg">
        PT Arwana Jaya adalah perusahaan konsultan IT yang menyediakan solusi strategis dan teknis untuk pengembangan sistem informasi, integrasi teknologi, dan transformasi digital yang berkelanjutan.
      </p>
    </div>

    <!-- Ganti route('login') menjadi route('register') dan sesuaikan kontennya -->
    <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
      <div id="auth-box" class="opacity-0 translate-y-10 transition-all duration-1000 ease-out bg-white/10 backdrop-blur-xl p-10 rounded-2xl shadow-2xl w-full max-w-md border border-white/20">
        <h1 class="text-3xl font-bold text-center text-white mb-6 drop-shadow-md">Buat Akun</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
          @csrf

          <!-- Nama -->
          <div>
            <label for="name" class="block text-sm font-semibold text-white mb-1">Nama Lengkap</label>
            <input type="text" id="name" name="name" required
              class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-white/60 border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
              placeholder="Nama Lengkap" />
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-semibold text-white mb-1">Email</label>
            <input type="email" id="email" name="email" required
              class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-white/60 border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
              placeholder="email@domain.com" />
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-semibold text-white mb-1">Password</label>
            <input type="password" id="password" name="password" required
              class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-white/60 border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
              placeholder="••••••••" />
          </div>

          <!-- Konfirmasi Password -->
          <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-white mb-1">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
              class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-white/60 border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
              placeholder="••••••••" />
          </div>

          <!-- Tombol Register -->
          <button type="submit"
            class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
            Daftar
          </button>

          <!-- Sudah punya akun -->
          <div class="text-center text-sm mt-4 text-white">
            Sudah punya akun?
            @if (Route::has('login'))
              <a href="{{ route('login') }}" class="text-blue-300 hover:text-blue-500 font-semibold transition">Login di sini</a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center py-4 text-gray-300 z-10">
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
