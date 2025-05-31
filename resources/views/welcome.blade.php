<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Arwana Jaya</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body class="font-sans text-white relative min-h-screen overflow-x-hidden bg-black">

  <!-- Background & Overlay -->
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('images/background.jpg');"></div>
    <div class="absolute inset-0 bg-black bg-opacity-70"></div>
  </div>

  <!-- Header -->
  <header 
    x-data="{ scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
    :class="scrolled ? 'bg-white/30 backdrop-blur-md shadow-md' : 'bg-transparent'"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-500">
    <div class="max-w-screen-xl mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <div class="w-8 h-8 bg-blue-500 rounded-full"></div>
        <h1 class="text-xl font-bold text-white">Arwana Jaya</h1>
      </div>
      <nav class="hidden md:flex space-x-6 text-sm text-white">
        <a href="#about" class="hover:text-blue-300 transition">About</a>
        <a href="#services" class="hover:text-blue-300 transition">Services</a>
        <a href="#employees" class="hover:text-blue-300 transition">Employee</a>
        <a href="#company" class="hover:text-blue-300 transition">Company</a>
      </nav>
      <div class="hidden md:flex items-center space-x-4 text-sm text-white">
        <span>+62 812 3456 7890</span>
        <span>arwanajaya@gmail.com</span>
        <a href="#" class="px-4 py-2 border border-white rounded-full hover:bg-white hover:text-black transition">Book a Demo</a>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="about" class="max-w-6xl mx-auto px-6 pt-44 pb-24 grid grid-cols-1 md:grid-cols-2 gap-10 items-center relative z-10">
    <div>
      <p class="text-blue-300 text-sm font-semibold mb-2">ARWANA JAYA</p>
      <h2 class="text-4xl md:text-5xl font-bold leading-tight">
        Solusi Digital Inovatif<br />
        Untuk Masa Depan Bisnis Anda
      </h2>
      <p class="text-gray-300 mt-4 leading-relaxed">
        PT Arwana Jaya adalah perusahaan konsultan IT yang menyediakan solusi strategis dan teknis untuk pengembangan sistem informasi, integrasi teknologi, dan transformasi digital berkelanjutan.
      </p>
      <a href="#" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition">
        Get a Free Consultation
      </a>
    </div>
    <div class="hidden md:flex justify-center">
      <div class="w-64 h-64 bg-white bg-opacity-10 border border-white/20 rounded-2xl flex items-center justify-center text-6xl font-extrabold text-blue-200 shadow-2xl backdrop-blur">
        AJ
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="max-w-6xl mx-auto px-6 py-20 relative z-10">
    <h2 class="text-3xl font-bold text-center mb-12">Layanan Konsultan TI Kami</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-6 rounded-xl shadow-xl hover:scale-105 transform transition">
        <div class="w-14 h-14 flex items-center justify-center bg-white bg-opacity-10 rounded-full mb-4">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M13 16h-1v-4h-1m1-4h.01M21 12c0-4.97-4.03-9-9-9S3 7.03 3 12s4.03 9 9 9 9-4.03 9-9z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Konsultasi Transformasi Digital</h3>
        <p class="text-gray-300 text-sm">Strategi digital cerdas untuk efisiensi dan keberlanjutan jangka panjang.</p>
      </div>
      <div class="bg-gradient-to-br from-green-600 to-green-800 p-6 rounded-xl shadow-xl hover:scale-105 transform transition">
        <div class="w-14 h-14 flex items-center justify-center bg-white bg-opacity-10 rounded-full mb-4">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M8 16h8M8 12h8m-8-4h8M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Pengembangan Sistem Informasi</h3>
        <p class="text-gray-300 text-sm">Rancang dan bangun sistem digital sesuai kebutuhan bisnis Anda.</p>
      </div>
      <div class="bg-gradient-to-br from-purple-600 to-purple-800 p-6 rounded-xl shadow-xl hover:scale-105 transform transition">
        <div class="w-14 h-14 flex items-center justify-center bg-white bg-opacity-10 rounded-full mb-4">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2 .895 2 2 2 2-.895 2-2zM20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Audit & Keamanan IT</h3>
        <p class="text-gray-300 text-sm">Lindungi aset digital Anda dengan audit dan solusi keamanan terbaik.</p>
      </div>
    </div>
  </section>

  <!-- Tim Kami Section -->
  <section id="employees" class="max-w-6xl mx-auto px-6 py-20 relative z-10" x-data="{ showAll: false }">
    <h2 class="text-3xl font-bold text-center mb-12">Tim Kami</h2>

    @php
      $total = $employees->count();
      $first = $employees->take(1);
      $nextThree = $employees->skip(1)->take(3);
      $rest = $employees->skip(4);
    @endphp

    <!-- Ketua -->
    <div class="flex justify-center mb-10">
      @foreach ($first as $employee)
        <div class="bg-white bg-opacity-10 p-6 rounded-xl text-center max-w-sm w-full">
          @if ($employee->profile_picture)
            <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="{{ $employee->name }}"
              class="w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-white border-opacity-20">
          @else
            <div class="w-32 h-32 bg-gray-500 rounded-full mx-auto mb-4 flex items-center justify-center text-lg text-gray-200">No profile_picture</div>
          @endif
          <h3 class="font-semibold text-xl">{{ $employee->name }}</h3>
          <p class="text-blue-400 italic mb-3">{{ $employee->position }}</p>
          <p class="text-gray-300 text-sm mb-2">{{ $employee->bio ?? 'Profil tidak tersedia.' }}</p>
          @if ($employee->skills && count($employee->skills))
            <div class="mt-3">
              <h4 class="text-white text-sm font-semibold mb-1">Keahlian:</h4>
              <ul class="text-gray-300 text-xs space-y-1">
                @foreach ($employee->skills as $skill)
                  <li>• {{ $skill->name }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
      @endforeach
    </div>

    <!-- CO -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mb-10">
      @foreach ($nextThree as $employee)
        <div class="bg-white bg-opacity-10 p-6 rounded-xl text-center">
          @if ($employee->profile_picture)
            <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="{{ $employee->name }}"
              class="w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-white border-opacity-20">
          @else
            <div class="w-32 h-32 bg-gray-500 rounded-full mx-auto mb-4 flex items-center justify-center text-lg text-gray-200">No Profile Picture</div>
          @endif
          <h3 class="font-semibold text-xl">{{ $employee->name }}</h3>
          <p class="text-blue-400 italic mb-3">{{ $employee->position }}</p>
          <p class="text-gray-300 text-sm mb-2">{{ $employee->bio ?? 'Profil tidak tersedia.' }}</p>
          @if ($employee->skills && count($employee->skills))
            <div class="mt-3">
              <h4 class="text-white text-sm font-semibold mb-1">Keahlian:</h4>
              <ul class="text-gray-300 text-xs space-y-1">
                @foreach ($employee->skills as $skill)
                  <li>• {{ $skill->name }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
      @endforeach
    </div>

    <!-- Pegawai lainnya -->
    @if ($rest->count())
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-10" x-show="showAll" x-transition>
        @foreach ($rest as $employee)
          <div class="bg-white bg-opacity-10 p-6 rounded-xl text-center">
            @if ($employee->profile_picture)
              <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="{{ $employee->name }}"
                class="w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-white border-opacity-20">
            @else
              <div class="w-32 h-32 bg-gray-500 rounded-full mx-auto mb-4 flex items-center justify-center text-lg text-gray-200">No profile_picture</div>
            @endif
            <h3 class="font-semibold text-xl">{{ $employee->name }}</h3>
            <p class="text-blue-400 italic mb-3">{{ $employee->position }}</p>
            <p class="text-gray-300 text-sm mb-2">{{ $employee->bio ?? 'Profil tidak tersedia.' }}</p>
            @if ($employee->skills && count($employee->skills))
              <div class="mt-3">
                <h4 class="text-white text-sm font-semibold mb-1">Keahlian:</h4>
                <ul class="text-gray-300 text-xs space-y-1">
                  @foreach ($employee->skills as $skill)
                    <li>• {{ $skill->name }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        @endforeach
      </div>

      <!-- Tombol Selengkapnya -->
      <div class="text-center">
        <button @click="showAll = !showAll"
          class="px-6 py-3 border border-white rounded-full hover:bg-white hover:text-black transition text-sm">
          <span x-show="!showAll">Lihat Selengkapnya</span>
          <span x-show="showAll">Tampilkan Lebih Sedikit</span>
        </button>
      </div>
    @endif
  </section>

  <!-- Footer -->
  <footer id="company" class="max-w-7xl mx-auto px-6 py-8 text-center text-sm text-gray-400 border-t border-gray-700 relative z-10">
    <p><strong>PT.Arwana Jaya</strong></p>
    <p>Adelmar Kost, Jl.Imam Bonjol, Pontianak, Kalimantan Barat, Indonesia</p>
    <p>Email: arwanajaya@gmail.com | Phone: +62 812 3456 7890</p>
    <p class="mt-2">&copy; 2025 ArwanaJaya. All rights reserved.</p>
  </footer>

</body>
</html>
