

<?php $__env->startSection('title', 'Daftar Pemesanan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-calendar-check"></i>
        <h1>Daftar Pemesanan</h1>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-calendar-check"></i> Pemesanan</span>
            <a href="<?php echo e(route('bookings.create')); ?>" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Buat Pemesanan
            </a>
        </div>
        <div class="card-body">
            <?php if($bookings->isEmpty()): ?>
                <p class="text-muted mb-0">Tidak ada pemesanan.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Teknisi</th>
                                <th>Tanggal Jadwal</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($booking->customer->name); ?></td>
                                    <td><?php echo e($booking->service->name); ?></td>
                                    <td><?php echo e($booking->technician?->name ?? '-'); ?></td>
                                    <td><?php echo e($booking->scheduled_date->format('d/m/Y H:i')); ?></td>
                                    <td>Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></td>
                                    <td>
                                        <span class="badge <?php switch($booking->status):
                                            case ('pending'): ?> pending <?php break; ?>
                                            <?php case ('confirmed'): ?> confirmed <?php break; ?>
                                            <?php case ('in_progress'): ?> in_progress <?php break; ?>
                                            <?php case ('completed'): ?> completed <?php break; ?>
                                            <?php case ('cancelled'): ?> cancelled <?php break; ?>
                                        <?php endswitch; ?>">
                                            <?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('bookings.show', $booking)); ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('bookings.edit', $booking)); ?>" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    <?php echo e($bookings->links('pagination::bootstrap-5')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\bookings\index.blade.php ENDPATH**/ ?>