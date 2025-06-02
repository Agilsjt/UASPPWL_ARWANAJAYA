@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-5 shadow-lg" style="background-color: rgba(255, 255, 255, 0.1);">
        <div class="card-body text-white">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0 ms-2" style="font-size: 25px;">Daftar Layanan</h2>
                @can('create-layanan')
                <a href="{{ route('layanans.create') }}" class="btn btn-success px-4 fw-semibold rounded-pill shadow-sm" aria-label="Tambah Layanan Baru">
                    + Tambah Layanan
                </a>
                @endcan
            </div>

            {{-- Search --}}
            <form action="{{ route('layanans.index') }}" method="GET" class="mb-4" role="search" aria-label="Form pencarian layanan">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-white bg-opacity-75 text-dark border-0"
                        placeholder="Cari Layanan..." value="{{ request('search') }}" aria-label="Cari layanan">
                    <button class="btn btn-outline-light fw-semibold" type="submit" aria-label="Tombol cari layanan">Cari</button>
                </div>
            </form>

            {{-- Tabel Desktop --}}
            <div class="table-responsive d-none d-md-block rounded-4 overflow-hidden">
                <table class="table table-hover text-white align-middle text-center m-0" role="table" aria-label="Daftar layanan">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col" style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($layanans as $layanan)
                        <tr class="table-row-hover">
                            <td>
                                @if ($layanan->gambar)
                                    <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="Gambar {{ $layanan->nama_layanan }}"
                                        class="rounded border border-white shadow-sm" width="50" height="50" style="object-fit: cover;">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>{{ $layanan->nama_layanan }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($layanan->deskripsi, 50, '...') }}</td>
                            <td>{{ $layanan->kategori }}</td>
                            <td>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex flex-wrap justify-content-center gap-1">
                                    @can('read-layanan')
                                    <a href="{{ route('layanans.show', $layanan->id) }}" class="btn btn-info btn-sm" aria-label="Detail {{ $layanan->nama_layanan }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @endcan

                                    @can('edit-layanan')
                                    <a href="{{ route('layanans.edit', $layanan->id) }}" class="btn btn-warning btn-sm" aria-label="Edit {{ $layanan->nama_layanan }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @endcan

                                    @can('delete-layanan')
                                    <form action="{{ route('layanans.destroy', $layanan->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Hapus layanan ini?')" aria-label="Hapus {{ $layanan->nama_layanan }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Tidak ada layanan ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Card Mobile --}}
            <div class="card-list-mobile d-block d-md-none">
                @forelse ($layanans as $layanan)
                <div class="card mb-3 border-0 bg-white bg-opacity-10 text-white shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            @if ($layanan->gambar)
                                <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="Gambar {{ $layanan->nama_layanan }}"
                                    class="rounded border border-white shadow-sm" width="60" height="60" style="object-fit: cover;">
                            @else
                                <div class="text-muted">Tidak ada gambar</div>
                            @endif
                            <div class="flex-grow-1">
                                <h5 class="mb-1 fw-semibold">{{ $layanan->nama_layanan }}</h5>
                                <small class="d-block">{{ \Illuminate\Support\Str::limit($layanan->deskripsi, 60, '...') }}</small>
                                <small class="d-block">Kategori: {{ $layanan->kategori }}</small>
                                <small class="d-block">Harga: Rp {{ number_format($layanan->harga, 0, ',', '.') }}</small>
                            </div>
                        </div>

                        <div class="d-flex gap-1 mt-3 flex-wrap">
                            @can('read-layanan')
                            <a href="{{ route('layanans.show', $layanan->id) }}" class="btn btn-info btn-sm w-100" aria-label="Detail {{ $layanan->nama_layanan }}">Detail</a>
                            @endcan

                            @can('edit-layanan')
                            <a href="{{ route('layanans.edit', $layanan->id) }}" class="btn btn-warning btn-sm w-100" aria-label="Edit {{ $layanan->nama_layanan }}">Edit</a>
                            @endcan

                            @can('delete-layanan')
                            <form action="{{ route('layanans.destroy', $layanan->id) }}" method="POST" class="w-100"
                                onsubmit="return confirm('Hapus layanan ini?')" aria-label="Hapus {{ $layanan->nama_layanan }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-muted py-4">Tidak ada layanan ditemukan</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $layanans->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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