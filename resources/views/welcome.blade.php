<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Selamat Datang - PT Arwana Jaya</title>
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
  </style>
</head>
<body class="relative min-h-screen flex flex-col text-white">
  <div class="background-image"></div>

  <!-- Navbar -->
  <nav class="bg-transparent py-4 px-8 flex justify-between items-center z-10">
    <h1 class="text-2xl font-bold text-white">PT Arwana Jaya</h1>
    @if (Route::has('login'))
      <a href="{{ route('login') }}" class="text-white hover:text-blue-300 font-semibold">Login</a>
    @endif
  </nav>

  <!-- Main Section -->
  <main class="flex-grow flex flex-col md:flex-row items-center justify-between px-8 md:px-20 z-10">
    <!-- Left Content -->
    <div class="md:w-1/2 text-left space-y-6">
      <h2 class="text-4xl md:text-5xl font-bold leading-tight">
        Solusi Digital Inovatif<br />Untuk Masa Depan Bisnis Anda
      </h2>
      <p class="text-lg text-gray-200 max-w-lg">
        PT Arwana Jaya adalah perusahaan konsultan IT yang menyediakan solusi strategis dan teknis untuk pengembangan sistem informasi, integrasi teknologi, dan transformasi digital yang berkelanjutan.
      </p>
    </div>

    <!-- Right Image Placeholder -->
    <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
      <!-- Ganti dengan logo atau gambar perusahaan -->
      <img src="https://via.placeholder.com/400x300?text=Logo+Arwana+Jaya" alt="Logo PT Arwana Jaya" class="max-w-full h-auto rounded-xl shadow-lg">
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center py-4 text-gray-300 z-10">
    &copy; 2025 PT Arwana Jaya. All Rights Reserved.
  </footer>
</body>
</html>
