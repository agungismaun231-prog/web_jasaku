@extends('layouts.app')

@section('title', 'Detail Penghasilan')
@section('page-title', 'Detail Penghasilan')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-clipboard-data"></i></div>
        <div>
            <h1 class="h3 mb-1">Detail Penghasilan</h1>
            <div class="text-muted">Rincian pembayaran dari pekerjaan yang telah selesai.</div>
        </div>
    </div>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div class="text-muted">
            {{ $stats['total_completed'] }} pekerjaan selesai
            <span class="mx-1">·</span>
            Total Rp {{ number_format((float) $stats['total_earnings'], 0, ',', '.') }}
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('technician.earnings.index') }}" class="btn btn-outline-secondary">Kembali</a>
            <a href="{{ route('technician.earnings.export') }}" class="btn btn-outline-primary">
                <i class="bi bi-download me-1"></i> Ekspor CSV
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent">
                    <h2 class="h5 mb-0">Penghasilan berdasarkan layanan</h2>
                </div>
                @if($stats['by_service']->isEmpty())
                    <div class="card-body text-muted">Belum ada data penghasilan.</div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead><tr><th>Layanan</th><th>Pekerjaan</th><th class="text-end">Total</th></tr></thead>
                            <tbody>
                                @foreach($stats['by_service'] as $service => $summary)
                                    <tr>
                                        <td>{{ $service ?: 'Layanan' }}</td>
                                        <td>{{ $summary['count'] }}</td>
                                        <td class="text-end">Rp {{ number_format((float) $summary['total'], 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent">
                    <h2 class="h5 mb-0">Penghasilan berdasarkan bulan</h2>
                </div>
                @if($stats['by_month']->isEmpty())
                    <div class="card-body text-muted">Belum ada data penghasilan.</div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead><tr><th>Bulan</th><th class="text-end">Total</th></tr></thead>
                            <tbody>
                                @foreach($stats['by_month'] as $month => $total)
                                    <tr>
                                        <td>{{ $month }}</td>
                                        <td class="text-end">Rp {{ number_format((float) $total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent">
            <h2 class="h5 mb-0">Riwayat pekerjaan selesai</h2>
        </div>
        @if($bookings->isEmpty())
            <div class="card-body text-center py-5">
                <p class="text-muted mb-0">Belum ada pekerjaan selesai.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Tanggal selesai</th>
                            <th>Pembayaran</th>
                            <th class="text-end">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>{{ $booking->customer->name ?? 'Pelanggan' }}</td>
                                <td>{{ $booking->service->name ?? 'Layanan' }}</td>
                                <td>{{ $booking->updated_at?->format('d M Y') ?? '-' }}</td>
                                <td>
                                    @if($booking->invoice)
                                        <span class="badge {{ $booking->invoice->status === 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ ucfirst(str_replace('_', ' ', $booking->invoice->status)) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">Belum ada invoice</span>
                                    @endif
                                </td>
                                <td class="text-end">Rp {{ number_format((float) ($booking->invoice?->total ?? 0), 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body">{{ $bookings->links() }}</div>
        @endif
    </div>
</div>
@endsection
