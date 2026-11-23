

<?php $__env->startSection('title', 'Dashboard Pelanggan'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <div class="page-title-icon"><i class="bi bi-speedometer2"></i></div>
        <div>
            <h1>Dashboard Pelanggan</h1>
            <p style="font-size:13px;color:var(--text-secondary);margin:0;">Selamat datang, <?php echo e($customer->name); ?>!</p>
        </div>
    </div>

    <!-- Alerts Overdue/Upcoming Invoices -->
    <?php if($overdueCount > 0): ?>
        <div class="alert alert-danger mb-4" style="border-left:4px solid var(--danger);">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-exclamation-circle-fill fs-4 mt-1"></i>
                <div style="flex:1;">
                    <h5 class="mb-2" style="font-weight:700;letter-spacing:-.3px;">Invoice Jatuh Tempo!</h5>
                    <p class="mb-3">Anda memiliki <strong><?php echo e($overdueCount); ?> invoice</strong> yang <strong>JATUH TEMPO</strong> dan harus dibayar segera:</p>
                    <?php $__currentLoopData = $overdueInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div style="background:var(--bg-elevated);border-radius:var(--radius-sm);padding:12px;margin-bottom:8px;display:flex;align-items:center;justify-content:space-between;">
                            <div>
                                <strong style="color:var(--text-primary);"><?php echo e($invoice->invoice_number); ?></strong><br>
                                <small style="color:var(--text-secondary);"><?php echo e($invoice->booking->service->name); ?></small><br>
                                <small style="color:var(--danger);"><i class="bi bi-calendar-x"></i> Jatuh tempo: <?php echo e($invoice->due_date->format('d/m/Y')); ?></small>
                            </div>
                            <div class="text-end">
                                <div style="color:var(--danger);font-weight:700;margin-bottom:8px;">Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></div>
                                <a href="<?php echo e(route('customer.invoice.show', $invoice)); ?>" class="btn btn-sm btn-danger">Bayar</a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($upcomingCount > 0): ?>
        <div class="alert alert-warning mb-4" style="border-left:4px solid var(--warning);">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-clock-history fs-4 mt-1"></i>
                <div style="flex:1;">
                    <h5 class="mb-2" style="font-weight:700;letter-spacing:-.3px;">Invoice Akan Jatuh Tempo</h5>
                    <p class="mb-3">Anda memiliki <strong><?php echo e($upcomingCount); ?> invoice</strong> yang akan jatuh tempo dalam 3 hari ke depan:</p>
                    <?php $__currentLoopData = $upcomingDueInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div style="background:var(--bg-elevated);border-radius:var(--radius-sm);padding:12px;margin-bottom:8px;display:flex;align-items:center;justify-content:space-between;">
                            <div>
                                <strong style="color:var(--text-primary);"><?php echo e($invoice->invoice_number); ?></strong><br>
                                <small style="color:var(--text-secondary);"><?php echo e($invoice->booking->service->name); ?></small><br>
                                <small style="color:var(--warning);"><i class="bi bi-calendar"></i> Jatuh tempo: <?php echo e($invoice->due_date->format('d/m/Y')); ?></small>
                            </div>
                            <div class="text-end">
                                <div style="color:var(--warning);font-weight:700;margin-bottom:8px;">Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></div>
                                <a href="<?php echo e(route('customer.invoice.show', $invoice)); ?>" class="btn btn-sm" style="background:var(--warning);color:white;border:none;">Bayar</a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div>
                        <div class="stats-label" style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--text-muted);margin-bottom:10px;">Total Pemesanan</div>
                        <div class="number"><?php echo e($totalBookings); ?></div>
                    </div>
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,.15);display:flex;align-items:center;justify-content:center;color:var(--blue-400);font-size:18px;flex-shrink:0;">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div>
                        <div class="stats-label" style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--text-muted);margin-bottom:10px;">Selesai</div>
                        <div class="number" style="color:var(--success);"><?php echo e($completedBookings); ?></div>
                    </div>
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(16,185,129,.15);display:flex;align-items:center;justify-content:center;color:var(--success);font-size:18px;flex-shrink:0;">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div>
                        <div class="stats-label" style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--text-muted);margin-bottom:10px;">Menunggu</div>
                        <div class="number" style="color:var(--warning);"><?php echo e($pendingBookings); ?></div>
                    </div>
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(245,158,11,.15);display:flex;align-items:center;justify-content:center;color:var(--warning);font-size:18px;flex-shrink:0;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div>
                        <div class="stats-label" style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--text-muted);margin-bottom:10px;">Pengeluaran</div>
                        <div class="number" style="font-size:18px;color:var(--text-primary);">Rp <?php echo e(number_format($totalExpense, 0, ',', '.')); ?></div>
                    </div>
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(6,182,212,.15);display:flex;align-items:center;justify-content:center;color:var(--info);font-size:18px;flex-shrink:0;">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Auto Slider Services -->
    <div class="slider-container mb-4">
        <div id="serviceCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <?php $services = \App\Models\Service::all(); ?>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="carousel-item <?php if($index === 0): ?> active <?php endif; ?>">
                        <div class="slider-wrapper">
                            <!-- Background fallback -->
                            <div style="width:100%;height:320px;background:linear-gradient(135deg,var(--blue-700),var(--blue-500));"></div>
                            <div class="slider-content" style="padding:40px;display:flex;align-items:center;justify-content:space-between;inset:0;">
                                <div style="flex:1;max-width:500px;">
                                    <h2 class="slider-title" style="font-size:32px;"><?php echo e($service->name); ?></h2>
                                    <p class="slider-desc"><?php echo e(Str::limit($service->description, 100)); ?></p>
                                    <div style="display:flex;gap:30px;margin-bottom:24px;">
                                        <div>
                                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,.7);">Harga</div>
                                            <div style="font-size:18px;font-weight:700;">Rp <?php echo e(number_format($service->price, 0, ',', '.')); ?></div>
                                        </div>
                                        <div style="width:1px;background:rgba(255,255,255,.2);"></div>
                                        <div>
                                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,.7);">Durasi</div>
                                            <div style="font-size:18px;font-weight:700;"><?php echo e($service->duration_minutes); ?> mnt</div>
                                        </div>
                                    </div>
                                    <button class="btn" style="background:white;color:var(--blue-600);font-weight:700;padding:10px 24px;" data-bs-toggle="modal" data-bs-target="#createBookingModal">
                                        <i class="bi bi-calendar-plus"></i> Pesan Sekarang
                                    </button>
                                </div>
                                <div style="flex-shrink:0;font-size:120px;opacity:.1;margin-right:40px;"><i class="bi bi-snow"></i></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
            <div class="carousel-indicators">
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="<?php echo e($index); ?>" <?php if($index === 0): ?> class="active" <?php endif; ?>></button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <style>
        .slider-container{border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);}
        .slider-wrapper{position:relative;width:100%;height:320px;overflow:hidden;}
        .slider-content{position:absolute;color:white;}
        .slider-title{font-weight:800;letter-spacing:-1px;margin-bottom:12px;}
        .slider-desc{font-size:15px;margin-bottom:20px;opacity:.9;line-height:1.6;}
        .carousel-control-prev,.carousel-control-next{width:44px;height:44px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.2);border-radius:50%;opacity:.8;transition:var(--tr);}
        .carousel-control-prev:hover,.carousel-control-next:hover{opacity:1;background:rgba(0,0,0,0.4);}
        .carousel-indicators{bottom:16px;gap:6px;}
        .carousel-indicators button{width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.4);border:none;}
        .carousel-indicators button.active{background:white;width:24px;border-radius:4px;}
        @media(max-width:768px){.slider-wrapper{height:360px;}.slider-content{padding:24px !important;flex-direction:column;align-items:flex-start!important;justify-content:center!important;}.slider-content > div:last-child{display:none;}}
    </style>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-clock-history"></i> Pemesanan Terakhir
                </div>
                <div class="card-body p-0">
                    <?php if($recentBookings->isEmpty()): ?>
                        <div style="padding:40px 20px;text-align:center;">
                            <div style="width:64px;height:64px;background:var(--bg-elevated);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:24px;color:var(--text-muted);margin:0 auto 16px;"><i class="bi bi-inbox"></i></div>
                            <p style="color:var(--text-secondary);margin-bottom:16px;">Anda belum membuat pemesanan.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBookingModal">Buat Pemesanan</button>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Layanan</th>
                                        <th>Jadwal</th>
                                        <th>Teknisi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="font-weight:500;color:var(--text-primary);"><?php echo e($booking->service->name); ?></td>
                                            <td><?php echo e($booking->scheduled_date->format('d/m/Y H:i')); ?></td>
                                            <td><?php echo e($booking->technician?->name ?? '-'); ?></td>
                                            <td>
                                                <span class="badge <?php echo e($booking->status); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?></span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('customer.bookings.show', $booking)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
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
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header"><i class="bi bi-receipt"></i> Tagihan Belum Lunas</div>
                <div class="card-body p-0">
                    <?php if($unpaidInvoices->isEmpty()): ?>
                        <div style="padding:20px;text-align:center;">
                            <div style="width:48px;height:48px;background:rgba(16,185,129,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;color:var(--success);margin:0 auto 12px;"><i class="bi bi-check-lg"></i></div>
                            <p style="color:var(--text-secondary);margin:0;font-size:13px;">Semua tagihan lunas.</p>
                        </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $unpaidInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="padding:16px;border-bottom:1px solid var(--border);">
                                <div style="display:flex;justify-content:space-between;margin-bottom:4px;">
                                    <strong style="color:var(--text-primary);"><?php echo e($invoice->invoice_number); ?></strong>
                                    <span class="badge <?php echo e($invoice->status === 'overdue' ? 'cancelled' : 'pending'); ?>"><?php echo e(ucfirst($invoice->status)); ?></span>
                                </div>
                                <div style="font-size:12px;color:var(--text-secondary);margin-bottom:12px;"><i class="bi bi-wrench"></i> <?php echo e($invoice->booking->service->name); ?></div>
                                <div style="display:flex;justify-content:space-between;align-items:center;">
                                    <strong style="color:var(--danger);font-size:15px;">Rp <?php echo e(number_format($invoice->total,0,',','.')); ?></strong>
                                    <a href="<?php echo e(route('customer.invoice.show', $invoice)); ?>" class="btn btn-sm btn-outline-primary">Lihat</a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header"><i class="bi bi-person"></i> Profil Anda</div>
                <div class="card-body">
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                        <div style="width:56px;height:56px;background:linear-gradient(135deg,var(--blue-600),var(--blue-400));border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:24px;color:white;font-weight:700;">
                            <?php echo e(strtoupper(substr($customer->name, 0, 1))); ?>

                        </div>
                        <div>
                            <div style="font-weight:700;font-size:16px;color:var(--text-primary);"><?php echo e($customer->name); ?></div>
                            <div style="font-size:13px;color:var(--text-secondary);"><?php echo e($customer->email); ?></div>
                        </div>
                    </div>
                    <div style="font-size:13px;color:var(--text-secondary);margin-bottom:8px;"><i class="bi bi-telephone text-muted w-20px"></i> <?php echo e($customer->phone ?? 'Belum ada no. telepon'); ?></div>
                    <div style="font-size:13px;color:var(--text-secondary);margin-bottom:20px;line-height:1.5;"><i class="bi bi-geo-alt text-muted w-20px"></i> <?php echo e($customer->address ?? 'Belum ada alamat'); ?></div>
                    <a href="<?php echo e(route('profile.editProfile')); ?>" class="btn btn-sm btn-outline-primary w-100"><i class="bi bi-pencil"></i> Edit Profil</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Services Grid -->
    <h5 style="margin:32px 0 20px;font-weight:700;letter-spacing:-.5px;">Layanan Lainnya</h5>
    <div class="row g-3">
        <?php $__currentLoopData = \App\Models\Service::limit(6)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100" style="padding:0;margin:0;">
                    <div class="card-body" style="display:flex;flex-direction:column;">
                        <div style="width:48px;height:48px;background:var(--bg-elevated);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--blue-400);font-size:20px;margin-bottom:16px;"><i class="bi bi-wrench-adjustable"></i></div>
                        <h6 style="font-weight:700;margin-bottom:8px;"><?php echo e($s->name); ?></h6>
                        <p style="font-size:13px;color:var(--text-secondary);line-height:1.6;margin-bottom:20px;flex:1;"><?php echo e(Str::limit($s->description, 70)); ?></p>
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-top:16px;border-top:1px solid var(--border);">
                            <div style="color:var(--success);font-weight:700;font-size:15px;">Rp <?php echo e(number_format($s->price,0,',','.')); ?></div>
                            <div style="font-size:12px;color:var(--text-muted);"><i class="bi bi-clock"></i> <?php echo e($s->duration_minutes); ?> min</div>
                        </div>
                        <button class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#createBookingModal" onclick="document.getElementById('modal_service_id').value='<?php echo e($s->id); ?>'">Pesan</button>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Booking Modal -->
    <?php
        $modalServices = \App\Models\Service::all();
        $modalTechnicians = \App\Models\Technician::where('status', '!=', 'inactive')->get();
    ?>
    <div class="modal fade" id="createBookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background:var(--bg-panel);border:1px solid var(--border);border-radius:var(--radius-lg);">
                <div class="modal-header" style="border-bottom:1px solid var(--border);">
                    <h5 class="modal-title" style="font-weight:700;"><i class="bi bi-calendar-plus"></i> Buat Pemesanan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('customer.bookings.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="modal_service_id" class="form-label">Pilih Layanan *</label>
                            <select class="form-select" id="modal_service_id" name="service_id" required>
                                <option value="">-- Pilih Layanan --</option>
                                <?php $__currentLoopData = $modalServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s->id); ?>"><?php echo e($s->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="modal_technician_id" class="form-label">Pilih Teknisi (Opsional)</label>
                            <select class="form-select" id="modal_technician_id" name="technician_id">
                                <option value="">-- Biarkan Admin Menugaskan --</option>
                                <?php $__currentLoopData = $modalTechnicians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($t->id); ?>"><?php echo e($t->name); ?> (<?php echo e(Str::limit($t->specialization, 20)); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="modal_scheduled_date" class="form-label">Tanggal & Waktu *</label>
                            <input type="datetime-local" class="form-control" id="modal_scheduled_date" name="scheduled_date" required>
                        </div>
                        <div class="mb-4">
                            <label for="modal_notes" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="modal_notes" name="notes" rows="3" placeholder="Contoh: AC bocor netes air di ruang tamu"></textarea>
                        </div>
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Buat Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            const min = now.toISOString().slice(0,16);
            const el = document.getElementById('modal_scheduled_date');
            if(el) el.min = min;
        });
    </script>

    <!-- Modal Invoices and Layanan that were unused and duplicative are removed to keep UI clean, 
         using the cards directly instead -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\customer\dashboard.blade.php ENDPATH**/ ?>