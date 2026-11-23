

<?php $__env->startSection('title', 'Detail Pemesanan #' . $booking->id); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-calendar-check"></i>
        <h1>Detail Pemesanan #<?php echo e($booking->id); ?></h1>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Booking Information -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Pemesanan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">ID Pemesanan</label>
                                <p class="mb-0"><strong>#<?php echo e($booking->id); ?></strong></p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Layanan</label>
                                <p class="mb-0"><strong><?php echo e($booking->service->name); ?></strong></p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Harga</label>
                                <p class="mb-0"><strong>Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></strong></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Tanggal Jadwal</label>
                                <p class="mb-0"><strong><?php echo e($booking->scheduled_date->format('d/m/Y H:i')); ?></strong></p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Teknisi</label>
                                <p class="mb-0"><strong><?php echo e($booking->technician?->name ?? '(Belum ditugaskan)'); ?></strong></p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Status</label>
                                <p class="mb-0">
                                    <span class="badge <?php switch($booking->status):
                                        case ('pending'): ?> bg-warning text-dark <?php break; ?>
                                        <?php case ('confirmed'): ?> bg-info <?php break; ?>
                                        <?php case ('in_progress'): ?> bg-primary <?php break; ?>
                                        <?php case ('completed'): ?> bg-success <?php break; ?>
                                        <?php case ('cancelled'): ?> bg-danger <?php break; ?>
                                    <?php endswitch; ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?>

                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-tools"></i> Detail Layanan</h5>
                </div>
                <div class="card-body">
                    <p style="white-space: pre-wrap;"><?php echo e($booking->service->description); ?></p>
                </div>
            </div>

            <!-- Notes -->
            <?php if($booking->notes): ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-chat-left-text"></i> Catatan Anda</h5>
                    </div>
                    <div class="card-body">
                        <p style="white-space: pre-wrap;"><?php echo e($booking->notes); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Invoice -->
            <?php if($booking->invoice): ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-receipt"></i> Invoice</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Nomor Invoice:</strong><br>
                                    <?php echo e($booking->invoice->invoice_number); ?>

                                </p>
                                <p class="mb-2">
                                    <strong>Status Pembayaran:</strong><br>
                                    <span class="badge <?php if($booking->invoice->status === 'paid'): ?> bg-success <?php elseif($booking->invoice->status === 'overdue'): ?> bg-danger <?php else: ?> bg-warning <?php endif; ?>">
                                        <?php echo e(ucfirst($booking->invoice->status)); ?>

                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Total:</strong><br>
                                    Rp <?php echo e(number_format($booking->invoice->total, 0, ',', '.')); ?>

                                </p>
                                <p class="mb-0">
                                    <a href="<?php echo e(route('customer.invoice.show', $booking->invoice)); ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Lihat Invoice
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status Timeline -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-hourglass-split"></i> Status Pemesanan</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item <?php if(in_array($booking->status, ['pending', 'confirmed', 'in_progress', 'completed'])): ?> complete <?php endif; ?>">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <strong>Pending</strong><br>
                                <small class="text-muted">Menunggu konfirmasi</small>
                            </div>
                        </div>

                        <div class="timeline-item <?php if(in_array($booking->status, ['confirmed', 'in_progress', 'completed'])): ?> complete <?php endif; ?>">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <strong>Confirmed</strong><br>
                                <small class="text-muted">Sudah dikonfirmasi</small>
                            </div>
                        </div>

                        <div class="timeline-item <?php if(in_array($booking->status, ['in_progress', 'completed'])): ?> complete <?php endif; ?>">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <strong>In Progress</strong><br>
                                <small class="text-muted">Layanan sedang berlangsung</small>
                            </div>
                        </div>

                        <div class="timeline-item <?php if($booking->status === 'completed'): ?> complete <?php endif; ?>">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <strong>Completed</strong><br>
                                <small class="text-muted">Layanan selesai</small>
                            </div>
                        </div>
                    </div>

                    <style>
                        .timeline { position: relative; padding-left: 30px; }
                        .timeline::before { content: ''; position: absolute; left: 4px; top: 0; bottom: 0; width: 2px; background: var(--border); }
                        .timeline-item { margin-bottom: 20px; position: relative; }
                        .timeline-item.complete::before { background: var(--success); }
                        .timeline-marker { position: absolute; left: -32px; top: 2px; width: 12px; height: 12px; border-radius: 50%; background: var(--border); border: 2px solid var(--bg-card); }
                        .timeline-item.complete .timeline-marker { background: var(--success); border-color: var(--bg-card); }
                    </style>
                </div>
            </div>

            <!-- Actions -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-tools"></i> Aksi</h6>
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <?php if($booking->status === 'pending'): ?>
                        <a href="<?php echo e(route('customer.bookings.edit', $booking)); ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit Pemesanan
                        </a>
                    <?php endif; ?>

                    <?php if(in_array($booking->status, ['pending', 'confirmed', 'in_progress'])): ?>
                        <form action="<?php echo e(route('customer.bookings.cancel', $booking)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Batalkan pemesanan ini?')">
                                <i class="bi bi-x-circle"></i> Batalkan Pemesanan
                            </button>
                        </form>
                    <?php endif; ?>

                    <?php if($booking->invoice && $booking->invoice->status !== 'paid'): ?>
                        <a href="<?php echo e(route('customer.payment.form', $booking->invoice)); ?>" class="btn btn-success btn-sm">
                            <i class="bi bi-credit-card"></i> Bayar Invoice
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo e(route('customer.bookings.index')); ?>" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Info Card -->
            <div class="alert alert-info">
                <p class="small mb-0">
                    <strong>💡 Tip:</strong> Pantau email Anda untuk update status pemesanan dari admin.
                </p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\customer\bookings\show.blade.php ENDPATH**/ ?>