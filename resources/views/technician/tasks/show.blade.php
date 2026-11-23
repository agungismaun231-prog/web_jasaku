@extends('layouts.app')

@section('title', 'Detail Tugas')
@section('page-title', 'Detail Tugas')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-clipboard-check"></i></div>
        <div>
            <h1 class="h3 mb-1">Detail Tugas #{{ $booking->id }}</h1>
            <div class="text-muted">Informasi pekerjaan dan pelanggan.</div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Informasi Layanan</h2>
                    <span class="badge {{ $booking->status }}">{{ str_replace('_', ' ', ucfirst($booking->status)) }}</span>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Layanan</dt>
                        <dd class="col-sm-8">{{ $booking->service->name ?? 'Layanan' }}</dd>
                        <dt class="col-sm-4">Jadwal</dt>
                        <dd class="col-sm-8">{{ $booking->scheduled_date?->format('d M Y, H:i') ?? '-' }}</dd>
                        <dt class="col-sm-4">Harga</dt>
                        <dd class="col-sm-8">Rp {{ number_format((float) $booking->total_price, 0, ',', '.') }}</dd>
                        <dt class="col-sm-4">Alamat layanan</dt>
                        <dd class="col-sm-8">{{ $booking->service_location ?: ($booking->customer->address ?? '-') }}</dd>
                        <dt class="col-sm-4">Catatan pelanggan</dt>
                        <dd class="col-sm-8">{{ $booking->notes ?: '-' }}</dd>
                        @if($booking->completion_notes)
                            <dt class="col-sm-4">Catatan penyelesaian</dt>
                            <dd class="col-sm-8">{{ $booking->completion_notes }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent">
                    <h2 class="h5 mb-0">Pelanggan</h2>
                </div>
                <div class="card-body">
                    <div class="fw-semibold">{{ $booking->customer->name ?? 'Pelanggan' }}</div>
                    <div class="text-muted">{{ $booking->customer->email ?? '-' }}</div>
                    <div class="mt-2">{{ $booking->customer->phone ?? '-' }}</div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    @if($booking->status === 'confirmed')
                        <form action="{{ route('technician.tasks.start', $booking) }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Mulai Tugas</button>
                        </form>
                    @elseif($booking->status === 'in_progress')
                        <form action="{{ route('technician.tasks.complete', $booking) }}" method="POST">
                            @csrf
                            <label for="completion_notes" class="form-label">Catatan penyelesaian</label>
                            <textarea
                                id="completion_notes"
                                name="completion_notes"
                                class="form-control mb-2 @error('completion_notes') is-invalid @enderror"
                                rows="4"
                                maxlength="500"
                                required
                            >{{ old('completion_notes') }}</textarea>
                            @error('completion_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-success w-100">Selesaikan Tugas</button>
                        </form>
                    @endif
                    <a href="{{ route('technician.tasks.index') }}" class="btn btn-outline-secondary w-100 mt-2">Kembali ke Tugas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
