

<?php $__env->startSection('title', 'Performa Teknisi'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <h1 class="page-title">
            <i class="bi bi-person-check"></i> Laporan Performa Teknisi
        </h1>
    </div>

    <!-- Period Info -->
    <div class="card mb-4">
        <div class="card-body">
            <p style="font-size: 14px; color: var(--text-secondary); margin: 0;">
                <strong>Period:</strong> <?php echo e($period['start_date']); ?> - <?php echo e($period['end_date']); ?>

            </p>
        </div>
    </div>

    <!-- Technician Performance Table -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-table"></i> Daftar Teknisi & Performa
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Teknisi</th>
                            <th>Total Pekerjaan</th>
                            <th>Pekerjaan Selesai</th>
                            <th>Tingkat Penyelesaian</th>
                            <th>Rating Rata-rata</th>
                            <th>Total Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $technicians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($tech['name'] ?? 'N/A'); ?></td>
                            <td><?php echo e($tech['total_jobs'] ?? 0); ?></td>
                            <td><?php echo e($tech['completed_jobs'] ?? 0); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($tech['completion_rate'] >= 80 ? 'success' : ($tech['completion_rate'] >= 50 ? 'warning' : 'danger')); ?>">
                                    <?php echo e($tech['completion_rate'] ?? 0); ?>%
                                </span>
                            </td>
                            <td>
                                <span class="text-warning">
                                    <?php for($i = 0; $i < round($tech['avg_rating'] ?? 0); $i++): ?>
                                        <i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                    (<?php echo e($tech['avg_rating'] ?? 0); ?>)
                                </span>
                            </td>
                            <td><?php echo e($tech['total_ratings'] ?? 0); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data teknisi</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\admin\reports\technicians.blade.php ENDPATH**/ ?>