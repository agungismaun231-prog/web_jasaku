

<?php $__env->startSection('title', 'Dashboard Teknisi'); ?>
<?php $__env->startSection('page-title', 'Dashboard Teknisi'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-speedometer2"></i></div>
        <div>
            <h1 class="h3 mb-1">Halo, <?php echo e($user->name); ?></h1>
            <div class="text-muted">Ringkasan pekerjaan dan jadwal servis Anda.</div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm"><div class="card-body">
                <div class="text-muted mb-2">Total Pesanan</div>
                <div class="fs-3 fw-bold"><?php echo e($stats['total_bookings']); ?></div>
            </div></div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm"><div class="card-body">
                <div class="text-muted mb-2">Pesanan Aktif</div>
                <div class="fs-3 fw-bold text-primary"><?php echo e($stats['active_bookings']); ?></div>
            </div></div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm"><div class="card-body">
                <div class="text-muted mb-2">Pesanan Selesai</div>
                <div class="fs-3 fw-bold text-success"><?php echo e($stats['completed_bookings']); ?></div>
            </div></div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm"><div class="card-body">
                <div class="text-muted mb-2">Rating Rata-rata</div>
                <div class="fs-3 fw-bold text-warning">
                    <i class="bi bi-star-fill"></i> <?php echo e(number_format((float) $stats['average_rating'], 1)); ?>

                </div>
            </div></div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?php echo e(route('technician.bookings.index')); ?>" class="btn btn-primary">
            <i class="bi bi-calendar-check me-1"></i> Lihat Pesanan
        </a>
        <a href="<?php echo e(route('technician.tasks.index')); ?>" class="btn btn-outline-primary">
            <i class="bi bi-list-check me-1"></i> Tugas Saya
        </a>
        <a href="<?php echo e(route('technician.profile.show')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-person me-1"></i> Profil
        </a>
    </div>

    <div class="row g-4">
        <div class="col-xl-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Pesanan Aktif</h2>
                    <a href="<?php echo e(route('technician.bookings.index')); ?>" class="small">Lihat semua</a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $activeBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border-bottom py-3">
                            <div class="d-flex justify-content-between gap-3">
                                <div>
                                    <div class="fw-semibold"><?php echo e($booking->service->name ?? 'Layanan'); ?></div>
                                    <div class="text-muted small"><?php echo e($booking->customer->name ?? 'Pelanggan'); ?></div>
                                    <div class="text-muted small">
                                        <?php echo e($booking->scheduled_date?->format('d M Y, H:i') ?? 'Jadwal belum ditentukan'); ?>

                                    </div>
                                </div>
                                <span class="badge <?php echo e($booking->status); ?>"><?php echo e(str_replace('_', ' ', ucfirst($booking->status))); ?></span>
                            </div>
                            <a href="<?php echo e(route('technician.bookings.show', $booking)); ?>" class="btn btn-sm btn-outline-primary mt-2">Detail</a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted mb-0">Belum ada pesanan aktif.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-transparent">
                    <h2 class="h5 mb-0">Jadwal Mendatang</h2>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $upcomingBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border-bottom py-3">
                            <div class="fw-semibold"><?php echo e($booking->service->name ?? 'Layanan'); ?></div>
                            <div class="text-muted small"><?php echo e($booking->customer->name ?? 'Pelanggan'); ?></div>
                            <div class="text-muted small"><?php echo e($booking->scheduled_date?->format('d M Y, H:i') ?? 'Jadwal belum ditentukan'); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted mb-0">Belum ada jadwal mendatang.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent">
                    <h2 class="h5 mb-0">Riwayat Pekerjaan Selesai</h2>
                </div>
                <div class="card-body">
                    <?php if($completedBookings->isEmpty()): ?>
                        <p class="text-muted mb-0">Belum ada pekerjaan yang selesai.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Layanan</th>
                                        <th>Pelanggan</th>
                                        <th>Jadwal</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $completedBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($booking->service->name ?? 'Layanan'); ?></td>
                                            <td><?php echo e($booking->customer->name ?? 'Pelanggan'); ?></td>
                                            <td><?php echo e($booking->scheduled_date?->format('d M Y, H:i') ?? '-'); ?></td>
                                            <td>Rp <?php echo e(number_format((float) $booking->total_price, 0, ',', '.')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3"><?php echo e($completedBookings->links()); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views/technician/dashboard.blade.php ENDPATH**/ ?>