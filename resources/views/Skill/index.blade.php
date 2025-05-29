@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-5 shadow-lg" style="background-color: rgba(255, 255, 255, 0.1);">
        <div class="card-body text-white">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0 ms-2" style="font-size: 25px;">Daftar Skill</h2>
                <a href="{{ route('skill.create') }}" class="btn btn-success px-4 fw-semibold rounded-pill shadow-sm">
                    + Tambah Skill
                </a>
            </div>

            {{-- Search Form --}}
            <form action="{{ route('skill.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-white bg-opacity-75 text-dark border-0" placeholder="Cari skill..." value="{{ request('search') }}">
                    <button class="btn btn-outline-light fw-semibold" type="submit">Cari</button>
                </div>
            </form>

            {{-- Table List (Desktop) --}}
            <div class="table-responsive d-none d-md-block rounded-4 overflow-hidden">
                <table class="table table-hover text-white align-middle text-center m-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Skill</th>
                            <th>Deskripsi</th>
                            <th>Total Pegawai</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($skills as $skill)
                            <tr class="table-row-hover">
                                <td>{{ $skill->id }}</td>
                                <td class="text-start">{{ $skill->name }}</td>
                                <td class="text-start">{{ $skill->description }}</td>
                                <td>{{ $skill->employees->count() }}</td>
                                <td>
                                    <a href="{{ route('skill.edit', $skill->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                    <form action="{{ route('skill.destroy', $skill->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus skill ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Tidak ada data skill yang ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Card List (Mobile) --}}
            <div class="card-list-mobile d-block d-md-none">
                @forelse ($skills as $skill)
                    <div class="card mb-3 border-0 bg-white bg-opacity-10 text-white shadow-sm rounded-4">
                        <div class="card-body d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-1 fw-semibold">{{ $skill->name }}</h5>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('skill.edit', $skill->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('skill.destroy', $skill->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus skill ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <p class="mb-1 text-white">Deskripsi skill: {{ $skill->description }}</p>
                            <p class="mb-0"><strong>Total Pegawai:</strong> {{ $skill->employees->count() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted py-4">Tidak ada data skill yang ditemukan</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $skills->withQueryString()->links('pagination::bootstrap-5') }}
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

    /* Mobile style toggles */
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
