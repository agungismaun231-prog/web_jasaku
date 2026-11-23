

<?php $__env->startSection('title', 'Pesanan Masuk'); ?>
<?php $__env->startSection('page-title', 'Pesanan Masuk'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-calendar-check"></i></div>
        <div>
            <h1 class="h3 mb-1">Pesanan Masuk</h1>
            <div class="text-muted">Pesanan servis yang ditugaskan kepada Anda.</div>
        </div>
    </div>

    <?php if($bookings->isEmpty()): ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-4 text-muted"></i>
                <h2 class="h5 mt-3">Belum ada pesanan</h2>
                <p class="text-muted mb-0">Pesanan yang ditugaskan kepada Anda akan tampil di sini.</p>
            </div>
        </div>
    <?php else: ?>
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
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>#<?php echo e($booking->id); ?></td>
                                <td>
                                    <div class="fw-semibold"><?php echo e($booking->service->name ?? 'Layanan'); ?></div>
                                    <small class="text-muted">Rp <?php echo e(number_format((float) $booking->total_price, 0, ',', '.')); ?></small>
                                </td>
                                <td>
                                    <div><?php echo e($booking->customer->name ?? 'Pelanggan'); ?></div>
                                    <small class="text-muted"><?php echo e($booking->customer->phone ?? '-'); ?></small>
                                </td>
                                <td><?php echo e($booking->scheduled_date?->format('d M Y, H:i') ?? '-'); ?></td>
                                <td><span class="badge <?php echo e($booking->status); ?>"><?php echo e(str_replace('_', ' ', ucfirst($booking->status))); ?></span></td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('technician.bookings.show', $booking)); ?>" class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-body"><?php echo e($bookings->links()); ?></div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\technician\bookings\index.blade.php ENDPATH**/ ?>