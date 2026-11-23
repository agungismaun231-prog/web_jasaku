

<?php $__env->startSection('title', 'Monitoring Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-credit-card"></i>
        <h1>Monitoring Pembayaran</h1>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <h5>Menunggu Verifikasi</h5>
                <div class="number"><?php echo e($payments->total()); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card success">
                <h5>Total Nilai Pending</h5>
                <div class="number" style="font-size: 1.5rem;">Rp <?php echo e(number_format($payments->sum('amount'), 0, ',', '.')); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <h5>Halaman</h5>
                <div class="number"><?php echo e($payments->currentPage()); ?> / <?php echo e($payments->lastPage()); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card success">
                <h5>Per Halaman</h5>
                <div class="number"><?php echo e(count($payments)); ?></div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-hourglass-split"></i> Daftar Pembayaran Menunggu Verifikasi</h5>
        </div>
        <div class="table-responsive">
            <?php if($payments->count() > 0): ?>
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 10%;">No Pembayaran</th>
                            <th style="width: 15%;">Invoice</th>
                            <th style="width: 15%;">Pelanggan</th>
                            <th style="width: 12%;">Metode</th>
                            <th style="width: 12%;">Jumlah</th>
                            <th style="width: 15%;">Tanggal Submit</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <strong>#PM<?php echo e($payment->id); ?></strong>
                                </td>
                                <td>
                                    <strong><?php echo e($payment->invoice->invoice_number); ?></strong><br>
                                    <small class="text-muted"><?php echo e($payment->invoice->booking->service->name); ?></small>
                                </td>
                                <td>
                                    <strong><?php echo e($payment->invoice->booking->customer->name); ?></strong><br>
                                    <small class="text-muted"><?php echo e($payment->invoice->booking->customer->email); ?></small>
                                </td>
                                <td>
                                    <?php
                                        $methodLabel = [
                                            'cash' => 'Tunai',
                                            'bank_transfer' => 'Transfer Bank',
                                            'e_wallet' => 'E-Wallet',
                                            'credit_card' => 'Kartu Kredit',
                                            'qris' => 'QRIS'
                                        ];
                                        $methodColor = [
                                            'cash' => 'success',
                                            'bank_transfer' => 'info',
                                            'e_wallet' => 'warning',
                                            'credit_card' => 'primary',
                                            'qris' => 'dark'
                                        ];
                                    ?>
                                    <span class="badge bg-<?php echo e($methodColor[$payment->payment_method] ?? 'secondary'); ?>">
                                        <?php echo e($methodLabel[$payment->payment_method] ?? $payment->payment_method); ?>

                                    </span>
                                </td>
                                <td>
                                    <strong>Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?></strong>
                                </td>
                                <td>
                                    <?php echo e($payment->submitted_date->format('d/m/Y H:i')); ?><br>
                                    <small class="text-muted"><?php echo e($payment->submitted_date->diffForHumans()); ?></small>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('payments.show', $payment)); ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div style="padding: 40px; text-align: center; background: #f8f9fa;">
                    <i class="bi bi-check-circle" style="font-size: 3rem; color: #28a745; margin-bottom: 10px;"></i>
                    <p style="font-size: 1.1rem; color: #666; margin-top: 10px;">
                        <strong>Tidak ada pembayaran yang menunggu verifikasi</strong>
                    </p>
                    <p class="text-muted">Semua pembayaran sudah diverifikasi atau disetujui</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pagination -->
    <?php if($payments->hasPages()): ?>
        <div class="mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    
                    <?php if($payments->onFirstPage()): ?>
                        <li class="page-item disabled">
                            <span class="page-link">← Sebelumnya</span>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo e($payments->previousPageUrl()); ?>">← Sebelumnya</a>
                        </li>
                    <?php endif; ?>

                    
                    <?php $__currentLoopData = $payments->getUrlRange(1, $payments->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $payments->currentPage()): ?>
                            <li class="page-item active">
                                <span class="page-link"><?php echo e($page); ?></span>
                            </li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if($payments->hasMorePages()): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo e($payments->nextPageUrl()); ?>">Selanjutnya →</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <span class="page-link">Selanjutnya →</span>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    <?php endif; ?>

    <!-- Info Section -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h6 class="card-title"><i class="bi bi-exclamation-circle"></i> Instruksi Verifikasi</h6>
                    <ul class="small mb-0">
                        <li>Klik tombol <strong>"Lihat Detail"</strong> untuk melihat bukti pembayaran</li>
                        <li>Verifikasi bukti dengan nomor referensi yang diberikan customer</li>
                        <li>Periksa apakah amount yang ditransfer sesuai dengan invoice</li>
                        <li>Klik <strong>"Setujui"</strong> jika pembayaran valid</li>
                        <li>Klik <strong>"Tolak"</strong> jika ada masalah (akan memberi notif ke customer)</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6 class="card-title"><i class="bi bi-check-circle"></i> Metode Pembayaran</h6>
                    <ul class="small mb-0">
                        <li><strong>Tunai:</strong> Pembayaran saat service, cek foto uang/struk</li>
                        <li><strong>Transfer Bank:</strong> Verifikasi nomor referensi dari bank</li>
                        <li><strong>E-Wallet:</strong> Verifikasi nomor referensi dari e-wallet</li>
                        <li><strong>Kartu Kredit:</strong> Verifikasi screenshot transaksi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\payments\admin-pending-list.blade.php ENDPATH**/ ?>