@extends('layouts.app')

@section('title', 'Profil Teknisi')
@section('page-title', 'Profil Teknisi')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-person-badge"></i></div>
        <div>
            <h1 class="h3 mb-1">Profil Teknisi</h1>
            <div class="text-muted">Informasi profil dan ringkasan pekerjaan Anda.</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    @if($technician->photo)
                        <img
                            src="{{ asset('storage/' . $technician->photo) }}"
                            alt="Foto {{ $technician->user->name }}"
                            class="rounded-circle mb-3"
                            width="120"
                            height="120"
                            style="object-fit: cover;"
                        >
                    @else
                        <div class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 120px; height: 120px;">
                            <i class="bi bi-person-fill display-4"></i>
                        </div>
                    @endif
                    <h2 class="h4 mb-1">{{ $technician->user->name }}</h2>
                    <div class="text-muted">{{ $technician->specialization ?: 'Teknisi' }}</div>
                    <a href="{{ route('technician.profile.edit') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-pencil me-1"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row g-3 mb-4">
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted mb-2">Pekerjaan selesai</div>
                            <div class="fs-3 fw-bold text-success">{{ $stats['total_completed'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted mb-2">Rating rata-rata</div>
                            <div class="fs-3 fw-bold text-warning">
                                <i class="bi bi-star-fill"></i> {{ number_format((float) $stats['average_rating'], 1) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted mb-2">Jumlah ulasan</div>
                            <div class="fs-3 fw-bold">{{ $stats['total_reviews'] }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent">
                    <h2 class="h5 mb-0">Informasi Profil</h2>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8">{{ $technician->user->name }}</dd>
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $technician->user->email }}</dd>
                        <dt class="col-sm-4">Nomor telepon</dt>
                        <dd class="col-sm-8">{{ $technician->phone ?: '-' }}</dd>
                        <dt class="col-sm-4">Spesialisasi</dt>
                        <dd class="col-sm-8">{{ $technician->specialization ?: '-' }}</dd>
                        <dt class="col-sm-4">Pengalaman</dt>
                        <dd class="col-sm-8">{{ $technician->years_experience ?? 0 }} tahun</dd>
                        <dt class="col-sm-4">Tentang</dt>
                        <dd class="col-sm-8">{{ $technician->description ?: '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
