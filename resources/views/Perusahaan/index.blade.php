@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-5 shadow-lg" style="background-color: rgba(255, 255, 255, 0.1);">
        <div class="card-body text-white">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0 ms-2" style="font-size: 25px;">Profil Perusahaan</h2>
                <a href="{{ route('perusahaan.create') }}" class="btn btn-success px-4 fw-semibold rounded-pill shadow-sm">
                    + Tambah Profil
                </a>
            </div>

            {{-- Search --}}
            <form action="{{ route('perusahaans.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-white bg-opacity-75 text-dark border-0"
                        placeholder="Cari Profil..." value="{{ request('search') }}">
                    <button class="btn btn-outline-light fw-semibold" type="submit">Cari</button>
                </div>
            </form>

            {{-- Tabel Perusahaan (Desktop) --}}
            <div class="table-responsive d-none d-md-block rounded-4 overflow-hidden">
                <table class="table table-hover text-white align-middle text-center m-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Logo</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Judul Deskripsi</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perusahaans as $perusahaan)
                        <tr class="table-row-hover">
                            <td>
                                @if ($perusahaan->logo && Storage::disk('public')->exists($perusahaan->logo))
                                    <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo"
                                        class="rounded-circle border border-white shadow-sm" width="50" height="50"
                                        style="object-fit: cover;">
                                @else
                                    <span class="text-muted fst-italic">Tidak ada logo</span>
                                @endif
                            </td>
                            <td class="text-start">{{ $perusahaan->nama_perusahaan }}</td>
                            <td class="text-start">{{ $perusahaan->email }}</td>
                            <td>{{ $perusahaan->telepon }}</td>
                            <td class="text-start">{{ $perusahaan->alamat }}</td>
                            <td class="text-start">{{ \Str::limit($perusahaan->judul_deskripsi, 60, '...') }}</td>
                            <td class="text-start">{{ \Str::limit($perusahaan->deskripsi, 60, '...') }}</td>
                            <td>
                                @if ($perusahaan->status === 'aktif')
                                    <span class="badge bg-success text-uppercase">Aktif</span>
                                @else
                                    <span class="badge bg-secondary text-uppercase">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-wrap justify-content-center gap-1">
                                    <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('perusahaan.destroy', $perusahaan->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data perusahaan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">Tidak ada data perusahaan ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Card List (Mobile) --}}
            <div class="card-list-mobile d-block d-md-none">
                @forelse ($perusahaans as $perusahaan)
                <div class="card mb-3 border-0 bg-white bg-opacity-10 text-white shadow-sm rounded-4">
                    <div class="card-body d-flex flex-column gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                @if ($perusahaan->logo && Storage::disk('public')->exists($perusahaan->logo))
                                    <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo"
                                        class="rounded-circle border border-white shadow-sm" width="60" height="60"
                                        style="object-fit: cover;">
                                @else
                                    <span class="text-muted fst-italic">Tidak ada logo</span>
                                @endif
                            </div>
                            <div>
                                <h5 class="mb-1 fw-semibold">{{ $perusahaan->nama_perusahaan }}</h5>
                                <small>{{ $perusahaan->judul_deskripsi ?? '-' }}</small>
                            </div>
                        </div>

                        <div>
                            <p class="mb-1"><strong>Email:</strong> {{ $perusahaan->email }}</p>
                            <p class="mb-1"><strong>Telepon:</strong> {{ $perusahaan->telepon }}</p>
                            <p class="mb-1"><strong>Alamat:</strong> {{ $perusahaan->alamat }}</p>
                            <p class="mb-1"><strong>Deskripsi:</strong> {{ \Str::limit($perusahaan->deskripsi, 80) }}</p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                <span class="badge {{ $perusahaan->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($perusahaan->status) }}
                                </span>
                            </p>
                        </div>

                        <div class="d-flex gap-1 mt-2 flex-wrap">
                            <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="btn btn-info btn-sm w-100">Detail</a>
                            <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="btn btn-warning btn-sm w-100">Edit</a>
                            <form action="{{ route('perusahaan.destroy', $perusahaan->id) }}" method="POST" class="w-100"
                                onsubmit="return confirm('Yakin ingin menghapus data perusahaan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-muted py-4">Tidak ada data perusahaan ditemukan</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $perusahaans->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table-row-hover:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }

    .btn {
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #ccc;
    }

    @media (max-width: 767.98px) {
        .table-responsive {
            display: none !important;
        }

        .card-list-mobile {
            display: block !important;
        }
    }
</style>
@endpush