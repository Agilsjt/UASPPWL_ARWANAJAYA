@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 rounded-4 shadow-lg" style="background-color: rgba(255, 255, 255, 0.08);">
        <div class="card-body text-white">
            <h2 class="fw-bold mb-4">Tambah User</h2>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control bg-white bg-opacity-75 text-dark border-0" id="name" name="name" required value="{{ old('name') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control bg-white bg-opacity-75 text-dark border-0" id="email" name="email" required value="{{ old('email') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control bg-white bg-opacity-75 text-dark border-0" id="password" name="password" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control bg-white bg-opacity-75 text-dark border-0" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="roles" class="form-label">Role</label>
                    <select name="roles[]" id="roles" class="form-select bg-white bg-opacity-75 text-dark border-0" multiple>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ collect(old('roles'))->contains($role->name) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-light">Tahan dan pilih lebih dari satu jika ingin memberikan banyak role</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-light rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold">Simpan</button>
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
