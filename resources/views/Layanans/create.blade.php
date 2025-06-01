@extends('layouts.app')

@section('content')
@if(Auth::user()->role !== 'admin')
    <div class="container py-5">
        <div class="alert alert-danger text-white bg-danger rounded-3 shadow">
            <h4 class="fw-bold">Akses Ditolak</h4>
            <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
            <a href="{{ route('layanans.index') }}" class="btn btn-light mt-2">Kembali</a>
        </div>
    </div>
@else
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.08);">
        <div class="card-body text-white">
            <h2 class="fw-bold mb-4">Tambah Layanan Baru</h2>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('layanans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama_layanan" class="form-label">Nama Layanan</label>
                    <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0" id="nama_layanan" name="nama_layanan"
                           value="{{ old('nama_layanan') }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control bg-white bg-opacity-75 text-dark border-0" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control bg-white bg-opacity-75 text-dark border-0" id="harga" name="harga"
                           value="{{ old('harga') }}" min="0" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0" id="kategori" name="kategori"
                           value="{{ old('kategori') }}" required>
                </div>

                <div class="mb-4">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input class="form-control bg-white bg-opacity-75 text-dark border-0" type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">

                    <div id="preview-container" class="mt-3 d-none">
                        <p class="mb-1">Pratinjau gambar:</p>
                        <img id="preview-image" src="#" alt="Pratinjau" class="rounded border" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('layanans.index') }}" class="btn btn-outline-light rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview-image');
        const container = document.getElementById('preview-container');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            container.classList.add('d-none');
            preview.src = '#';
        }
    }
</script>
@endpush

@push('styles')
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
@endpush