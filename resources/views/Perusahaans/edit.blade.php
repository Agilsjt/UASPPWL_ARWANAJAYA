@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.08);">
        <div class="card-body text-white">
            <h2 class="fw-bold mb-4">Edit Perusahaan</h2>

            @can('update-perusahaan')
                {{-- Validasi Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('perusahaans.update', $perusahaan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0"
                            id="nama_perusahaan" name="nama_perusahaan" required maxlength="255"
                            value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}">
                    </div>

                    {{-- Judul Deskripsi --}}
                    <div class="mb-3">
                        <label for="judul_deskripsi" class="form-label">Judul Deskripsi</label>
                        <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0"
                            id="judul_deskripsi" name="judul_deskripsi" maxlength="255"
                            value="{{ old('judul_deskripsi', $perusahaan->judul_deskripsi) }}">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control bg-white bg-opacity-75 text-dark border-0"
                            id="deskripsi" name="deskripsi" rows="3" maxlength="500">{{ old('deskripsi', $perusahaan->deskripsi) }}</textarea>
                    </div>

                    <div class="row mb-3">
                        {{-- Alamat --}}
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0"
                                id="alamat" name="alamat" maxlength="255"
                                value="{{ old('alamat', $perusahaan->alamat) }}">
                        </div>

                        {{-- Telepon --}}
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0"
                                id="telepon" name="telepon" maxlength="20"
                                value="{{ old('telepon', $perusahaan->telepon) }}">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control bg-white bg-opacity-75 text-dark border-0"
                            id="email" name="email" maxlength="255"
                            value="{{ old('email', $perusahaan->email) }}">
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select bg-white bg-opacity-75 text-dark border-0" id="status" name="status" required>
                            <option value="aktif" {{ old('status', $perusahaan->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $perusahaan->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    {{-- Logo --}}
                    <div class="mb-4">
                        <label for="logo" class="form-label">Logo Perusahaan</label>
                        <input class="form-control bg-white bg-opacity-75 text-dark border-0" type="file" id="logo" name="logo" accept="image/*">
                        @if ($perusahaan->logo && Storage::disk('public')->exists($perusahaan->logo))
                            <div class="mt-2">
                                <small class="text-light d-block">Logo saat ini:</small>
                                <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo Perusahaan"
                                    class="img-thumbnail mt-2" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('perusahaans.index') }}" class="btn btn-outline-light rounded-pill px-4">Batal</a>
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold">Update</button>
                    </div>
                </form>
            @else
                <div class="alert alert-warning rounded-3">
                    <strong>Anda tidak memiliki izin untuk mengakses halaman ini.</strong>
                </div>
            @endcan
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-select {
        padding: 0.6rem 1rem;
        border-radius: 0.5rem;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        border-color: #ccc;
    }

    .btn {
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .card-body label {
        font-weight: 500;
    }
</style>
@endpush