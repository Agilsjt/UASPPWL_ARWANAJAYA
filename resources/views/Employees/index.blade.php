@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-5 shadow-lg" style="background-color: rgba(255, 255, 255, 0.1);">
        <div class="card-body text-white">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0 ms-2" style="font-size: 25px;">Daftar Pegawai</h2>

                @can('create-employee')
                <a href="{{ route('employees.create') }}" class="btn btn-success px-4 fw-semibold rounded-pill shadow-sm">
                    + Tambah Pegawai
                </a>
                @endcan
            </div>

            {{-- Search --}}
            <form action="{{ route('employees.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-white bg-opacity-75 text-dark border-0"
                        placeholder="Cari Pegawai..." value="{{ request('search') }}">
                    <button class="btn btn-outline-light fw-semibold" type="submit">Cari</button>
                </div>
            </form>

            {{-- Tabel Pegawai (Desktop) --}}
            <div class="table-responsive d-none d-md-block rounded-4 overflow-hidden">
                <table class="table table-hover text-white align-middle text-center m-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Jabatan</th>
                            <th>Keahlian</th>
                            <th style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                        <tr class="table-row-hover">
                            <td>
                                @if ($employee->profile_picture)
                                    <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Foto"
                                        class="rounded-circle border border-white shadow-sm" width="50" height="50"
                                        style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-profile.png') }}" alt="Default"
                                        class="rounded-circle border border-white shadow-sm" width="50" height="50"
                                        style="object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>
                                @forelse ($employee->skills as $skill)
                                    <span class="badge bg-light text-dark fw-normal">{{ $skill->name }}</span>
                                @empty
                                    <span class="text-muted">Belum ada</span>
                                @endforelse
                            </td>
                            <td>
                                <div class="d-flex flex-wrap justify-content-center gap-1">
                                    @can('read-employee')
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @endcan

                                    @can('edit-employee')
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @endcan

                                    @can('delete-employee')
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Hapus pegawai ini?')">
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
                            <td colspan="8" class="text-center text-muted py-4">Tidak ada data pegawai ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Card List (Mobile) --}}
            <div class="card-list-mobile d-block d-md-none">
                @forelse ($employees as $employee)
                    <div class="card mb-3 border-0 bg-white bg-opacity-10 text-white shadow-sm rounded-4">
                        <div class="card-body d-flex flex-column gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <div>
                                    @if ($employee->profile_picture)
                                        <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Foto"
                                            class="rounded-circle border border-white shadow-sm" width="60" height="60"
                                            style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset('images/default-profile.png') }}" alt="Default"
                                            class="rounded-circle border border-white shadow-sm" width="60" height="60"
                                            style="object-fit: cover;">
                                    @endif
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-semibold">{{ $employee->name }}</h5>
                                    <small>{{ $employee->position }}</small>
                                </div>
                            </div>

                            <div>
                                <p class="mb-1"><strong>Email:</strong> {{ $employee->email }}</p>
                                <p class="mb-1"><strong>HP:</strong> {{ $employee->phone }}</p>
                                <p class="mb-1"><strong>Alamat:</strong> {{ $employee->address }}</p>
                                <p class="mb-1"><strong>Skill:</strong>
                                    @forelse ($employee->skills as $skill)
                                        <span class="badge bg-light text-dark">{{ $skill->name }}</span>
                                    @empty
                                        <span class="text-muted">Belum ada</span>
                                    @endforelse
                                </p>
                            </div>

                            <div class="d-flex gap-1 mt-2 flex-wrap">
                                @can('read-employee')
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm w-100">Detail</a>
                                @endcan

                                @can('edit-employee')
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm w-100">Edit</a>
                                @endcan

                                @can('delete-employee')
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="w-100"
                                          onsubmit="return confirm('Hapus pegawai ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted py-4">Tidak ada data pegawai ditemukan</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $employees->withQueryString()->links('pagination::bootstrap-5') }}
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