<?php $__env->startSection('title', 'Dashboard Admin'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* ── Dashboard Animations ──────────────────────── */
    @keyframes dash-fadeInUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .dash-animate {
        opacity: 0;
        animation: dash-fadeInUp .5s cubic-bezier(.22,.61,.36,1) forwards;
    }
    .dash-delay-1 { animation-delay: .05s; }
    .dash-delay-2 { animation-delay: .1s; }
    .dash-delay-3 { animation-delay: .15s; }
    .dash-delay-4 { animation-delay: .2s; }
    .dash-delay-5 { animation-delay: .25s; }
    .dash-delay-6 { animation-delay: .3s; }
    .dash-delay-7 { animation-delay: .35s; }
    .dash-delay-8 { animation-delay: .4s; }

    /* ── Welcome Header ────────────────────────────── */
    .dash-welcome {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 28px;
    }
    .dash-welcome h1 {
        font-size: 24px;
        font-weight: 800;
        letter-spacing: -.5px;
        color: var(--text-primary);
        margin: 0;
    }
    .dash-welcome h1 span {
        color: var(--blue-400);
    }
    .dash-welcome-sub {
        font-size: 13px;
        color: var(--text-muted);
        margin: 2px 0 0;
    }
    .dash-date {
        font-size: 13px;
        color: var(--text-secondary);
        background: var(--bg-elevated);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 8px 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dash-date i { color: var(--blue-400); font-size: 15px; }

    /* ── KPI Stat Cards ────────────────────────────── */
    .dash-kpi {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 22px 20px 18px;
        position: relative;
        overflow: hidden;
        transition: transform .25s cubic-bezier(.22,.61,.36,1), box-shadow .25s ease;
        box-shadow: var(--shadow-sm);
    }
    .dash-kpi:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }
    .dash-kpi::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        border-radius: 0 0 var(--radius-lg) var(--radius-lg);
        opacity: .8;
        transition: opacity .2s;
    }
    .dash-kpi:hover::after { opacity: 1; }
    .dash-kpi.dash-kpi-blue::after    { background: linear-gradient(90deg, var(--blue-500), var(--blue-300)); }
    .dash-kpi.dash-kpi-cyan::after    { background: linear-gradient(90deg, var(--info), #67e8f9); }
    .dash-kpi.dash-kpi-green::after   { background: linear-gradient(90deg, var(--success), #6ee7b7); }
    .dash-kpi.dash-kpi-indigo::after  { background: linear-gradient(90deg, #6366f1, #a5b4fc); }
    .dash-kpi.dash-kpi-amber::after   { background: linear-gradient(90deg, var(--warning), #fcd34d); }
    .dash-kpi.dash-kpi-red::after     { background: linear-gradient(90deg, var(--danger), #fca5a5); }

    .dash-kpi-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }
    .dash-kpi-icon {
        width: 42px;
        height: 42px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }
    .dash-kpi-icon.blue    { background: rgba(59,130,246,.12); color: var(--blue-400); }
    .dash-kpi-icon.cyan    { background: rgba(6,182,212,.12);  color: var(--info); }
    .dash-kpi-icon.green   { background: rgba(16,185,129,.12); color: var(--success); }
    .dash-kpi-icon.indigo  { background: rgba(99,102,241,.12); color: #818cf8; }
    .dash-kpi-icon.amber   { background: rgba(245,158,11,.12); color: var(--warning); }
    .dash-kpi-icon.red     { background: rgba(239,68,68,.12);  color: var(--danger); }

    .dash-kpi-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--text-muted);
        margin-bottom: 6px;
    }
    .dash-kpi-value {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -1px;
        color: var(--text-primary);
        line-height: 1.1;
    }

    /* ── Revenue Card ──────────────────────────────── */
    .dash-revenue {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: box-shadow .25s ease;
    }
    .dash-revenue:hover { box-shadow: var(--shadow-md); }
    .dash-revenue::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(16,185,129,.08) 0%, transparent 70%);
        pointer-events: none;
    }
    .dash-revenue-icon {
        width: 52px;
        height: 52px;
        border-radius: var(--radius-lg);
        background: rgba(16,185,129,.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--success);
        margin-bottom: 18px;
    }
    .dash-revenue-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--text-muted);
        margin-bottom: 6px;
    }
    .dash-revenue-value {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -1px;
        color: var(--success);
        line-height: 1.1;
        margin-bottom: 16px;
    }
    .dash-revenue-sub {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--text-secondary);
        padding-top: 16px;
        border-top: 1px solid var(--border);
    }
    .dash-revenue-sub i { color: var(--success); }
    .dash-revenue-sub strong { color: var(--text-primary); }

    /* ── Quick Stats Card ──────────────────────────── */
    .dash-quick {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 24px;
        box-shadow: var(--shadow-sm);
        height: 100%;
        transition: box-shadow .25s ease;
    }
    .dash-quick:hover { box-shadow: var(--shadow-md); }
    .dash-quick-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dash-quick-title i { color: var(--blue-400); }
    .dash-quick-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
    }
    .dash-quick-item:last-child { border-bottom: none; }
    .dash-quick-item-left {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: var(--text-secondary);
    }
    .dash-quick-item-left i {
        font-size: 16px;
        width: 18px;
        text-align: center;
    }
    .dash-quick-item-value {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* ── Section Header ────────────────────────────── */
    .dash-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--border);
    }
    .dash-section-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }
    .dash-section-title i { color: var(--blue-400); }

    /* ── Slider (enhanced) ─────────────────────────── */
    .dash-slider { border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-md); }
    .dash-slider .carousel-inner { border-radius: var(--radius-lg); }
    .dash-slider-img { width: 100%; height: 360px; object-fit: cover; display: block; }
    .dash-slider-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,.6) 0%, transparent 55%); }
    .dash-slider-content { position: absolute; bottom: 0; left: 0; right: 0; padding: 28px 36px; color: white; }
    .dash-slider-content h2 { font-size: 1.75rem; font-weight: 800; letter-spacing: -.5px; margin-bottom: 6px; text-shadow: 0 2px 8px rgba(0,0,0,.4); }
    .dash-slider-content p { font-size: .95rem; opacity: .9; margin-bottom: 16px; max-width: 480px; }
    .dash-slider .carousel-control-prev,
    .dash-slider .carousel-control-next {
        width: 40px; height: 40px; top: 50%; transform: translateY(-50%);
        background: rgba(0,0,0,.35); border-radius: 50%; opacity: .7; transition: opacity .2s;
    }
    .dash-slider .carousel-control-prev:hover,
    .dash-slider .carousel-control-next:hover { opacity: 1; }
    .dash-slider .carousel-indicators { bottom: 14px; gap: 5px; }
    .dash-slider .carousel-indicators button {
        width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,.45); border: none;
    }
    .dash-slider .carousel-indicators button.active { background: white; width: 22px; border-radius: 4px; }

    /* ── Empty State ────────────────────────────────── */
    .dash-empty {
        padding: 40px 24px;
        text-align: center;
        color: var(--text-muted);
    }
    .dash-empty i { font-size: 36px; display: block; margin-bottom: 10px; opacity: .5; }

    /* ── Responsive ─────────────────────────────────── */
    @media (max-width: 767px) {
        .dash-welcome h1 { font-size: 20px; }
        .dash-date { display: none; }
        .dash-kpi-value { font-size: 22px; }
        .dash-revenue-value { font-size: 24px; }
        .dash-slider-img { height: 240px; }
        .dash-slider-content { padding: 20px 24px; }
        .dash-slider-content h2 { font-size: 1.3rem; }
    }
</style>

<!-- ── Welcome Header ──────────────────────────────────── -->
<div class="dash-welcome dash-animate dash-delay-1">
    <div>
        <h1>Selamat datang, <span><?php echo e(auth()->user()->name); ?></span></h1>
        <p class="dash-welcome-sub">Berikut ringkasan aktivitas bisnis Anda hari ini</p>
    </div>
    <div class="dash-date">
        <i class="bi bi-calendar3"></i>
        <?php echo e(now()->translatedFormat('l, d F Y')); ?>

    </div>
</div>

<!-- ── KPI Stats Row ───────────────────────────────────── -->
<div class="row g-3 mb-4">
    <div class="col-xl-2 col-md-4 col-6">
        <div class="dash-kpi dash-kpi-blue dash-animate dash-delay-1">
            <div class="dash-kpi-top">
                <div>
                    <div class="dash-kpi-label">Total Pelanggan</div>
                    <div class="dash-kpi-value"><?php echo e($totalCustomers); ?></div>
                </div>
                <div class="dash-kpi-icon blue"><i class="bi bi-people"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="dash-kpi dash-kpi-cyan dash-animate dash-delay-2">
            <div class="dash-kpi-top">
                <div>
                    <div class="dash-kpi-label">Total Pemesanan</div>
                    <div class="dash-kpi-value"><?php echo e($totalBookings); ?></div>
                </div>
                <div class="dash-kpi-icon cyan"><i class="bi bi-calendar-check"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="dash-kpi dash-kpi-green dash-animate dash-delay-3">
            <div class="dash-kpi-top">
                <div>
                    <div class="dash-kpi-label">Selesai</div>
                    <div class="dash-kpi-value" style="color:var(--success)"><?php echo e($completedBookings); ?></div>
                </div>
                <div class="dash-kpi-icon green"><i class="bi bi-check-circle"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="dash-kpi dash-kpi-indigo dash-animate dash-delay-4">
            <div class="dash-kpi-top">
                <div>
                    <div class="dash-kpi-label">Dalam Proses</div>
                    <div class="dash-kpi-value" style="color:#818cf8"><?php echo e($inProgressBookings); ?></div>
                </div>
                <div class="dash-kpi-icon indigo"><i class="bi bi-arrow-repeat"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="dash-kpi dash-kpi-amber dash-animate dash-delay-5">
            <div class="dash-kpi-top">
                <div>
                    <div class="dash-kpi-label">Menunggu</div>
                    <div class="dash-kpi-value" style="color:var(--warning)"><?php echo e($pendingBookings); ?></div>
                </div>
                <div class="dash-kpi-icon amber"><i class="bi bi-hourglass-split"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="dash-kpi dash-kpi-red dash-animate dash-delay-6">
            <div class="dash-kpi-top">
                <div>
                    <div class="dash-kpi-label">Dibatalkan</div>
                    <div class="dash-kpi-value" style="color:var(--danger)"><?php echo e($cancelledBookings); ?></div>
                </div>
                <div class="dash-kpi-icon red"><i class="bi bi-x-circle"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- ── Revenue + Quick Stats ───────────────────────────── -->
<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="dash-revenue dash-animate dash-delay-5">
            <div class="dash-revenue-icon"><i class="bi bi-cash-coin"></i></div>
            <div class="dash-revenue-label">Total Pendapatan</div>
            <div class="dash-revenue-value">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></div>
            <div class="dash-revenue-sub">
                <i class="bi bi-graph-up-arrow"></i>
                <span>Bulan ini: <strong>Rp <?php echo e(number_format($monthlyRevenue, 0, ',', '.')); ?></strong></span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="dash-quick dash-animate dash-delay-6">
            <div class="dash-quick-title"><i class="bi bi-lightning-charge"></i> Ringkasan Cepat</div>
            <div class="dash-quick-item">
                <div class="dash-quick-item-left">
                    <i class="bi bi-tools" style="color:var(--blue-400)"></i> Teknisi Tersedia
                </div>
                <div class="dash-quick-item-value"><?php echo e($availableTechnicians); ?><span style="font-weight:400;font-size:12px;color:var(--text-muted)"> / <?php echo e($totalTechnicians); ?></span></div>
            </div>
            <div class="dash-quick-item">
                <div class="dash-quick-item-left">
                    <i class="bi bi-wrench-adjustable" style="color:var(--info)"></i> Total Layanan
                </div>
                <div class="dash-quick-item-value"><?php echo e($totalServices); ?></div>
            </div>
            <div class="dash-quick-item">
                <div class="dash-quick-item-left">
                    <i class="bi bi-calendar-event" style="color:var(--warning)"></i> Booking Hari Ini
                </div>
                <div class="dash-quick-item-value"><?php echo e($todayBookings); ?></div>
            </div>
        </div>
    </div>
</div>

<!-- ── Slider Carousel ─────────────────────────────────── -->
<?php if($sliders->count() > 0): ?>
    <div class="dash-slider mb-4 dash-animate dash-delay-7">
        <div id="sliderCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="carousel-item <?php if($index === 0): ?> active <?php endif; ?>">
                        <div style="position:relative;">
                            <img src="<?php echo e(asset('storage/' . $slider->image)); ?>"
                                 alt="<?php echo e($slider->title); ?>" class="dash-slider-img">
                            <div class="dash-slider-overlay"></div>
                            <div class="dash-slider-content">
                                <?php if($slider->title): ?><h2><?php echo e($slider->title); ?></h2><?php endif; ?>
                                <?php if($slider->description): ?><p><?php echo e($slider->description); ?></p><?php endif; ?>
                                <?php if($slider->button_text && $slider->button_link): ?>
                                    <a href="<?php echo e($slider->button_link); ?>" class="btn btn-primary"><?php echo e($slider->button_text); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if($sliders->count() > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#sliderCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#sliderCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                <div class="carousel-indicators">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" data-bs-target="#sliderCarousel" data-bs-slide-to="<?php echo e($index); ?>"
                                <?php if($index === 0): ?> class="active" <?php endif; ?>></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- ── Recent Bookings ─────────────────────────────────── -->
<div class="card mb-4 dash-animate dash-delay-7">
    <div class="dash-section-header">
        <h3 class="dash-section-title"><i class="bi bi-calendar-check"></i> Pemesanan Terbaru</h3>
        <a href="<?php echo e(route('bookings.index')); ?>" class="btn btn-sm btn-outline-primary" style="font-size:12px;">
            <i class="bi bi-arrow-right"></i> Lihat Semua
        </a>
    </div>
    <div class="card-body p-0">
        <?php if($recentBookings->isEmpty()): ?>
            <div class="dash-empty">
                <i class="bi bi-inbox"></i>
                Belum ada pemesanan.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width:40px">#</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Teknisi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="width:90px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="color:var(--text-muted);font-weight:500;"><?php echo e($i + 1); ?></td>
                                <td style="font-weight:600;color:var(--text-primary)"><?php echo e($booking->customer->name); ?></td>
                                <td><?php echo e($booking->service->name); ?></td>
                                <td><?php echo e($booking->technician ? $booking->technician->name : '—'); ?></td>
                                <td><?php echo e($booking->scheduled_date->format('d/m/Y H:i')); ?></td>
                                <td>
                                    <span class="badge <?php echo e($booking->status); ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('bookings.show', $booking)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- ── Bottom Row: Technicians + Services ──────────────── -->
<div class="row g-3 dash-animate dash-delay-8">
    <div class="col-lg-6">
        <div class="card">
            <div class="dash-section-header">
                <h3 class="dash-section-title"><i class="bi bi-tools"></i> Statistik Teknisi</h3>
                <a href="<?php echo e(route('technicians.index')); ?>" class="btn btn-sm btn-outline-primary" style="font-size:12px;">
                    <i class="bi bi-arrow-right"></i> Kelola
                </a>
            </div>
            <div class="card-body p-0">
                <?php if($technicianStats->isEmpty()): ?>
                    <div class="dash-empty">
                        <i class="bi bi-person-x"></i>
                        Belum ada teknisi terdaftar.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nama Teknisi</th>
                                    <th>Status</th>
                                    <th style="text-align:right">Total Pekerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $technicianStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technician): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="font-weight:600;color:var(--text-primary)"><?php echo e($technician->name); ?></td>
                                        <td>
                                            <span class="badge <?php if($technician->status === 'available'): ?> completed <?php elseif($technician->status === 'busy'): ?> in_progress <?php else: ?> cancelled <?php endif; ?>">
                                                <?php echo e(ucfirst($technician->status)); ?>

                                            </span>
                                        </td>
                                        <td style="font-weight:700;text-align:right;"><?php echo e($technician->bookings_count); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="dash-section-header">
                <h3 class="dash-section-title"><i class="bi bi-wrench-adjustable"></i> Layanan Tersedia</h3>
                <a href="<?php echo e(route('services.index')); ?>" class="btn btn-sm btn-outline-primary" style="font-size:12px;">
                    <i class="bi bi-arrow-right"></i> Kelola
                </a>
            </div>
            <div class="card-body p-0">
                <?php if($servicesData->isEmpty()): ?>
                    <div class="dash-empty">
                        <i class="bi bi-box"></i>
                        Belum ada layanan tersedia.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nama Layanan</th>
                                    <th style="text-align:right">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $servicesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="font-weight:600;color:var(--text-primary)"><?php echo e($service->name); ?></td>
                                        <td style="text-align:right;font-weight:600;color:var(--success)">
                                            Rp <?php echo e(number_format($service->price, 0, ',', '.')); ?>

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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views\dashboard.blade.php ENDPATH**/ ?>