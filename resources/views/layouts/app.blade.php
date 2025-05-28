<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PT ARWANA JAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Background */
        .background-image {
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/M%C3%BCnster%2C_LVM%2C_B%C3%BCrogeb%C3%A4ude_--_2013_--_5149-51.jpg/1200px-M%C3%BCnster%2C_LVM%2C_B%C3%BCrogeb%C3%A4ude_--_2013_--_5149-51.jpg') no-repeat center center/cover;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            filter: brightness(30%);
            z-index: -1;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #fff;
            padding: 5px 10px;
            color: #fff;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #fff;
            color: #0d6efd;
        }

        .close-btn {
            position: relative;
            width: 24px;
            height: 24px;
            background: transparent;
            border: none;
            cursor: pointer;
            margin-left: auto;
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


        .sidebar {
            position: fixed;
            top: -43px; 
            left: 0;
            width: 250px;
            height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            padding-top: 70px;
            z-index: 900;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar.closed {
            transform: translateX(-100%);
        }

        .sidebar a {
            color: #f1f1f1;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Main Content */
        .main-content {
            margin-top: 5px;
            margin-left: 220px;
            padding: 30px;
            min-height: calc(100vh - 56px);
            color: #f8f9fa;
            transition: margin-left 0.3s ease;
        }
        /* Adjust main content when sidebar closed */
        .main-content.full-width {
            margin-left: 0;
        }
        .modal-content.custom-dark {
            backdrop-filter: blur(8px);
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border-radius: 12px;
        }


        .content-wrapper {
            padding: 30px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrollbar Styling (optional) */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #6c757d;
            border-radius: 4px;
        }
        
    </style>
</head>
<body>
    <!-- Background -->
    <div class="background-image"></div>


    <button id="sidebarShowBtn" aria-label="Show sidebar"
        style="
        position: fixed;
        top: 20px;
        left: 20px;
        width: 40px;
        height: 40px;
        background: transparent;
        border: none;
        border-radius: 8px;
        display: none;
        cursor: pointer;
        box-shadow: 0 4px 8px rgb(13 110 253 / 0.3);
        transition: background-color 0.3s ease;
        z-index: 1200;
        ">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24" >
        <rect y="4" width="24" height="2" rx="1" />
        <rect y="11" width="24" height="2" rx="1" />
        <rect y="18" width="24" height="2" rx="1" />
        </svg>
    </button>


    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column" id="sidebar">
        <div class="d-flex justify-content-between align-items-center px-3">
            <div class="text-white fw-bold fs-5">PT ARWANA JAYA</div>
        <button class="close-btn ms-auto" id="sidebarToggle" aria-label="Close sidebar" title="Close sidebar"></button>

        </div>
        <!-- Menu navigasi -->
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('employee.index') }}">Kelola Pegawai</a>
        <a href="{{ route('skill.index') }}">Kelola Skill</a>
        <a href="#">Kelola Profil Perusahaan</a>
        <a href="#">Kelola Layanan</a>
        <a href="{{ route('user.index') }}">Kelola User</a>

        <!-- Logout di bawah -->
        <div class="mt-auto px-3 pb-18">
            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="logout-btn w-100">
                    Logout
                </button>
            </form>
        </div>

    </div>


    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('sidebarToggle');
        const showBtn = document.getElementById('sidebarShowBtn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('closed');
            mainContent.classList.toggle('full-width');
            toggleBtn.classList.toggle('active');

            // Show external button when sidebar is closed
            if (sidebar.classList.contains('closed')) {
                showBtn.style.display = 'block';
            } else {
                showBtn.style.display = 'none';
            }
        });

        showBtn.addEventListener('click', () => {
            sidebar.classList.remove('closed');
            mainContent.classList.remove('full-width');
            toggleBtn.classList.remove('active');
            showBtn.style.display = 'none';
        });

        let lastScrollTop = 0;
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function () {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop) {
                navbar.classList.add('hidden');
            } else {
                navbar.classList.remove('hidden');
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
