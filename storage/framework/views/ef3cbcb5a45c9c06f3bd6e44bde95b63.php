

<?php $__env->startSection('title', 'Detail Pesanan'); ?>
<?php $__env->startSection('page-title', 'Detail Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-clipboard-check"></i></div>
        <div>
            <h1 class="h3 mb-1">Detail Pesanan #<?php echo e($booking->id); ?></h1>
            <div class="text-muted">Informasi pesanan dan layanan pelanggan.</div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Informasi Layanan</h2>
                    <span class="badge <?php echo e($booking->status); ?>"><?php echo e(str_replace('_', ' ', ucfirst($booking->status))); ?></span>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Layanan</dt>
                        <dd class="col-sm-8"><?php echo e($booking->service->name ?? 'Layanan'); ?></dd>
                        <dt class="col-sm-4">Jadwal</dt>
                        <dd class="col-sm-8"><?php echo e($booking->scheduled_date?->format('d M Y, H:i') ?? '-'); ?></dd>
                        <dt class="col-sm-4">Harga</dt>
                        <dd class="col-sm-8">Rp <?php echo e(number_format((float) $booking->total_price, 0, ',', '.')); ?></dd>
                        <dt class="col-sm-4">Alamat layanan</dt>
                        <dd class="col-sm-8"><?php echo e($booking->service_location ?: ($booking->customer->address ?? '-')); ?></dd>
                        <dt class="col-sm-4">Catatan pelanggan</dt>
                        <dd class="col-sm-8"><?php echo e($booking->notes ?: '-'); ?></dd>
                        <?php if($booking->completion_notes): ?>
                            <dt class="col-sm-4">Catatan penyelesaian</dt>
                            <dd class="col-sm-8"><?php echo e($booking->completion_notes); ?></dd>
                        <?php endif; ?>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent">
                    <h2 class="h5 mb-0">Pelanggan</h2>
                </div>
                <div class="card-body">
                    <div class="fw-semibold"><?php echo e($booking->customer->name ?? 'Pelanggan'); ?></div>
                    <div class="text-muted"><?php echo e($booking->customer->email ?? '-'); ?></div>
                    <div class="mt-2"><?php echo e($booking->customer->phone ?? '-'); ?></div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <?php if($booking->status === 'pending'): ?>
                        <form action="<?php echo e(route('technician.bookings.accept', $booking)); ?>" method="POST" class="mb-2">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success w-100">Terima Pesanan</button>
                        </form>
                        <form action="<?php echo e(route('technician.bookings.reject', $booking)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <label for="reason" class="form-label">Alasan menolak</label>
                            <textarea id="reason" name="reason" class="form-control mb-2" rows="3" minlength="10" required><?php echo e(old('reason')); ?></textarea>
                            <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mb-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <button type="submit" class="btn btn-outline-danger w-100">Tolak Pesanan</button>
                        </form>
                    <?php elseif($booking->status === 'in_progress'): ?>
                        <form action="<?php echo e(route('technician.bookings.markAsCompleted', $booking)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success w-100">Tandai Selesai</button>
                        </form>
                    <?php endif; ?>
                    <a href="<?php echo e(route('technician.bookings.index')); ?>" class="btn btn-outline-secondary w-100 mt-2">Kembali ke Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\technician\bookings\show.blade.php ENDPATH**/ ?>