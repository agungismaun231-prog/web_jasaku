

<?php $__env->startSection('title', 'Profil Teknisi'); ?>
<?php $__env->startSection('page-title', 'Profil Teknisi'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-person-badge"></i></div>
        <div>
            <h1 class="h3 mb-1">Profil Teknisi</h1>
            <div class="text-muted">Informasi profil dan ringkasan pekerjaan Anda.</div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <?php if($technician->photo): ?>
                        <img
                            src="<?php echo e(asset('storage/' . $technician->photo)); ?>"
                            alt="Foto <?php echo e($technician->user->name); ?>"
                            class="rounded-circle mb-3"
                            width="120"
                            height="120"
                            style="object-fit: cover;"
                        >
                    <?php else: ?>
                        <div class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 120px; height: 120px;">
                            <i class="bi bi-person-fill display-4"></i>
                        </div>
                    <?php endif; ?>
                    <h2 class="h4 mb-1"><?php echo e($technician->user->name); ?></h2>
                    <div class="text-muted"><?php echo e($technician->specialization ?: 'Teknisi'); ?></div>
                    <a href="<?php echo e(route('technician.profile.edit')); ?>" class="btn btn-primary mt-3">
                        <i class="bi bi-pencil me-1"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row g-3 mb-4">
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted mb-2">Pekerjaan selesai</div>
                            <div class="fs-3 fw-bold text-success"><?php echo e($stats['total_completed']); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted mb-2">Rating rata-rata</div>
                            <div class="fs-3 fw-bold text-warning">
                                <i class="bi bi-star-fill"></i> <?php echo e(number_format((float) $stats['average_rating'], 1)); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-muted mb-2">Jumlah ulasan</div>
                            <div class="fs-3 fw-bold"><?php echo e($stats['total_reviews']); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent">
                    <h2 class="h5 mb-0">Informasi Profil</h2>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8"><?php echo e($technician->user->name); ?></dd>
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8"><?php echo e($technician->user->email); ?></dd>
                        <dt class="col-sm-4">Nomor telepon</dt>
                        <dd class="col-sm-8"><?php echo e($technician->phone ?: '-'); ?></dd>
                        <dt class="col-sm-4">Spesialisasi</dt>
                        <dd class="col-sm-8"><?php echo e($technician->specialization ?: '-'); ?></dd>
                        <dt class="col-sm-4">Pengalaman</dt>
                        <dd class="col-sm-8"><?php echo e($technician->years_experience ?? 0); ?> tahun</dd>
                        <dt class="col-sm-4">Tentang</dt>
                        <dd class="col-sm-8"><?php echo e($technician->description ?: '-'); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views/technician/profile/show.blade.php ENDPATH**/ ?>