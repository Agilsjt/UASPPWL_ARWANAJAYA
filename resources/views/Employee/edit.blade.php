@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.08);">
        <div class="card-body text-white">
            <h2 class="fw-bold mb-4">Edit Pegawai</h2>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0" id="name" name="name"
                               value="{{ old('name', $employee->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control bg-white bg-opacity-75 text-dark border-0" id="email" name="email"
                               value="{{ old('email', $employee->email) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">No. HP</label>
                        <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0" id="phone" name="phone"
                               value="{{ old('phone', $employee->phone) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="position" class="form-label">Jabatan</label>
                        <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0" id="position" name="position"
                               value="{{ old('position', $employee->position) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control bg-white bg-opacity-75 text-dark border-0" id="address" name="address" rows="3">{{ old('address', $employee->address) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="skills" class="form-label">Skills</label>
                    <select name="skills[]" id="skills" class="form-select bg-white bg-opacity-75 text-dark border-0" multiple>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}"
                                {{ in_array($skill->id, old('skills', $employee->skills->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $skill->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-light">Tahan dan pilih lebih dari satu untuk memilih beberapa skill</small>
                </div>

                <div class="mb-4">
                    <label for="profile_picture" class="form-label">Foto Profil</label>
                    <input class="form-control bg-white bg-opacity-75 text-dark border-0" type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">

                    <div class="mt-3">
                        @if ($employee->profile_picture)
                            <p class="mb-1">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Foto Saat Ini" class="rounded border" style="width: 100px; height: 100px; object-fit: cover;">
                        @endif

                        <div id="preview-container" class="mt-3 d-none">
                            <p class="mb-1">Pratinjau gambar baru:</p>
                            <img id="preview-image" src="#" alt="Pratinjau" class="rounded border" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('employee.index') }}" class="btn btn-outline-light rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
