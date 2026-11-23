

<?php $__env->startSection('title', 'Laporan Pemesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <h1 class="page-title">
            <i class="bi bi-bar-chart"></i> Laporan Pemesanan
        </h1>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <h6>Total Pemesanan</h6>
                <div class="number"><?php echo e($summary['total_bookings'] ?? 0); ?></div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <h6>Selesai</h6>
                <div class="number"><?php echo e($summary['completed'] ?? 0); ?></div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <h6>Tertunda</h6>
                <div class="number"><?php echo e($summary['pending'] ?? 0); ?></div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <h6>Dibatalkan</h6>
                <div class="number"><?php echo e($summary['cancelled'] ?? 0); ?></div>
            </div>
        </div>
    </div>

    <!-- Rate Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="stats-card">
                <h6>Tingkat Penyelesaian</h6>
                <div class="number"><?php echo e($summary['completion_rate'] ?? '0%'); ?></div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="stats-card">
                <h6>Tingkat Pembatalan</h6>
                <div class="number"><?php echo e($summary['cancellation_rate'] ?? '0%'); ?></div>
            </div>
        </div>
    </div>

    <!-- Bookings by Service -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="bi bi-bar-chart"></i> Pemesanan Berdasarkan Layanan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Jumlah Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $by_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($service->name ?? 'N/A'); ?></td>
                            <td><?php echo e($service->count ?? 0); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="2" class="text-center text-muted">Tidak ada data layanan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Daily Trend -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-graph-up"></i> Tren Harian (7 Hari Terakhir)
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jumlah Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $daily_trend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($trend['date']); ?></td>
                            <td><?php echo e($trend['count']); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="2" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\admin\reports\bookings.blade.php ENDPATH**/ ?>