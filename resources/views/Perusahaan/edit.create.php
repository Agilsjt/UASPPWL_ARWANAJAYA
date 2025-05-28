@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.08); ">
        <div class="card-body text-white">
            <h2 class="fw-bold mb-4">Edit Perusahaan</h2>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0" id="nama_perusahaan" name="nama_perusahaan" required value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control bg-white bg-opacity-75 text-dark border-0" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $perusahaan->deskripsi) }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0" id="alamat" name="alamat" value="{{ old('alamat', $perusahaan->alamat) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0" id="telepon" name="telepon" value="{{ old('telepon', $perusahaan->telepon) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control bg-white bg-opacity-75 text-dark border-0" id="email" name="email" value="{{ old('email', $perusahaan->email) }}">
                </div>

                <div class="mb-4">
                    <label for="logo" class="form-label">Logo Perusahaan</label>
                    <input class="form-control bg-white bg-opacity-75 text-dark border-0" type="file" id="logo" name="logo">
                    @if ($perusahaan->logo)
                        <small class="text-light d-block mt-2">Logo saat ini: <br>
                            <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo Perusahaan" class="img-thumbnail mt-2" style="max-height: 100px;">
                        </small>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('perusahaan.index') }}" class="btn btn-outline-light rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
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
