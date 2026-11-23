

<?php $__env->startSection('title', 'Daftar Invoice'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-receipt"></i>
        <h1>Daftar Invoice</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <span><i class="bi bi-receipt"></i> Invoice</span>
        </div>
        <div class="card-body">
            <?php if($invoices->isEmpty()): ?>
                <p class="text-muted mb-0">Tidak ada invoice.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nomor Invoice</th>
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal Pembuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e($invoice->invoice_number); ?></strong></td>
                                    <td><?php echo e($invoice->booking->customer->name); ?></td>
                                    <td><?php echo e($invoice->booking->service->name); ?></td>
                                    <td>Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></td>
                                    <td>
                                        <span class="badge <?php if($invoice->status === 'paid'): ?> bg-success <?php elseif($invoice->status === 'overdue'): ?> bg-danger <?php elseif($invoice->status === 'issued'): ?> bg-primary <?php else: ?> bg-secondary <?php endif; ?>">
                                            <?php echo e(ucfirst($invoice->status)); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($invoice->created_at->format('d/m/Y H:i')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('invoices.show', $invoice)); ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('invoices.edit', $invoice)); ?>" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    <?php echo e($invoices->links('pagination::bootstrap-5')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\invoices\index.blade.php ENDPATH**/ ?>