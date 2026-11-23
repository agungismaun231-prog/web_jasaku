

<?php $__env->startSection('title', 'Manajemen Transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h3 mb-0">
                    <i class="fas fa-exchange-alt me-2"></i>Manajemen Transaksi
                </h1>
                <small class="text-muted">Kelola pesanan dan pembayaran pelanggan</small>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="bookings-tab" data-bs-toggle="tab" data-bs-target="#bookings" role="tab">
                <i class="fas fa-tasks me-2"></i>Pesanan (Bookings)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" role="tab">
                <i class="fas fa-credit-card me-2"></i>Pembayaran
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="invoices-tab" data-bs-toggle="tab" data-bs-target="#invoices" role="tab">
                <i class="fas fa-file-invoice me-2"></i>Invoice
            </button>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Bookings Tab -->
        <div class="tab-pane fade show active" id="bookings" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama atau ID pesanan..." value="<?php echo e(request('search')); ?>">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="confirmed" <?php echo e(request('status') === 'confirmed' ? 'selected' : ''); ?>>Terkonfirmasi</option>
                                <option value="in_progress" <?php echo e(request('status') === 'in_progress' ? 'selected' : ''); ?>>Sedang Dikerjakan</option>
                                <option value="completed" <?php echo e(request('status') === 'completed' ? 'selected' : ''); ?>>Selesai</option>
                                <option value="cancelled" <?php echo e(request('status') === 'cancelled' ? 'selected' : ''); ?>>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if($bookings && $bookings->count() > 0): ?>
                <div class="card shadow-sm border-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#ID</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Teknisi</th>
                                    <th>Jadwal</th>
                                    <th>Status</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>#<?php echo e(str_pad($booking->id, 5, '0', STR_PAD_LEFT)); ?></td>
                                        <td><?php echo e($booking->customer->user->name); ?></td>
                                        <td><?php echo e($booking->service->name); ?></td>
                                        <td>
                                            <?php if($booking->technician): ?>
                                                <span class="badge bg-info"><?php echo e($booking->technician->user->name); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Belum Ditugaskan</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($booking->scheduled_date->format('d M Y, H:i')); ?></td>
                                        <td>
                                            <?php switch($booking->status):
                                                case ('pending'): ?>
                                                    <span class="badge bg-warning">Pending</span>
                                                    <?php break; ?>
                                                <?php case ('confirmed'): ?>
                                                    <span class="badge bg-info">Terkonfirmasi</span>
                                                    <?php break; ?>
                                                <?php case ('in_progress'): ?>
                                                    <span class="badge bg-primary">Sedang Dikerjakan</span>
                                                    <?php break; ?>
                                                <?php case ('completed'): ?>
                                                    <span class="badge bg-success">Selesai</span>
                                                    <?php break; ?>
                                                <?php case ('cancelled'): ?>
                                                    <span class="badge bg-danger">Dibatalkan</span>
                                                    <?php break; ?>
                                            <?php endswitch; ?>
                                        </td>
                                        <td>Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('bookings.show', $booking)); ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo e(route('bookings.edit', $booking)); ?>" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($bookings->links()); ?>

                </div>
            <?php else: ?>
                <div class="card shadow-sm border-0 text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 48px; color: #ccc;"></i>
                    <h5 class="mt-3 text-muted">Tidak Ada Pesanan</h5>
                </div>
            <?php endif; ?>
        </div>

        <!-- Payments Tab -->
        <div class="tab-pane fade" id="payments" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari ID pembayaran..." value="<?php echo e(request('search')); ?>">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="approved" <?php echo e(request('status') === 'approved' ? 'selected' : ''); ?>>Disetujui</option>
                                <option value="confirmed" <?php echo e(request('status') === 'confirmed' ? 'selected' : ''); ?>>Dikonfirmasi</option>
                                <option value="rejected" <?php echo e(request('status') === 'rejected' ? 'selected' : ''); ?>>Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if($payments && $payments->count() > 0): ?>
                <div class="card shadow-sm border-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Pembayaran</th>
                                    <th>Pelanggan</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>#<?php echo e($payment->id); ?></td>
                                        <td><?php echo e($payment->invoice->booking->customer->user->name); ?></td>
                                        <td><strong>Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?></strong></td>
                                        <td>
                                            <span class="badge bg-light text-dark"><?php echo e($payment->payment_method ?? 'Bank Transfer'); ?></span>
                                        </td>
                                        <td>
                                            <?php if($payment->status === 'pending'): ?>
                                                <span class="badge bg-warning">Pending</span>
                                            <?php elseif($payment->status === 'approved'): ?>
                                                <span class="badge bg-info">Disetujui</span>
                                            <?php elseif($payment->status === 'confirmed'): ?>
                                                <span class="badge bg-success">Dikonfirmasi</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Ditolak</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($payment->created_at->format('d M Y H:i')); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('payments.show', $payment)); ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if($payment->status === 'pending'): ?>
                                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#approveModal<?php echo e($payment->id); ?>">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($payments->links()); ?>

                </div>
            <?php else: ?>
                <div class="card shadow-sm border-0 text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 48px; color: #ccc;"></i>
                    <h5 class="mt-3 text-muted">Tidak Ada Pembayaran</h5>
                </div>
            <?php endif; ?>
        </div>

        <!-- Invoices Tab -->
        <div class="tab-pane fade" id="invoices" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari nomor invoice..." value="<?php echo e(request('search')); ?>">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="unpaid" <?php echo e(request('status') === 'unpaid' ? 'selected' : ''); ?>>Belum Dibayar</option>
                                <option value="paid" <?php echo e(request('status') === 'paid' ? 'selected' : ''); ?>>Sudah Dibayar</option>
                                <option value="overdue" <?php echo e(request('status') === 'overdue' ? 'selected' : ''); ?>>Jatuh Tempo</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if($invoices && $invoices->count() > 0): ?>
                <div class="card shadow-sm border-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong>#<?php echo e($invoice->invoice_number); ?></strong></td>
                                        <td><?php echo e($invoice->booking->customer->user->name); ?></td>
                                        <td><?php echo e($invoice->booking->service->name); ?></td>
                                        <td>Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></td>
                                        <td>
                                            <?php if($invoice->status === 'paid'): ?>
                                                <span class="badge bg-success">Lunas</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Belum Dibayar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($invoice->due_date ? $invoice->due_date->format('d M Y') : '-'); ?>

                                            <?php if($invoice->status === 'unpaid' && $invoice->due_date && $invoice->due_date->isPast()): ?>
                                                <br><small class="text-danger">OVERDUE</small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('invoices.show', $invoice)); ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($invoices->links()); ?>

                </div>
            <?php else: ?>
                <div class="card shadow-sm border-0 text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 48px; color: #ccc;"></i>
                    <h5 class="mt-3 text-muted">Tidak Ada Invoice</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .page-header {
        padding: 20px 0;
        border-bottom: 1px solid #dee2e6;
    }
    
    table tr:hover {
        background-color: #f8f9fa;
    }
    
    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
    }
    
    .nav-tabs .nav-link.active {
        color: #0066cc;
        border-bottom: 3px solid #0066cc;
        background: none;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\admin\transactions\index.blade.php ENDPATH**/ ?>