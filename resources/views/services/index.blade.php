@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
<div class="container-fluid">
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0"><i class="bi bi-wrench-adjustable me-2"></i>Manajemen Layanan</h1>
                <small class="text-muted">Kelola katalog layanan servis yang tersedia</small>
            </div>
            <a href="{{ route('services.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Tambah Layanan
            </a>
        </div>
    </div>

    @if($services->isEmpty())
        <div class="alert alert-info">Belum ada layanan yang tersedia.</div>
    @else
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Booking</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $service->name }}</div>
                                    <small class="text-muted">{{ Str::limit($service->description, 60) }}</small>
                                </td>
                                <td>{{ $service->category ?? 'General' }}</td>
                                <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                                <td>{{ $service->duration_minutes }} menit</td>
                                <td>{{ $service->bookings_count ?? 0 }}</td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('services.show', $service) }}" class="btn btn-outline-primary">Detail</a>
                                        <a href="{{ route('services.edit', $service) }}" class="btn btn-outline-warning">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection
