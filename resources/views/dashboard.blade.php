@extends('layouts.app')

@section('content')
<div class="container py-5 text-white">
    @if(session('first_login'))
        <!-- Bubble Ucapan Halo -->
        <div class="halo-bubble position-absolute top-0 start-50 translate-middle-x" style="margin-top: -15px; padding: 10px 20px;">
            Halo, {{ $user->name ?? 'selamat datang!' }}
        </div>
        <?php session()->forget('first_login'); ?>
    @endif

    <h2 class="mb-5 text-center fw-bold display-5">Dashboard</h2>

    <div class="row g-4">
        <!-- Employee Summary -->
        <div class="col-md-4">
            <div class="glass-card border-start border-4 border-primary">
                <div class="card-body">
                    <h5 class="text-uppercase fw-semibold text-primary">Pegawai</h5>
                    <h2 class="fw-bold mb-2">{{ $employeeCount ?? 0 }}</h2>
                    <p class="mb-3">Total pegawai yang ada</p>
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-light btn-sm px-4">Lihat</a>
                </div>
            </div>
        </div>

        <!-- Skill Summary -->
        <div class="col-md-4">
            <div class="glass-card border-start border-4 border-success">
                <div class="card-body">
                    <h5 class="text-uppercase fw-semibold text-success">Skill</h5>
                    <h2 class="fw-bold mb-2">{{ $skillCount ?? 0 }}</h2>
                    <p class="mb-3">Total skill yang ada di perusahaan</p>
                    <a href="{{ route('skills.index') }}" class="btn btn-outline-light btn-sm px-4">Lihat</a>
                </div>
            </div>
        </div>

        <!-- User Summary -->
        <div class="col-md-4">
            <div class="glass-card border-start border-4 border-warning">
                <div class="card-body">
                    <h5 class="text-uppercase fw-semibold text-warning">User</h5>
                    <h2 class="fw-bold mb-2">{{ $userCount ?? 0 }}</h2>
                    <p class="mb-3">User yang sudah terdaftar di sistem</p>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm px-4">Lihat</a>
                </div>
            </div>
        </div>

        <!-- Company Profile -->
        <div class="col-md-6">
            <div class="glass-card border-start border-4 border-info">
                <div class="card-body">
                    <h5 class="text-uppercase fw-semibold text-info">Profil Perusahaan</h5>
                    <h2 class="fw-bold mb-2">Kelola</h2>
                    <p class="mb-3">Lihat dan edit profil perusahaan</p>
                    <a href="{{ route('perusahaans.index') }}" class="btn btn-outline-light btn-sm px-4">Lihat</a>
                </div>
            </div>
        </div>

        <!-- Service Management -->
        <div class="col-md-6">
            <div class="glass-card border-start border-4 border-danger">
                <div class="card-body">
                    <h5 class="text-uppercase fw-semibold text-warning">Layanan</h5>
                    <h2 class="fw-bold mb-2">{{ $layananCount ?? 0 }}</h2>
                    <p class="mb-3">Jumlah layanan yang disediakan perusahaan</p>
                    <a href="{{ route('perusahaans.index') }}" class="btn btn-outline-light btn-sm px-4">Lihat</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        color: white;
        padding: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.5);
    }

    .halo-bubble {
        font-size: 16px;
        animation: fadeInOutBubble 3s ease-in-out forwards;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 1rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        z-index: 10;
    }

    @keyframes fadeInOutBubble {
        0% {
            opacity: 0;
            transform: translateY(-30px);
        }
        50% {
            opacity: 1;
            transform: translateY(0);
        }
        80% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: translateY(-30px);
        }
    }

    @media (max-width: 768px) {
        .container {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .glass-card {
            padding: 1.25rem;
        }

        .halo-bubble {
            font-size: 14px;
            padding: 8px 16px;
            max-width: 90vw;
            text-align: center;
        }

        .display-5 {
            font-size: 2rem;
        }
    }
</style>

