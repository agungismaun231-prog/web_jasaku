

<?php $__env->startSection('title', 'Detail Pelanggan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-people"></i>
        <h1>Detail Pelanggan - <?php echo e($customer->name); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-info-circle"></i> Informasi Pelanggan
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Nama:</th>
                            <td><?php echo e($customer->name); ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?php echo e($customer->email); ?></td>
                        </tr>
                        <tr>
                            <th>Telepon:</th>
                            <td><?php echo e($customer->phone); ?></td>
                        </tr>
                        <tr>
                            <th>Alamat:</th>
                            <td><?php echo e($customer->address); ?></td>
                        </tr>
                        <tr>
                            <th>Kota:</th>
                            <td><?php echo e($customer->city ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Kode Pos:</th>
                            <td><?php echo e($customer->postal_code ?? '-'); ?></td>
                        </tr>
                    </table>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('customers.edit', $customer)); ?>" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-sm btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-calendar-check"></i> Riwayat Pemesanan
                </div>
                <div class="card-body">
                    <?php if($bookings->isEmpty()): ?>
                        <p class="text-muted mb-0">Tidak ada pemesanan.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
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
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\customers\show.blade.php ENDPATH**/ ?>