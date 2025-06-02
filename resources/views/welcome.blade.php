saya ga pake layout
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
  <header x-data="{ mobileOpen: false, lastScrollY: 0, hide: false, init() {
    this.lastScrollY = window.scrollY;
    window.addEventListener('scroll', () => {
      const current = window.scrollY;
      this.hide = current > this.lastScrollY && current > 50;
      this.lastScrollY = current;
    });
  }}" :class="hide ? '-top-20' : 'top-0 bg-white/30 backdrop-blur-md shadow-md'" class="fixed w-full z-50 transition-all duration-500">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('storage/' . $perusahaans->logo) }}" alt="Logo" class="w-10 h-10 rounded-full object-cover" />
        <h1 class="text-xl font-bold text-white">{{ $perusahaans->nama_perusahaan ?? 'ARWANA JAYA' }}</h1>
      </div>
      <button @click="mobileOpen = !mobileOpen" class="md:hidden text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <nav class="hidden md:flex space-x-6 text-sm text-white">
        <a href="#tentang" class="hover:text-blue-300">About</a>
        <a href="#services" class="hover:text-blue-300">Services</a>
        <a href="#employees" class="hover:text-blue-300">Our Team</a>
        <a href="#company" class="hover:text-blue-300">Company</a>
      </nav>
      @php
        // Ambil nomor dari database atau default
        $rawNumber = $perusahaans->telepon ?? '0813344133';

        // Bersihkan karakter non-digit
        $cleaned = preg_replace('/\D/', '', $rawNumber); // hanya angka

        // Jika nomor diawali 0, ganti dengan 62
        $waNumber = preg_replace('/^0/', '62', $cleaned);

        // Pesan otomatis (opsional)
        $defaultMessage = urlencode('Halo, saya ingin bertanya tentang layanan Anda');
      @endphp
      <div class="hidden md:flex items-center space-x-4 text-sm text-white">
        <a
          href="https://wa.me/{{ $waNumber }}?text={{ $defaultMessage }}"
          target="_blank"
          class="px-4 py-2 border border-white rounded-full hover:bg-white hover:text-black transition">
          Hubungi Kami
        </a>
      </div>

      <div x-show="mobileOpen" x-transition class="md:hidden px-6 pb-4 space-y-2">
        <a href="#tentang" class="block text-white hover:text-blue-300">About</a>
        <a href="#services" class="block text-white hover:text-blue-300">Services</a>
        <a href="#employees" class="block text-white hover:text-blue-300">Our Team</a>
        <a href="#company" class="block text-white hover:text-blue-300">Company</a>
        @php
          // Ambil nomor dari database atau default
          $rawNumber = $perusahaans->telepon ?? '0813344133';

          // Bersihkan karakter non-digit
          $cleaned = preg_replace('/\D/', '', $rawNumber); // hanya angka

          // Jika nomor diawali 0, ganti dengan 62
          $waNumber = preg_replace('/^0/', '62', $cleaned);

          // Pesan otomatis (opsional)
          $defaultMessage = urlencode('Halo, saya ingin bertanya tentang layanan Anda');
        @endphp
      <div class="hidden md:flex items-center space-x-4 text-sm text-white">
        <a
          href="https://wa.me/{{ $waNumber }}?text={{ $defaultMessage }}"
          target="_blank"
          class="px-4 py-2 border border-white rounded-full hover:bg-white hover:text-black transition">
          Hubungi Kami
        </a>
      </div>
  </header>

  <!-- Hero Section -->
  <section id="about" class="max-w-6xl mx-auto px-6 pt-44 pb-24 grid grid-cols-1 md:grid-cols-2 gap-10 items-center relative z-10">
    <div>
      <p class="text-blue-300 text-sm font-semibold mb-2">ARWANA JAYA</p>
      <h2 class="text-4xl md:text-5xl font-bold leading-tight">
        {{ $perusahaans->judul_deskripsi ?? 'KOSONG' }}
      </h2>
      <p class="text-gray-300 mt-4 leading-relaxed">
        {{ $perusahaans->deskripsi ?? 'Kami adalah konsultan TI terkemuka yang menyediakan solusi digital inovatif untuk bisnis Anda.' }}
      </p>
      <a href="#" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition">
        Get a Free Consultation
      </a>
    </div>
    <div class="hidden md:flex justify-center">
      @if ($perusahaans && $perusahaans->isActive() && $perusahaans->logo)
        <img src="{{ asset('storage/' . $perusahaans->logo) }}" alt="Logo" class="w-80 h-80 rounded-full object-cover" />
      @else
        <div class="w-64 h-64 bg-white bg-opacity-10 border border-white/20 rounded-2xl flex items-center justify-center text-6xl font-extrabold text-blue-200 shadow-2xl backdrop-blur">
          AJ
        </div>
      @endif
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
    $firstFour = $employees->take(4);
    $rest = $employees->skip(4);
  @endphp

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-10">
    <!-- Tampilkan 4 karyawan pertama atau semua jika showAll true -->
    @foreach ($firstFour as $employee)
      <div class="bg-white bg-opacity-10 p-6 rounded-xl text-center">
        @if ($employee->profile_picture)
          <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="{{ $employee->name }}"
            class="w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-white border-opacity-20">
        @else
          <div class="w-32 h-32 bg-gray-500 rounded-full mx-auto mb-4 flex items-center justify-center text-lg text-gray-200">No profile_picture</div>
        @endif
        <h3 class="font-semibold text-xl">{{ $employee->name }}</h3>
        <p class="text-blue-400 italic mb-3">{{ $employee->position }}</p>
        @if ($employee->skills && count($employee->skills))
          <div class="mt-3">
            <h4 class="text-white text-sm font-semibold mb-1">Keahlian:</h4>
            <ul class="text-gray-300 text-xs space-y-1">
              @foreach ($employee->skills as $skill)
                <li>{{ $skill->name }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    @endforeach

    <!-- Karyawan sisanya, hanya muncul jika showAll = true -->
      @foreach ($rest as $employee)
        <div x-show="showAll" x-transition class="bg-white bg-opacity-10 p-6 rounded-xl text-center">
          @if ($employee->profile_picture)
            <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="{{ $employee->name }}"
              class="w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-white border-opacity-20">
          @else
            <div class="w-32 h-32 bg-gray-500 rounded-full mx-auto mb-4 flex items-center justify-center text-lg text-gray-200">No profile_picture</div>
          @endif
          <h3 class="font-semibold text-xl">{{ $employee->name }}</h3>
          <p class="text-blue-400 italic mb-3">{{ $employee->position }}</p>
          @if ($employee->skills && count($employee->skills))
            <div class="mt-3">
              <h4 class="text-white text-sm font-semibold mb-1">Keahlian:</h4>
              <ul class="text-gray-300 text-xs space-y-1">
                @foreach ($employee->skills as $skill)
                  <li>{{ $skill->name }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
      @endforeach
    </template>
  </div>

  @if ($rest->count())
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
    <p><strong>{{ $perusahaans->nama_perusahaan ?? 'ARWANJAY' }}</strong></p>
    <p>{{ $perusahaans->alamat ?? 'Sambas' }}</p>
    <p>Email: {{ $perusahaans->email ?? 'ARWANJAY@GMAIL.COM' }}| Phone: {{ $perusahaans->telepon ?? 'ARWANJAY' }}</p>
    <p class="mt-2">&copy; 2025 ArwanaJaya. All rights reserved.</p>
  </footer>
</body>
</html>