@extends('layouts.app')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-clipboard-check"></i></div>
        <div>
            <h1 class="h3 mb-1">Detail Pesanan #{{ $booking->id }}</h1>
            <div class="text-muted">Informasi pesanan dan layanan pelanggan.</div>
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
                    @if($booking->status === 'pending')
                        <form action="{{ route('technician.bookings.accept', $booking) }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Terima Pesanan</button>
                        </form>
                        <form action="{{ route('technician.bookings.reject', $booking) }}" method="POST">
                            @csrf
                            <label for="reason" class="form-label">Alasan menolak</label>
                            <textarea id="reason" name="reason" class="form-control mb-2" rows="3" minlength="10" required>{{ old('reason') }}</textarea>
                            @error('reason')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
                            <button type="submit" class="btn btn-outline-danger w-100">Tolak Pesanan</button>
                        </form>
                    @elseif($booking->status === 'in_progress')
                        <form action="{{ route('technician.bookings.markAsCompleted', $booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Tandai Selesai</button>
                        </form>
                    @endif
                    <a href="{{ route('technician.bookings.index') }}" class="btn btn-outline-secondary w-100 mt-2">Kembali ke Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
