<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Arwana Jaya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  @stack('styles')
  <style>
    body {
      margin: 0;
      background-color: #f8f9fa;
      overflow-x: hidden;
      font-family: 'Segoe UI', sans-serif;
    }

    .background-image {
      background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/M%C3%BCnster%2C_LVM%2C_B%C3%BCrogeb%C3%A4ude_--_2013_--_5149-51.jpg/1200px-M%C3%BCnster%2C_LVM%2C_B%C3%BCrogeb%C3%A4ude_--_2013_--_5149-51.jpg') no-repeat center center/cover;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      filter: brightness(30%);
      z-index: -1;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      height: 100vh;
      background: rgba(15, 15, 30, 0.97);
      color: #fff;
      display: flex;
      flex-direction: column;
      z-index: 1000;
      transition: transform 0.3s ease;
      box-shadow: 4px 0 10px rgba(0, 0, 0, 0.5);
    }

    .sidebar.closed {
      transform: translateX(-100%);
    }

    .sidebar-header {
      border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    }

    .sidebar-menu li {
      margin-bottom: 2px;
    }

    .sidebar-menu a {
      display: block;
      color: #ccc;
      padding: 12px 24px;
      text-decoration: none;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .sidebar-menu a.active,
    .sidebar-menu a:hover {
      background: linear-gradient(to right, #0d6efd, #6f42c1);
      color: #fff;
      font-weight: 600;
      box-shadow: inset 2px 0 0 #fff;
    }

    .sidebar-logout {
      border-top: 1px solid rgba(255, 255, 255, 0.07);
    }

    .logout-btn {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid #fff;
      color: #fff;
      border-radius: 5px;
      padding: 8px 0;
      transition: all 0.3s ease;
    }

    .logout-btn:hover {
      background: #fff;
      color: #0d6efd;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
      min-height: 100vh;
      transition: margin-left 0.3s ease;
      color: #f8f9fa;
    }

    .main-content.full-width {
      margin-left: 0;
    }

    .content-wrapper {
      padding: 30px;
      animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .close-btn {
      width: 24px;
      height: 24px;
      background: transparent;
      border: none;
      cursor: pointer;
      position: relative;
    }

    .close-btn::before,
    .close-btn::after {
      content: "";
      position: absolute;
      left: 50%;
      top: 50%;
      width: 20px;
      height: 3px;
      background-color: white;
      border-radius: 2px;
      transform-origin: center;
    }

    .close-btn::before {
      transform: translate(-50%, -50%) rotate(45deg);
    }

    .close-btn::after {
      transform: translate(-50%, -50%) rotate(-45deg);
    }

    #sidebarShowBtn {
      position: fixed;
      top: 20px;
      left: 20px;
      width: 40px;
      height: 40px;
      background: rgba(0, 0, 0, 0.6);
      border: none;
      border-radius: 8px;
      display: none;
      cursor: pointer;
      z-index: 1100;
      box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    #sidebarShowBtn.show {
      display: block !important;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100vw;
        height: auto;
        top: 0;
        left: 0;
      }

      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>
  <div class="background-image"></div>

  <button id="sidebarShowBtn" aria-label="Show sidebar">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
      <rect y="4" width="24" height="2" rx="1" />
      <rect y="11" width="24" height="2" rx="1" />
      <rect y="18" width="24" height="2" rx="1" />
    </svg>
  </button>

  <div class="sidebar" id="sidebar">
    <div class="sidebar-header d-flex justify-content-between align-items-center px-3 py-3">
      <div class="text-white fw-bold fs-5">{{ $perusahaans->nama_perusahaan ?? 'PT ARWANA JAYA' }}</div>
      <button class="close-btn" id="sidebarToggle" aria-label="Close sidebar"></button>
    </div>
    <nav class="flex-grow-1">
      <ul class="sidebar-menu list-unstyled mb-0">
        <li><a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="{{ route('employees.index') }}" class="{{ Request::routeIs('employees.*') ? 'active' : '' }}">Kelola Pegawai</a></li>
        <li><a href="{{ route('skills.index') }}" class="{{ Request::routeIs('skills.*') ? 'active' : '' }}">Kelola Skill</a></li>
        <li><a href="{{ route('perusahaans.index') }}" class="{{ Request::routeIs('perusahaans.*') ? 'active' : '' }}">Kelola Profil Perusahaan</a></li>
        <li><a href="{{ route('layanans.index') }}" class="{{ Request::routeIs('layanans.*') ? 'active' : '' }}">Kelola Layanan</a></li>
        <li><a href="{{ route('users.index') }}" class="{{ Request::routeIs('users.*') ? 'active' : '' }}">Kelola User</a></li>
      </ul>
    </nav>
    <div class="sidebar-logout px-3 py-3 mt-auto">
      <button type="button" class="logout-btn w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
        Logout
      </button>
    </div>
  </div>

  <div class="main-content" id="mainContent">
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>
  <!-- Modal Konfirmasi Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-dark text-white border-light">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin logout dari sistem?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('sidebarToggle');
    const showBtn = document.getElementById('sidebarShowBtn');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.add('closed');
      mainContent.classList.add('full-width');
      showBtn.classList.add('show');
    });

    showBtn.addEventListener('click', () => {
      sidebar.classList.remove('closed');
      mainContent.classList.remove('full-width');
      showBtn.classList.remove('show');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>