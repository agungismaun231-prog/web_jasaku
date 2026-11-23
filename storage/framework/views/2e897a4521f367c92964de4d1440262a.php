

<?php $__env->startSection('title', 'Penghasilan'); ?>
<?php $__env->startSection('page-title', 'Penghasilan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-wallet2"></i></div>
        <div>
            <h1 class="h3 mb-1">Penghasilan</h1>
            <div class="text-muted">Ringkasan pendapatan dari pekerjaan yang telah selesai.</div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted mb-2">Total penghasilan</div>
                    <div class="fs-4 fw-bold text-success">Rp <?php echo e(number_format((float) $stats['total_earnings'], 0, ',', '.')); ?></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted mb-2">Rata-rata per pekerjaan</div>
                    <div class="fs-4 fw-bold">Rp <?php echo e(number_format((float) $stats['average_job_value'], 0, ',', '.')); ?></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted mb-2">Penghasilan bulan ini</div>
                    <div class="fs-4 fw-bold text-primary">Rp <?php echo e(number_format((float) $stats['this_month_earnings'], 0, ',', '.')); ?></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted mb-2">Pembayaran tertunda</div>
                    <div class="fs-4 fw-bold text-warning">Rp <?php echo e(number_format((float) $stats['pending_payment'], 0, ',', '.')); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h2 class="h5 mb-0">Pekerjaan terbaru yang selesai</h2>
            <div class="d-flex gap-2">
                <a href="<?php echo e(route('technician.earnings.details')); ?>" class="btn btn-sm btn-outline-primary">Lihat detail</a>
                <a href="<?php echo e(route('technician.earnings.export')); ?>" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-download me-1"></i> Ekspor CSV
                </a>
            </div>
        </div>

        <?php if($recentBookings->isEmpty()): ?>
            <div class="card-body text-center py-5">
                <i class="bi bi-wallet display-4 text-muted"></i>
                <h3 class="h5 mt-3">Belum ada penghasilan</h3>
                <p class="text-muted mb-0">Pekerjaan yang sudah selesai akan tampil di sini.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Layanan</th>
                            <th>Tanggal selesai</th>
                            <th>Pembayaran</th>
                            <th class="text-end">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>#<?php echo e($booking->id); ?></td>
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
            <div class="card-body"><?php echo e($recentBookings->links()); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\technician\earnings\index.blade.php ENDPATH**/ ?>