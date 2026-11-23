

<?php $__env->startSection('title', 'Invoice Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h3 mb-0">
                    <i class="fas fa-file-invoice-dollar me-2"></i>Invoice Saya
                </h1>
                <small class="text-muted">Kelola tagihan dan pembayaran Anda</small>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Tagihan</h6>
                    <h3 class="mb-0"><?php echo e($stats['total_invoices'] ?? 0); ?></h3>
                    <small class="text-muted">invoice</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Belum Dibayar</h6>
                    <h3 class="mb-0 text-danger"><?php echo e($stats['unpaid_count'] ?? 0); ?></h3>
                    <small class="text-muted">Rp <?php echo e(number_format($stats['unpaid_total'] ?? 0, 0, ',', '.')); ?></small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Sudah Dibayar</h6>
                    <h3 class="mb-0 text-success"><?php echo e($stats['paid_count'] ?? 0); ?></h3>
                    <small class="text-muted">Rp <?php echo e(number_format($stats['paid_total'] ?? 0, 0, ',', '.')); ?></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari invoice..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="unpaid" <?php echo e(request('status') === 'unpaid' ? 'selected' : ''); ?>>Belum Dibayar</option>
                        <option value="paid" <?php echo e(request('status') === 'paid' ? 'selected' : ''); ?>>Sudah Dibayar</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Invoices Table -->
    <?php if($invoices && $invoices->count() > 0): ?>
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice #</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <strong>#<?php echo e($invoice->invoice_number); ?></strong>
                                </td>
                                <td>
                                    <?php echo e($invoice->booking->service->name ?? '-'); ?>

                                </td>
                                <td>
                                    <?php echo e($invoice->created_at->format('d M Y')); ?>

                                </td>
                                <td>
                                    <strong>Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></strong>
                                </td>
                                <td>
                                    <?php if($invoice->status === 'paid'): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle"></i> Lunas
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle"></i> Belum Dibayar
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($invoice->due_date ? $invoice->due_date->format('d M Y') : '-'); ?>

                                    <?php if($invoice->status === 'unpaid' && $invoice->due_date && $invoice->due_date->isPast()): ?>
                                        <br><small class="text-danger">JATUH TEMPO</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo e(route('customer.invoice.show', $invoice)); ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        
                                        <?php if($invoice->status === 'unpaid'): ?>
                                            <a href="<?php echo e(route('customer.payment.form', $invoice)); ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-money-bill"></i> Bayar
                                            </a>
                                        <?php endif; ?>
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
            <?php echo e($invoices->links()); ?>

        </div>
    <?php else: ?>
        <div class="card shadow-sm border-0 text-center py-5">
            <i class="fas fa-file-invoice" style="font-size: 48px; color: #ccc;"></i>
            <h5 class="mt-3 text-muted">Belum Ada Invoice</h5>
            <p class="text-muted">Semua pesanan Anda selesai dan sudah dibayar!</p>
        </div>
    <?php endif; ?>
</div>

<style>
    .page-header {
        padding: 20px 0;
        border-bottom: 1px solid #dee2e6;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\customer\invoices\index.blade.php ENDPATH**/ ?>