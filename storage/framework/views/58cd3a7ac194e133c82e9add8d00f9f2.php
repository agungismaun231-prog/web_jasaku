

<?php $__env->startSection('title', 'Edit Invoice'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-receipt"></i>
        <h1>Edit Invoice <?php echo e($invoice->invoice_number); ?></h1>
    </div>

    <div class="card" style="max-width: 600px;">
        <div class="card-header">
            <i class="bi bi-pencil"></i> Form Edit Invoice
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('invoices.update', $invoice)); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label for="status" class="form-label">Status *</label>
                    <select class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="status" name="status" required>
                        <option value="draft" <?php if(old('status', $invoice->status) === 'draft'): ?> selected <?php endif; ?>>Draft</option>
                        <option value="issued" <?php if(old('status', $invoice->status) === 'issued'): ?> selected <?php endif; ?>>Diterbitkan</option>
                        <option value="paid" <?php if(old('status', $invoice->status) === 'paid'): ?> selected <?php endif; ?>>Dibayar</option>
                        <option value="overdue" <?php if(old('status', $invoice->status) === 'overdue'): ?> selected <?php endif; ?>>Jatuh Tempo</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="paid_date" class="form-label">Tanggal Pembayaran</label>
                    <input type="date" class="form-control <?php $__errorArgs = ['paid_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paid_date" name="paid_date" value="<?php echo e(old('paid_date', $invoice->paid_date?->format('Y-m-d'))); ?>">
                    <?php $__errorArgs = ['paid_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <strong>Ringkasan Invoice</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <th>Nomor Invoice:</th>
                                <td><?php echo e($invoice->invoice_number); ?></td>
                            </tr>
                            <tr>
                                <th>Pelanggan:</th>
                                <td><?php echo e($invoice->booking->customer->name); ?></td>
                            </tr>
                            <tr>
                                <th>Layanan:</th>
                                <td><?php echo e($invoice->booking->service->name); ?></td>
                            </tr>
                            <tr>
                                <th>Subtotal:</th>
                                <td>Rp <?php echo e(number_format($invoice->subtotal, 0, ',', '.')); ?></td>
                            </tr>
                            <tr>
                                <th>Pajak:</th>
                                <td>Rp <?php echo e(number_format($invoice->tax, 0, ',', '.')); ?></td>
                            </tr>
                            <tr>
                                <th><strong>Total:</strong></th>
                                <td><strong>Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Perbarui
                    </button>
                    <a href="<?php echo e(route('invoices.show', $invoice)); ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\invoices\edit.blade.php ENDPATH**/ ?>