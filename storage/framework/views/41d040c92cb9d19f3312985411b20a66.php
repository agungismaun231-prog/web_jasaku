

<?php $__env->startSection('title', 'Ringkasan Laporan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <h1 class="page-title">
            <i class="bi bi-graph-up"></i> Ringkasan Laporan
        </h1>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <h6>Total Pendapatan</h6>
                <div class="number">Rp <?php echo e(number_format($overview['total_revenue'] ?? 0, 0, ',', '.')); ?></div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <h6>Total Pemesanan</h6>
                <div class="number"><?php echo e($overview['total_bookings'] ?? 0); ?></div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <h6>Total Pelanggan</h6>
                <div class="number"><?php echo e($overview['total_customers'] ?? 0); ?></div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <h6>Total Teknisi</h6>
                <div class="number"><?php echo e($overview['total_technicians'] ?? 0); ?></div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-bar-chart"></i> Tren Pendapatan
                </div>
                <div class="card-body" style="min-height: 300px;">
                    <p class="text-muted"><i class="bi bi-info-circle"></i> Chart data akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-pie-chart"></i> Distribusi Status Pemesanan
                </div>
                <div class="card-body" style="min-height: 300px;">
                    <p class="text-muted"><i class="bi bi-info-circle"></i> Chart data akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-calendar-check"></i> Pemesanan Terbaru
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Teknisi</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recent_bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>#<?php echo e($booking->id); ?></td>
                            <td><?php echo e($booking->customer->name ?? 'N/A'); ?></td>
                            <td><?php echo e($booking->technician->name ?? 'Belum Ditugaskan'); ?></td>
                            <td>
                                <span class="badge bg-info"><?php echo e(ucfirst($booking->status)); ?></span>
                            </td>
                            <td><?php echo e($booking->created_at->format('d M Y')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data pemesanan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\admin\reports\dashboard.blade.php ENDPATH**/ ?>