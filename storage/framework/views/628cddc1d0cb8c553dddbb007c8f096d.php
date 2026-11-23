

<?php $__env->startSection('title', 'Manajemen Penyedia Jasa'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h3 mb-0">
                    <i class="fas fa-tools me-2"></i>Manajemen Penyedia Jasa
                </h1>
                <small class="text-muted">Kelola data teknisi dan penyedia layanan</small>
            </div>
            <div class="col-md-4 text-end">
                <a href="<?php echo e(route('technicians.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Teknisi
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Teknisi</h6>
                    <h3 class="mb-0"><?php echo e($stats['total'] ?? 0); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Sedang Aktif</h6>
                    <h3 class="mb-0 text-success"><?php echo e($stats['active'] ?? 0); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Rating Rata-rata</h6>
                    <h3 class="mb-0"><?php echo e(number_format($stats['avg_rating'] ?? 0, 1)); ?>/5</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Pesanan Selesai</h6>
                    <h3 class="mb-0"><?php echo e($stats['completed_jobs'] ?? 0); ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <select name="rating" class="form-select">
                        <option value="">Semua Rating</option>
                        <option value="5" <?php echo e(request('rating') === '5' ? 'selected' : ''); ?>>★★★★★ (5.0)</option>
                        <option value="4" <?php echo e(request('rating') === '4' ? 'selected' : ''); ?>>★★★★☆ (4.0+)</option>
                        <option value="3" <?php echo e(request('rating') === '3' ? 'selected' : ''); ?>>★★★☆☆ (3.0+)</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Technicians Table -->
    <?php if($technicians && $technicians->count() > 0): ?>
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Teknisi</th>
                            <th>Email</th>
                            <th>Keahlian</th>
                            <th>Pengalaman</th>
                            <th>Rating</th>
                            <th>Pesanan Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $technicians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($tech->user->name); ?></strong>
                                </td>
                                <td>
                                    <small class="text-muted"><?php echo e($tech->user->email); ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark"><?php echo e($tech->specialization ?? 'General'); ?></span>
                                </td>
                                <td>
                                    <?php echo e($tech->experience_years ?? 0); ?> tahun
                                </td>
                                <td>
                                    <div class="text-warning">
                                        <?php for($i = 0; $i < 5; $i++): ?>
                                            <?php if($i < floor($tech->average_rating ?? 0)): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <small class="text-muted ms-1"><?php echo e(number_format($tech->average_rating ?? 0, 1)); ?>/5</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info"><?php echo e($tech->completed_jobs ?? 0); ?></span>
                                </td>
                                <td>
                                    <?php if($tech->user->role === 'active'): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?php echo e(route('technicians.show', $tech)); ?>" class="btn btn-outline-primary" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('technicians.edit', $tech)); ?>" class="btn btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('technicians.destroy', $tech)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-outline-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($technicians->links()); ?>

        </div>
    <?php else: ?>
        <div class="card shadow-sm border-0 text-center py-5">
            <i class="fas fa-inbox" style="font-size: 48px; color: #ccc;"></i>
            <h5 class="mt-3 text-muted">Tidak Ada Teknisi</h5>
        </div>
    <?php endif; ?>
</div>

<style>
    .page-header {
        padding: 20px 0;
        border-bottom: 1px solid #dee2e6;
    }
    
    table tr:hover {
        background-color: #f8f9fa;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\admin\technicians\index.blade.php ENDPATH**/ ?>