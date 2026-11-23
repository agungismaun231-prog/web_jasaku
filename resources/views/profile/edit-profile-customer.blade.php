@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container-fluid">
    <div class="page-header mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="page-title-icon"><i class="bi bi-person-circle"></i></div>
            <div>
                <h1 class="h3 mb-0">Edit Profil Customer</h1>
                <small class="text-muted">Perbarui data diri dan alamat layanan Anda</small>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('profile.updateProfile') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone ?? '') }}" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="3" required>{{ old('address', $customer->address ?? '') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kota</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city', $customer->city ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kode Pos</label>
                        <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $customer->postal_code ?? '') }}">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
