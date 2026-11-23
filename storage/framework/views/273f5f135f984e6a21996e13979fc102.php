

<?php $__env->startSection('title', 'Detail Penghasilan'); ?>
<?php $__env->startSection('page-title', 'Detail Penghasilan'); ?>

<?php $__env->startSection('content'); ?>
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
            <?php echo e($stats['total_completed']); ?> pekerjaan selesai
            <span class="mx-1">·</span>
            Total Rp <?php echo e(number_format((float) $stats['total_earnings'], 0, ',', '.')); ?>

        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('technician.earnings.index')); ?>" class="btn btn-outline-secondary">Kembali</a>
            <a href="<?php echo e(route('technician.earnings.export')); ?>" class="btn btn-outline-primary">
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
                <?php if($stats['by_service']->isEmpty()): ?>
                    <div class="card-body text-muted">Belum ada data penghasilan.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead><tr><th>Layanan</th><th>Pekerjaan</th><th class="text-end">Total</th></tr></thead>
                            <tbody>
                                <?php $__currentLoopData = $stats['by_service']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service => $summary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($service ?: 'Layanan'); ?></td>
                                        <td><?php echo e($summary['count']); ?></td>
                                        <td class="text-end">Rp <?php echo e(number_format((float) $summary['total'], 0, ',', '.')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent">
                    <h2 class="h5 mb-0">Penghasilan berdasarkan bulan</h2>
                </div>
                <?php if($stats['by_month']->isEmpty()): ?>
                    <div class="card-body text-muted">Belum ada data penghasilan.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead><tr><th>Bulan</th><th class="text-end">Total</th></tr></thead>
                            <tbody>
                                <?php $__currentLoopData = $stats['by_month']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($month); ?></td>
                                        <td class="text-end">Rp <?php echo e(number_format((float) $total, 0, ',', '.')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent">
            <h2 class="h5 mb-0">Riwayat pekerjaan selesai</h2>
        </div>
        <?php if($bookings->isEmpty()): ?>
            <div class="card-body text-center py-5">
                <p class="text-muted mb-0">Belum ada pekerjaan selesai.</p>
            </div>
        <?php else: ?>
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
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>#<?php echo e($booking->id); ?></td>
                                <td><?php echo e($booking->customer->name ?? 'Pelanggan'); ?></td>
                                <td><?php echo e($booking->service->name ?? 'Layanan'); ?></td>
                                <td><?php echo e($booking->updated_at?->format('d M Y') ?? '-'); ?></td>
                                <td>
                                    <?php if($booking->invoice): ?>
                                        <span class="badge <?php echo e($booking->invoice->status === 'paid' ? 'bg-success' : 'bg-warning text-dark'); ?>">
                                            <?php echo e(ucfirst(str_replace('_', ' ', $booking->invoice->status))); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Belum ada invoice</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">Rp <?php echo e(number_format((float) ($booking->invoice?->total ?? 0), 0, ',', '.')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-body"><?php echo e($bookings->links()); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\technician\earnings\details.blade.php ENDPATH**/ ?>