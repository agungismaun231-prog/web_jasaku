

<?php $__env->startSection('title', 'Detail Pemesanan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-calendar-check"></i>
        <h1>Detail Pemesanan #<?php echo e($booking->id); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="bi bi-info-circle"></i> Informasi Pemesanan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th>Pelanggan:</th>
                                    <td><a href="<?php echo e(route('customers.show', $booking->customer)); ?>"><?php echo e($booking->customer->name); ?></a></td>
                                </tr>
                                <tr>
                                    <th>Telepon:</th>
                                    <td><?php echo e($booking->customer->phone); ?></td>
                                </tr>
                                <tr>
                                    <th>Layanan:</th>
                                    <td><a href="<?php echo e(route('services.show', $booking->service)); ?>"><?php echo e($booking->service->name); ?></a></td>
                                </tr>
                                <tr>
                                    <th>Harga:</th>
                                    <td>Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th>Teknisi:</th>
                                    <td><?php echo e($booking->technician ? $booking->technician->name : '-'); ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Jadwal:</th>
                                    <td><?php echo e($booking->scheduled_date->format('d/m/Y H:i')); ?></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge <?php switch($booking->status):
                                            case ('pending'): ?> pending <?php break; ?>
                                            <?php case ('confirmed'): ?> confirmed <?php break; ?>
                                            <?php case ('in_progress'): ?> in_progress <?php break; ?>
                                            <?php case ('completed'): ?> completed <?php break; ?>
                                            <?php case ('cancelled'): ?> cancelled <?php break; ?>
                                        <?php endswitch; ?>">
                                            <?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?>

                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <?php if($booking->notes): ?>
                    <div class="mt-3">
                        <strong>Catatan:</strong>
                        <p class="text-muted"><?php echo e($booking->notes); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if($booking->completion_notes): ?>
                    <div class="mt-3">
                        <strong>Catatan Penyelesaian:</strong>
                        <p class="text-muted"><?php echo e($booking->completion_notes); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($booking->invoice): ?>
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-receipt"></i> Invoice
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Nomor Invoice:</th>
                            <td><a href="<?php echo e(route('invoices.show', $booking->invoice)); ?>"><?php echo e($booking->invoice->invoice_number); ?></a></td>
                        </tr>
                        <tr>
                            <th>Subtotal:</th>
                            <td>Rp <?php echo e(number_format($booking->invoice->subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <tr>
                            <th>Pajak:</th>
                            <td>Rp <?php echo e(number_format($booking->invoice->tax, 0, ',', '.')); ?></td>
                        </tr>
                        <tr>
                            <th><strong>Total:</strong></th>
                            <td><strong>Rp <?php echo e(number_format($booking->invoice->total, 0, ',', '.')); ?></strong></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge <?php if($booking->invoice->status === 'paid'): ?> bg-success <?php elseif($booking->invoice->status === 'overdue'): ?> bg-danger <?php else: ?> bg-warning <?php endif; ?>">
                                    <?php echo e(ucfirst($booking->invoice->status)); ?>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <?php if(auth()->user()->role === 'admin'): ?>
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-tools"></i> Aksi
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <a href="<?php echo e(route('bookings.edit', $booking)); ?>" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    
                    <?php if($booking->status !== 'completed' && $booking->status !== 'cancelled'): ?>
                    <form action="<?php echo e(route('bookings.markAsCompleted', $booking)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success w-100" onclick="return confirm('Tandai pemesanan sebagai selesai?')">
                            <i class="bi bi-check-circle"></i> Tandai Selesai
                        </button>
                    </form>
                    <?php endif; ?>

                    <?php if($booking->status !== 'cancelled'): ?>
                    <form action="<?php echo e(route('bookings.cancel', $booking)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Batalkan pemesanan ini?')">
                            <i class="bi bi-x-circle"></i> Batalkan
                        </button>
                    </form>
                    <?php endif; ?>

                    <?php if($booking->invoice): ?>
                    <a href="<?php echo e(route('invoices.show', $booking->invoice)); ?>" class="btn btn-info">
                        <i class="bi bi-receipt"></i> Lihat Invoice
                    </a>
                    <?php endif; ?>

                    <a href="<?php echo e(route('bookings.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <?php else: ?>
            <div class="card">
                <div class="card-body text-center py-5">
                    <p class="text-muted mb-3"><strong>Anda dapat melihat detail pemesanan Anda</strong></p>
                    <a href="<?php echo e(route('customer.dashboard')); ?>" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\bookings\show.blade.php ENDPATH**/ ?>