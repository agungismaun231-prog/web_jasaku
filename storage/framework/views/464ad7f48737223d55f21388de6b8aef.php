

<?php $__env->startSection('title', 'Analisis Pelanggan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <h1 class="page-title">
            <i class="bi bi-people-fill"></i> Analisis Pelanggan
        </h1>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="stats-card">
                <h6>Pelanggan Baru</h6>
                <div class="number"><?php echo e($summary['new_customers'] ?? 0); ?></div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="stats-card">
                <h6>Pelanggan Kembali</h6>
                <div class="number"><?php echo e($summary['returning_customers'] ?? 0); ?></div>
            </div>
        </div>
    </div>

    <!-- Period Info -->
    <div class="card mb-4">
        <div class="card-body">
            <p style="font-size: 14px; color: var(--text-secondary); margin: 0;">
                <strong>Period:</strong> <?php echo e($period['start_date']); ?> - <?php echo e($period['end_date']); ?>

            </p>
        </div>
    </div>

    <!-- Top Customers -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-graph-up"></i> Top 10 Pelanggan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Jumlah Pemesanan</th>
                            <th>Total Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $top_customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($customer->name ?? 'N/A'); ?></td>
                            <td><?php echo e($customer->total_bookings ?? 0); ?></td>
                            <td>Rp <?php echo e(number_format($customer->total_spent ?? 0, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Tidak ada data pelanggan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\admin\reports\customers.blade.php ENDPATH**/ ?>