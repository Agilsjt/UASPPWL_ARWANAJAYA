@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.1);">
        <div class="card-body text-white">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('employee.index') }}" style="display: inline-flex; align-items: center; padding: 8px; background: none; border: none; cursor: pointer;">
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
                    @if ($employee->profile_picture)
                        <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Foto Profil"
                            class="rounded-circle border border-white shadow-sm" width="150" height="150" style="object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center rounded-circle border border-white shadow-sm" 
                             style="width:150px; height:150px; background-color: rgba(255,255,255,0.1);">
                            <span class="text-muted">Tidak ada foto</span>
                        </div>
                    @endif

                    <h3 class="mt-3 fw-bold text-white">{{ $employee->name }}</h3>
                </div>

                <div class="col-md-8">
                    <table class="table table-borderless text-white">
                        <tbody>
                            <tr>
                                <th class="text-start">Email</th>
                                <td>{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">No. HP</th>
                                <td>{{ $employee->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Alamat</th>
                                <td>{{ $employee->address ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Jabatan</th>
                                <td>{{ $employee->position ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Skills</th>
                                <td>
                                    @if ($employee->skills->count())
                                        @foreach ($employee->skills as $skill)
                                            <span class="badge bg-light text-dark fw-normal me-2 py-1 px-3" style="font-size: 0.9rem;">{{ $skill->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Tidak ada skill yang dimasukkan</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning me-2 px-4 py-2 fw-semibold rounded-pill shadow-sm btn-action">Edit</a>
                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')">
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

