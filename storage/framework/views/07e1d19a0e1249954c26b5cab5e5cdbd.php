

<?php $__env->startSection('title', 'Layanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0"><i class="bi bi-wrench-adjustable me-2"></i>Manajemen Layanan</h1>
                <small class="text-muted">Kelola katalog layanan servis yang tersedia</small>
            </div>
            <a href="<?php echo e(route('services.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Tambah Layanan
            </a>
        </div>
    </div>

    <?php if($services->isEmpty()): ?>
        <div class="alert alert-info">Belum ada layanan yang tersedia.</div>
    <?php else: ?>
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Booking</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="fw-semibold"><?php echo e($service->name); ?></div>
                                    <small class="text-muted"><?php echo e(Str::limit($service->description, 60)); ?></small>
                                </td>
                                <td><?php echo e($service->category ?? 'General'); ?></td>
                                <td>Rp <?php echo e(number_format($service->price, 0, ',', '.')); ?></td>
                                <td><?php echo e($service->duration_minutes); ?> menit</td>
                                <td><?php echo e($service->bookings_count ?? 0); ?></td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?php echo e(route('services.show', $service)); ?>" class="btn btn-outline-primary">Detail</a>
                                        <a href="<?php echo e(route('services.edit', $service)); ?>" class="btn btn-outline-warning">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            <?php echo e($services->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\services\index.blade.php ENDPATH**/ ?>