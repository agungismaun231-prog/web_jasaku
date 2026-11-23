

<?php $__env->startSection('title', 'Detail Invoice'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-receipt"></i>
        <h1>Invoice <?php echo e($invoice->invoice_number); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="bi bi-receipt"></i> Detail Invoice
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Data Pelanggan</h6>
                            <p class="mb-1"><strong><?php echo e($invoice->booking->customer->name); ?></strong></p>
                            <p class="mb-1"><?php echo e($invoice->booking->customer->email); ?></p>
                            <p class="mb-1"><?php echo e($invoice->booking->customer->phone); ?></p>
                            <p><?php echo e($invoice->booking->customer->address); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Data Invoice</h6>
                            <p class="mb-1"><strong>Nomor:</strong> <?php echo e($invoice->invoice_number); ?></p>
                            <p class="mb-1"><strong>Status:</strong> 
                                <span class="badge <?php if($invoice->status === 'paid'): ?> bg-success <?php elseif($invoice->status === 'overdue'): ?> bg-danger <?php elseif($invoice->status === 'issued'): ?> bg-primary <?php else: ?> bg-secondary <?php endif; ?>">
                                    <?php echo e(ucfirst($invoice->status)); ?>

                                </span>
                            </p>
                            <p class="mb-1"><strong>Tanggal:</strong> <?php echo e($invoice->created_at->format('d/m/Y')); ?></p>
                            <p class="mb-1"><strong>Jatuh Tempo:</strong> <?php echo e($invoice->due_date ? $invoice->due_date->format('d/m/Y') : '-'); ?></p>
                            <?php if($invoice->paid_date): ?>
                            <p><strong>Tanggal Pembayaran:</strong> <?php echo e($invoice->paid_date->format('d/m/Y H:i')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="mb-3">Detail Layanan</h6>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Layanan</th>
                                <th>Tanggal Jadwal</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo e($invoice->booking->service->name); ?></td>
                                <td><?php echo e($invoice->booking->scheduled_date->format('d/m/Y H:i')); ?></td>
                                <td>Rp <?php echo e(number_format($invoice->subtotal, 0, ',', '.')); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Subtotal:</th>
                                        <td class="text-end">Rp <?php echo e(number_format($invoice->subtotal, 0, ',', '.')); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pajak (10%):</th>
                                        <td class="text-end">Rp <?php echo e(number_format($invoice->tax, 0, ',', '.')); ?></td>
                                    </tr>
                                    <tr class="table-active">
                                        <th><strong>Total:</strong></th>
                                        <td class="text-end"><strong>Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="bi bi-calendar-check"></i> Pemesanan Terkait
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>ID Pemesanan:</th>
                            <td><a href="<?php echo e(route('bookings.show', $invoice->booking)); ?>">#<?php echo e($invoice->booking->id); ?></a></td>
                        </tr>
                        <tr>
                            <th>Teknisi:</th>
                            <td><?php echo e($invoice->booking->technician?->name ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Status Pemesanan:</th>
                            <td>
                                <span class="badge <?php switch($invoice->booking->status):
                                    case ('pending'): ?> pending <?php break; ?>
                                    <?php case ('confirmed'): ?> confirmed <?php break; ?>
                                    <?php case ('in_progress'): ?> in_progress <?php break; ?>
                                    <?php case ('completed'): ?> completed <?php break; ?>
                                    <?php case ('cancelled'): ?> cancelled <?php break; ?>
                                <?php endswitch; ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $invoice->booking->status))); ?>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <?php if(auth()->user()->role === 'admin'): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="bi bi-tools"></i> Aksi
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <a href="<?php echo e(route('invoices.edit', $invoice)); ?>" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    
                    <?php if($invoice->status !== 'paid'): ?>
                    <form action="<?php echo e(route('invoices.markAsPaid', $invoice)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success w-100" onclick="return confirm('Tandai invoice sebagai dibayar?')">
                            <i class="bi bi-check-circle"></i> Tandai Dibayar
                        </button>
                    </form>
                    <?php endif; ?>

                    <a href="<?php echo e(route('bookings.show', $invoice->booking)); ?>" class="btn btn-info">
                        <i class="bi bi-calendar-check"></i> Lihat Pemesanan
                    </a>

                    <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <?php else: ?>
            <div class="card mb-3">
                <div class="card-body text-center py-4">
                    <p class="text-muted mb-3"><strong>Detail Invoice Anda</strong></p>
                    <a href="<?php echo e(route('customer.dashboard')); ?>" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <!-- Payment Methods Section -->
            <?php if($invoice->status !== 'paid'): ?>
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-credit-card"></i> Metode Pembayaran
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <!-- Bank BCA -->
                        <div class="col-12">
                            <div class="payment-method-info card border-light" style="padding: 12px;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><i class="bi bi-bank"></i> <strong>Bank BCA</strong></h6>
                                        <small class="text-muted d-block">No. Rekening: 123 456 7890</small>
                                        <small class="text-muted d-block">A/N: PT JASA SERVIS AC</small>
                                    </div>
                                    <span class="badge bg-primary">Online</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bank Mandiri -->
                        <div class="col-12">
                            <div class="payment-method-info card border-light" style="padding: 12px;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><i class="bi bi-bank"></i> <strong>Bank Mandiri</strong></h6>
                                        <small class="text-muted d-block">No. Rekening: 987 654 3210</small>
                                        <small class="text-muted d-block">A/N: PT JASA SERVIS AC</small>
                                    </div>
                                    <span class="badge bg-danger">Online</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bank BNI -->
                        <div class="col-12">
                            <div class="payment-method-info card border-light" style="padding: 12px;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><i class="bi bi-bank"></i> <strong>Bank BNI</strong></h6>
                                        <small class="text-muted d-block">No. Rekening: 246 813 5790</small>
                                        <small class="text-muted d-block">A/N: PT JASA SERVIS AC</small>
                                    </div>
                                    <span class="badge bg-info">Online</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-2">

                        <!-- Dana -->
                        <div class="col-12">
                            <div class="payment-method-info card border-light" style="padding: 12px;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><i class="bi bi-wallet2" style="color: #0066cc;"></i> <strong>Dana</strong></h6>
                                        <small class="text-muted d-block">No. Tujuan: 0812-3456-7890</small>
                                    </div>
                                    <span class="badge bg-warning text-dark">E-Wallet</span>
                                </div>
                            </div>
                        </div>

                        <!-- OVO -->
                        <div class="col-12">
                            <div class="payment-method-info card border-light" style="padding: 12px;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><i class="bi bi-wallet2"></i> <strong>OVO</strong></h6>
                                        <small class="text-muted d-block">No. Tujuan: 0812-3456-7890</small>
                                    </div>
                                    <span class="badge bg-dark">E-Wallet</span>
                                </div>
                            </div>
                        </div>

                        <!-- GCash -->
                        <div class="col-12">
                            <div class="payment-method-info card border-light" style="padding: 12px;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><i class="bi bi-wallet2" style="color: #00a651;"></i> <strong>GCash</strong></h6>
                                        <small class="text-muted d-block">No. Tujuan: +63 912 345 6789</small>
                                    </div>
                                    <span class="badge bg-success">E-Wallet</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-2">

                        <!-- Cash -->
                        <div class="col-12">
                            <div class="payment-method-info card border-light" style="padding: 12px; background: #f0f9ff;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><i class="bi bi-cash-coin" style="color: #00cc66;"></i> <strong>Tunai</strong></h6>
                                        <small class="text-muted d-block">Bayar langsung saat technician datang untuk service</small>
                                    </div>
                                    <span class="badge bg-success">Offline</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info small mt-3 mb-0">
                        <i class="bi bi-info-circle"></i>
                        <strong>Catatan:</strong> Setelah melakukan pembayaran, upload bukti pembayaran untuk verifikasi admin. Pembayaran akan dikonfirmasi dalam 1x24 jam.
                    </div>

                    <?php if(auth()->user()->role === 'customer'): ?>
                    <a href="<?php echo e(route('customer.payment.form', $invoice)); ?>" class="btn btn-success w-100 mt-3">
                        <i class="bi bi-credit-card"></i> Bayar Sekarang
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Payment History Section -->
            <div class="card mt-3">
                <div class="card-header">
                    <i class="bi bi-clock-history"></i> Riwayat Pembayaran
                </div>
                <div class="card-body">
                    <?php if($invoice->payments()->count() === 0): ?>
                        <div class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada pembayaran untuk invoice ini.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Metode</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $invoice->payments()->orderBy('created_at', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <small><?php echo e($payment->created_at->format('d/m/Y H:i')); ?></small>
                                        </td>
                                        <td>
                                            <small><strong><?php echo e(ucfirst(str_replace('_', ' ', $payment->payment_method))); ?></strong></small>
                                        </td>
                                        <td>
                                            <small><strong>Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?></strong></small>
                                        </td>
                                        <td>
                                            <?php switch($payment->status):
                                                case ('pending_approval'): ?>
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                    <?php break; ?>
                                                <?php case ('approved'): ?>
                                                    <span class="badge bg-success">Approved</span>
                                                    <?php break; ?>
                                                <?php case ('rejected'): ?>
                                                    <span class="badge bg-danger">Rejected</span>
                                                    <?php break; ?>
                                                <?php default: ?>
                                                    <span class="badge bg-secondary"><?php echo e(ucfirst($payment->status)); ?></span>
                                            <?php endswitch; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\invoices\show.blade.php ENDPATH**/ ?>