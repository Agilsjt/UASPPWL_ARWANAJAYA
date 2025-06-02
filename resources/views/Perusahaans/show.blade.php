@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.1);">
        <div class="card-body text-white">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('perusahaans.index') }}" style="display: inline-flex; align-items: center; padding: 8px; background: none; border: none; cursor: pointer;">
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

            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    @if ($perusahaan->logo)
                        <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo Perusahaan"
                            class="rounded-circle border border-white shadow-sm" width="150" height="150" style="object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center rounded-circle border border-white shadow-sm" 
                             style="width:150px; height:150px; background-color: rgba(255,255,255,0.1);">
                            <span class="text-muted">Tidak ada logo</span>
                        </div>
                    @endif

                    <h3 class="mt-3 fw-bold text-white">{{ $perusahaan->nama_perusahaan }}</h3>
                </div>

                <div class="col-md-8">
                    <table class="table table-borderless text-white">
                        <tbody>
                            <tr>
                                <th class="text-start">Deskripsi</th>
                                <td>{{ $perusahaan->deskripsi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Alamat</th>
                                <td>{{ $perusahaan->alamat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Telepon</th>
                                <td>{{ $perusahaan->telepon ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Email</th>
                                <td>{{ $perusahaan->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Status</th>
                                <td class>
                                    @if ($perusahaan->status === 'aktif')
                                        <span class="badge bg-success px-3 py-1 rounded-pill">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-1 rounded-pill">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <a href="{{ route('perusahaans.edit', $perusahaan->id) }}" class="btn btn-warning me-2 px-4 py-2 fw-semibold rounded-pill shadow-sm btn-action">Edit</a>
                        <form action="{{ route('perusahaans.destroy', $perusahaan->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus perusahaan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold rounded-pill shadow-sm btn-action">Hapus</button>
                        </form>
                    </div>
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
