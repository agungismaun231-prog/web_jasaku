

<?php $__env->startSection('title', 'Laporan Pendapatan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <h1 class="page-title">
            <i class="bi bi-cash-coin"></i> Laporan Pendapatan
        </h1>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="stats-card">
                <h6>Total Pendapatan</h6>
                <div class="number">Rp <?php echo e(number_format($summary['total_revenue'] ?? 0, 0, ',', '.')); ?></div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-card">
                <h6>Pendapatan Terbayar</h6>
                <div class="number">Rp <?php echo e(number_format($summary['paid_revenue'] ?? 0, 0, ',', '.')); ?></div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stats-card">
                <h6>Pendapatan Tertunda</h6>
                <div class="number">Rp <?php echo e(number_format($summary['pending_revenue'] ?? 0, 0, ',', '.')); ?></div>
            </div>
        </div>
    </div>

    <!-- Period Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <p style="font-size: 14px; color: var(--text-secondary);">
                <strong>Period:</strong> <?php echo e($period['start_date']); ?> - <?php echo e($period['end_date']); ?>

            </p>
        </div>
    </div>

    <!-- Revenue by Service -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="bi bi-bar-chart"></i> Pendapatan Berdasarkan Layanan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Jumlah Pesanan</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $revenue_by_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($service->name ?? 'N/A'); ?></td>
                            <td><?php echo e($service->total_bookings ?? 0); ?></td>
                            <td>Rp <?php echo e(number_format($service->revenue ?? 0, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Tidak ada data layanan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Payment Status -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-pie-chart"></i> Status Pembayaran
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $payment_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <span class="badge bg-<?php echo e($status->status === 'paid' ? 'success' : ($status->status === 'pending' ? 'warning' : 'danger')); ?>">
                                    <?php echo e(ucfirst($status->status)); ?>

                                </span>
                            </td>
                            <td><?php echo e($status->count ?? 0); ?></td>
                            <td>Rp <?php echo e(number_format($status->total ?? 0, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Tidak ada data pembayaran</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\admin\reports\revenue.blade.php ENDPATH**/ ?>