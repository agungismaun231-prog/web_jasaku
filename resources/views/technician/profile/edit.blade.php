@extends('layouts.app')

@section('title', 'Edit Profil Teknisi')
@section('page-title', 'Edit Profil Teknisi')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-person-gear"></i></div>
        <div>
            <h1 class="h3 mb-1">Edit Profil Teknisi</h1>
            <div class="text-muted">Perbarui informasi profil Anda.</div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('technician.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama lengkap</label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $technician->user->name) }}" maxlength="255" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Nomor telepon</label>
                        <input id="phone" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $technician->phone) }}" maxlength="20" required>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="specialization" class="form-label">Spesialisasi</label>
                        <input id="specialization" type="text" name="specialization" class="form-control @error('specialization') is-invalid @enderror" value="{{ old('specialization', $technician->specialization) }}" maxlength="100">
                        @error('specialization')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="years_experience" class="form-label">Pengalaman (tahun)</label>
                        <input id="years_experience" type="number" name="years_experience" class="form-control @error('years_experience') is-invalid @enderror" value="{{ old('years_experience', $technician->years_experience ?? 0) }}" min="0">
                        @error('years_experience')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Tentang</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" maxlength="500">{{ old('description', $technician->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="photo" class="form-label">Foto profil</label>
                        <input id="photo" type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept=".jpg,.jpeg,.png,.gif">
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">Format JPG, PNG, atau GIF; ukuran maksimal 2 MB.</div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('technician.profile.show') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
