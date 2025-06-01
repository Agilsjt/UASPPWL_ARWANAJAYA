@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.1);">
        <div class="card-body text-white">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('users.index') }}" style="display: inline-flex; align-items: center; padding: 8px; background: none; border: none; cursor: pointer;">
                    <svg viewBox="0 0 72 72" width="36" height="36" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <polyline 
                        fill="none" 
                        stroke="#ffffff" 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-miterlimit="10" 
                        stroke-width="5" 
                        points="46.1964,16.2048 26.8036,35.6651 46.1964,55.1254" />
                    </svg>
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <table class="table table-borderless text-white mb-4">
                        <tbody>
                            <tr>
                                <th class="text-start" style="width: 20%;">Nama</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Peran</th>
                                <td>
                                    @if ($user->roles->count())
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-light text-dark fw-normal me-2 py-1 px-3">{{ $role->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Belum memiliki peran</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-start">Tanggal Dibuat</th>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<style>
    .card-body {
        color: white !important;
    }

    table tr th,
    table tr td {
        background-color: transparent !important;
        color: white !important;
        padding: 0.75rem 1rem;
        vertical-align: middle;
    }

    .btn {
        transition: all 0.2s ease-in-out;
        color: white !important;
    }

    .btn-warning {
        color: #212529 !important;
    }

    .btn-danger {
        color: white !important;
    }

    .btn:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-action {
        min-width: 110px;
        font-size: 1rem;
    }

    .badge {
        font-size: 0.9rem;
        color: #212529 !important;
    }

    .text-muted {
        color: rgba(255, 255, 255, 0.6) !important;
    }
</style>
