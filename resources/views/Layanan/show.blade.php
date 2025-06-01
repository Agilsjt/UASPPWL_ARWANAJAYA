@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.1);">
        <div class="card-body text-white">

            {{-- Tombol kembali --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('layanans.index') }}" style="display: inline-flex; align-items: center; padding: 8px; background: none; border: none; cursor: pointer;">
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

            {{-- Konten --}}
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    @if ($layanan->gambar)
                        <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="Gambar Layanan"
                             class="rounded border border-white shadow-sm" width="150" height="150" style="object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center rounded border border-white shadow-sm" 
                             style="width:150px; height:150px; background-color: rgba(255,255,255,0.1);">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif

                    <h3 class="mt-3 fw-bold text-white">{{ $layanan->nama_layanan }}</h3>
                </div>

                <div class="col-md-8">
                    <table class="table table-borderless text-white">
                        <tbody>
                            <tr>
                                <th class="text-start">Deskripsi</th>
                                <td>{{ $layanan->deskripsi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Harga</th>
                                <td>Rp{{ number_format($layanan->harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Kategori</th>
                                <td>{{ $layanan->kategori?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('layanan.edit', $layanan->id) }}" class="btn btn-warning me-2 px-4 py-2 fw-semibold rounded-pill shadow-sm btn-action">Edit</a>
                        <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
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
        color: #212529 !important; /* agar kontras */
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
