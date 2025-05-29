<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Selamat Datang - PT Arwana Jaya</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative min-h-screen flex flex-col text-white bg-black">

  <!-- Background Image Layer -->
  <div class="fixed top-0 left-0 w-full h-screen z-[-2] brightness-[20%] bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x1080.jpg'), url('https://i.pinimg.com/originals/1d/30/b5/1d30b5a0c298c02edaf2f501b22a6587.gif');"></div>

  <!-- Desktop Version -->
  <section class="hidden md:flex flex-col min-h-screen z-10">
    <!-- Navbar -->
    <nav class="bg-transparent py-4 px-8 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-white">PT Arwana Jaya</h1>
      @if (Route::has('login'))
        <a href="{{ route('login') }}" class="text-white hover:text-blue-300 font-semibold">Login</a>
      @endif
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex flex-row items-center justify-between px-20 gap-10">
      <!-- Left Text -->
      <div class="w-1/2 text-left space-y-6">
        <h2 class="text-5xl font-bold leading-tight">
          Solusi Digital Inovatif<br />Untuk Masa Depan Bisnis Anda
        </h2>
        <p class="text-lg text-gray-200 max-w-lg">
          PT Arwana Jaya adalah perusahaan konsultan IT yang menyediakan solusi strategis dan teknis untuk pengembangan sistem informasi, integrasi teknologi, dan transformasi digital yang berkelanjutan.
        </p>
      </div>
      <!-- Right Image -->
      <div class="w-1/2 flex justify-center">
        <img src="https://via.placeholder.com/400x300?text=Logo+Arwana+Jaya" alt="Logo PT Arwana Jaya" class="max-w-full h-auto rounded-xl shadow-lg" />
      </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-4 text-gray-300">
      &copy; 2025 PT Arwana Jaya. All Rights Reserved.
    </footer>
  </section>

<!-- Mobile Version -->
<section class="relative flex md:hidden flex-col min-h-screen z-10 overflow-hidden">

  <!-- Blur Layer (seluruh layar mobile) -->
  <div class="absolute inset-0 backdrop-blur-sm bg-black/60 z-[-1] rounded-none"></div>

  <!-- Mobile Content -->
  <div class="flex flex-col min-h-screen px-6 py-8 gap-6 text-center mx-4 mt-10">
    <!-- Navbar -->
    <nav class="flex justify-between items-center mb-8">
      <h1 class="text-xl font-extrabold tracking-wide text-white">Arwana Jaya</h1>
      @if (Route::has('login'))
        <a href="{{ route('login') }}" class="text-white font-semibold px-4 py-2 border border-white/30 rounded-full hover:bg-white/20 transition">
          Login
        </a>
      @endif
    </nav>

    <!-- Content -->
    <div class="flex flex-col items-center gap-6">
      <h2 class="text-3xl font-extrabold leading-snug tracking-wider text-white">
        Solusi <span class="text-cyan-400">Digital</span> <br /> Inovatif<br /><span class="text-purple-500">Untuk Masa Depan</span> <br /> Bisnis Anda
      </h2>
      <p class="text-sm sm:text-base text-gray-300 max-w-md leading-relaxed">
        PT Arwana Jaya hadir memberikan solusi IT strategis dan transformasi digital <br />yang memajukan bisnis Anda ke level berikutnya.
      </p>
      <img src="https://via.placeholder.com/300x200?text=Logo+Arwana+Jaya" alt="Logo" class="rounded-2xl shadow-xl w-3/4 max-w-xs" />
      <a href="{{ route('login') }}" class="mt-6 inline-block bg-gradient-to-r from-cyan-500 to-purple-600 text-white font-bold py-3 px-10 rounded-full shadow-lg hover:scale-105 transform transition">
        Mulai Sekarang
      </a>
    </div>

    <footer class="mt-auto text-center text-gray-400 text-xs pt-6">
      &copy; 2025 PT Arwana Jaya. All Rights Reserved.
    </footer>
  </div>
</section>

</body>
</html>
