@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.1);">
        <div class="card-body text-white">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Daftar Perusahaan</h2>
                <a href="{{ route('perusahaan.create') }}" class="btn btn-success px-4 fw-semibold rounded-pill shadow-sm">
                    + Tambah Perusahaan
                </a>
            </div>

            {{-- Search Form --}}
            <form action="{{ route('perusahaan.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-white bg-opacity-75 text-dark border-0" placeholder="Cari Perusahaan..." value="{{ request('search') }}">
                    <button class="btn btn-outline-light fw-semibold" type="submit">Cari</button>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive rounded-4 overflow-hidden">
                <table class="table table-hover text-white align-middle text-center m-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Logo</th>
                            <th>Nama Perusahaan</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Deskripsi</th>
                            <th style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perusahaans as $perusahaan)
                            <tr class="table-row-hover">
                                <td>
                                    @if ($perusahaan->logo)
                                        <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo"
                                            class="rounded-circle border border-white shadow-sm" width="50" height="50" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">Tidak ada logo</span>
                                    @endif
                                </td>
                                <td class="text-start">{{ $perusahaan->nama_perusahaan }}</td>
                                <td class="text-start">{{ $perusahaan->email }}</td>
                                <td>{{ $perusahaan->telepon }}</td>
                                <td class="text-start">{{ $perusahaan->alamat }}</td>
                                <td class="text-start">{{ $perusahaan->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="btn btn-info btn-sm me-1">Detail</a>
                                    <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                    <form action="{{ route('perusahaan.destroy', $perusahaan->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data perusahaan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Tidak ada data perusahaan yang ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $perusahaans->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

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
</style>
