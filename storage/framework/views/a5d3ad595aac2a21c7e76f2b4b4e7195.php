

<?php $__env->startSection('title', 'Tugas Saya'); ?>
<?php $__env->startSection('page-title', 'Tugas Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-list-check"></i></div>
        <div>
            <h1 class="h3 mb-1">Tugas Saya</h1>
            <div class="text-muted">Daftar pekerjaan yang perlu Anda tangani.</div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted mb-2">Menunggu dikerjakan</div>
                    <div class="fs-3 fw-bold text-warning"><?php echo e($stats['pending_tasks']); ?></div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted mb-2">Sedang dikerjakan</div>
                    <div class="fs-3 fw-bold text-primary"><?php echo e($stats['in_progress_tasks']); ?></div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted mb-2">Selesai hari ini</div>
                    <div class="fs-3 fw-bold text-success"><?php echo e($stats['completed_today']); ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php if($tasks->isEmpty()): ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-4 text-muted"></i>
                <h2 class="h5 mt-3">Belum ada tugas aktif</h2>
                <p class="text-muted mb-0">Tugas yang sudah dikonfirmasi akan tampil di sini.</p>
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
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>#<?php echo e($task->id); ?></td>
                                <td>
                                    <div class="fw-semibold"><?php echo e($task->service->name ?? 'Layanan'); ?></div>
                                    <small class="text-muted">Rp <?php echo e(number_format((float) $task->total_price, 0, ',', '.')); ?></small>
                                </td>
                                <td>
                                    <div><?php echo e($task->customer->name ?? 'Pelanggan'); ?></div>
                                    <small class="text-muted"><?php echo e($task->customer->phone ?? '-'); ?></small>
                                </td>
                                <td><?php echo e($task->scheduled_date?->format('d M Y, H:i') ?? '-'); ?></td>
                                <td><span class="badge <?php echo e($task->status); ?>"><?php echo e(str_replace('_', ' ', ucfirst($task->status))); ?></span></td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('technician.tasks.show', $task)); ?>" class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-body"><?php echo e($tasks->links()); ?></div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views/technician/tasks/index.blade.php ENDPATH**/ ?>