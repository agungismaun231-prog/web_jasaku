@extends('layouts.app')

@section('title', 'Pesanan Masuk')
@section('page-title', 'Pesanan Masuk')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-calendar-check"></i></div>
        <div>
            <h1 class="h3 mb-1">Pesanan Masuk</h1>
            <div class="text-muted">Pesanan servis yang ditugaskan kepada Anda.</div>
        </div>
    </div>

    @if($bookings->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-4 text-muted"></i>
                <h2 class="h5 mt-3">Belum ada pesanan</h2>
                <p class="text-muted mb-0">Pesanan yang ditugaskan kepada Anda akan tampil di sini.</p>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Layanan</th>
                            <th>Pelanggan</th>
                            <th>Jadwal</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $booking->service->name ?? 'Layanan' }}</div>
                                    <small class="text-muted">Rp {{ number_format((float) $booking->total_price, 0, ',', '.') }}</small>
                                </td>
                                <td>
                                    <div>{{ $booking->customer->name ?? 'Pelanggan' }}</div>
                                    <small class="text-muted">{{ $booking->customer->phone ?? '-' }}</small>
                                </td>
                                <td>{{ $booking->scheduled_date?->format('d M Y, H:i') ?? '-' }}</td>
                                <td><span class="badge {{ $booking->status }}">{{ str_replace('_', ' ', ucfirst($booking->status)) }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('technician.bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body">{{ $bookings->links() }}</div>
        </div>
    @endif
</div>
@endsection
