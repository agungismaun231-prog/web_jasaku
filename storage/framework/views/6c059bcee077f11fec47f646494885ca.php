

<?php $__env->startSection('title', 'Manage Sliders'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-images"></i>
        <h1>Manage Sliders</h1>
    </div>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> <?php echo e($message); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-list"></i> Daftar Slider
                </h5>
                <a href="<?php echo e(route('sliders.create')); ?>" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> Tambah Slider
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php if($sliders->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Preview</th>
                                <th>Judul</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(($sliders->currentPage() - 1) * $sliders->perPage() + $index + 1); ?></td>
                                    <td>
                                        <img src="<?php echo e(asset('storage/' . $slider->image)); ?>" 
                                             alt="<?php echo e($slider->title); ?>" 
                                             style="height: 60px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td>
                                        <strong><?php echo e($slider->title ?? 'Tanpa Judul'); ?></strong>
                                        <br>
                                        <small class="text-muted"><?php echo e(Str::limit($slider->description, 50)); ?></small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info"><?php echo e($slider->sort_order); ?></span>
                                    </td>
                                    <td>
                                        <?php if($slider->is_active): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="<?php echo e(route('sliders.edit', $slider)); ?>" 
                                               class="btn btn-outline-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="<?php echo e(route('sliders.toggleActive', $slider)); ?>" 
                                                  method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" 
                                                        class="btn btn-outline-warning" 
                                                        title="<?php echo e($slider->is_active ? 'Nonaktifkan' : 'Aktifkan'); ?>">
                                                    <i class="bi bi-eye<?php echo e($slider->is_active ? '' : '-slash'); ?>"></i>
                                                </button>
                                            </form>
                                            <form action="<?php echo e(route('sliders.destroy', $slider)); ?>" 
                                                  method="POST" 
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Yakin hapus slider ini?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox"></i> Belum ada slider
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($sliders->hasPages()): ?>
                    <div class="d-flex justify-content-center mt-3">
                        <?php echo e($sliders->links()); ?>

                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">Belum ada slider. Buat slider pertama Anda sekarang!</p>
                    <a href="<?php echo e(route('sliders.create')); ?>" class="btn btn-primary mt-2">
                        <i class="bi bi-plus"></i> Tambah Slider
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .page-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .badge {
            padding: 6px 10px;
            font-weight: 500;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\admin\sliders\index.blade.php ENDPATH**/ ?>