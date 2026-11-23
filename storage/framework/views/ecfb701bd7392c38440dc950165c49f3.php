

<?php $__env->startSection('title', 'Daftar Pemesanan Saya'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-calendar-check"></i>
        <h1>Pemesanan Saya</h1>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <h5>Total Pemesanan</h5>
                <div class="number"><?php echo e($bookings->total()); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card success">
                <h5>Menunggu</h5>
                <div class="number"><?php echo e($bookings->where('status', 'pending')->count()); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <h5>Terkonfirmasi</h5>
                <div class="number"><?php echo e($bookings->where('status', 'confirmed')->count()); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card success">
                <h5>Selesai</h5>
                <div class="number"><?php echo e($bookings->where('status', 'completed')->count()); ?></div>
            </div>
        </div>
    </div>

    <!-- Bookings List -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-list-check"></i> Daftar Pemesanan</h5>
            <a href="<?php echo e(route('customer.bookings.create')); ?>" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Buat Pemesanan Baru
            </a>
        </div>

        <?php if($bookings->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Layanan</th>
                            <th style="width: 18%;">Tanggal Jadwal</th>
                            <th style="width: 15%;">Teknisi</th>
                            <th style="width: 12%;">Harga</th>
                            <th style="width: 12%;">Status</th>
                            <th style="width: 23%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($booking->service->name); ?></strong>
                                </td>
                                <td>
                                    <?php echo e($booking->scheduled_date->format('d/m/Y H:i')); ?><br>
                                    <small class="text-muted"><?php echo e($booking->scheduled_date->diffForHumans()); ?></small>
                                </td>
                                <td>
                                    <?php echo e($booking->technician?->name ?? '(Belum ditugaskan)'); ?>

                                </td>
                                <td>
                                    <strong>Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></strong>
                                </td>
                                <td>
                                    <span class="badge <?php switch($booking->status):
                                        case ('pending'): ?> bg-warning text-dark <?php break; ?>
                                        <?php case ('confirmed'): ?> bg-info <?php break; ?>
                                        <?php case ('in_progress'): ?> bg-primary <?php break; ?>
                                        <?php case ('completed'): ?> bg-success <?php break; ?>
                                        <?php case ('cancelled'): ?> bg-danger <?php break; ?>
                                    <?php endswitch; ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?php echo e(route('customer.bookings.show', $booking)); ?>" class="btn btn-outline-primary" title="Lihat Detail">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                        
                                        <?php if($booking->status === 'pending'): ?>
                                            <a href="<?php echo e(route('customer.bookings.edit', $booking)); ?>" class="btn btn-outline-warning" title="Edit Pemesanan">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        <?php endif; ?>

                                        <?php if(in_array($booking->status, ['pending', 'confirmed', 'in_progress'])): ?>
                                            <form action="<?php echo e(route('customer.bookings.cancel', $booking)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Batalkan pemesanan ini?')" title="Batalkan Pemesanan">
                                                    <i class="bi bi-x-circle"></i> Batalkan
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($bookings->hasPages()): ?>
                <div class="card-footer">
                    <?php echo e($bookings->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <div style="padding: 60px 20px; text-align: center;">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 20px; display: inline-block;"></i>
                <p style="font-size: 1.2rem; color: var(--text-primary); margin-top: 20px;">
                    <strong>Anda belum membuat pemesanan.</strong>
                </p>
                <p class="text-muted mb-3">Buat pemesanan baru untuk mulai menggunakan layanan kami</p>
                <a href="<?php echo e(route('customer.bookings.create')); ?>" class="btn btn-primary btn-lg">
                    <i class="bi bi-plus-circle"></i> Buat Pemesanan Baru
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Info Card -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h6 class="card-title"><i class="bi bi-info-circle"></i> Status Pemesanan</h6>
                    <ul class="small mb-0">
                        <li><strong>Pending:</strong> Menunggu konfirmasi dari admin</li>
                        <li><strong>Confirmed:</strong> Sudah dikonfirmasi, menunggu jadwal</li>
                        <li><strong>In Progress:</strong> Teknisi sedang melayani</li>
                        <li><strong>Completed:</strong> Layanan selesai</li>
                        <li><strong>Cancelled:</strong> Pemesanan dibatalkan</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6 class="card-title"><i class="bi bi-check-circle"></i> Panduan</h6>
                    <ul class="small mb-0">
                        <li>Klik <strong>"Buat Pemesanan"</strong> untuk membuat layanan baru</li>
                        <li>Hanya bisa edit pemesanan dengan status <strong>Pending</strong></li>
                        <li>Setelah admin konfirmasi, Anda akan dapat invoice untuk pembayaran</li>
                        <li>Pantau status pemesanan Anda di halaman ini</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views/customer/bookings/index.blade.php ENDPATH**/ ?>