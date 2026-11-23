

<?php $__env->startSection('title', 'Buat Pemesanan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <i class="bi bi-plus-circle"></i>
        <h1>Buat Pemesanan Baru</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-form-check"></i> Form Pemesanan Layanan</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('customer.bookings.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-4">
                            <label for="category" class="form-label"><strong>Pilih Kategori Jasa <span class="text-danger">*</span></strong></label>
                            <select class="form-control <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="category" name="category" required onchange="filterServices()">
                                <option value="AC" <?php if(old('category', $selectedCategory) === 'AC'): echo 'selected'; endif; ?>>Jasa AC</option>
                                <option value="Gadget" <?php if(old('category', $selectedCategory) === 'Gadget'): echo 'selected'; endif; ?>>Jasa Gadget</option>
                            </select>
                            <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Layanan Selection -->
                        <div class="mb-4">
                            <label for="service_id" class="form-label"><strong>Pilih Layanan <span class="text-danger">*</span></strong></label>
                            <select class="form-control <?php $__errorArgs = ['service_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="service_id" name="service_id" required onchange="updateServiceInfo()">
                                <option value="">-- Pilih Layanan --</option>
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($service->id); ?>" data-category="<?php echo e($service->category ?? 'AC'); ?>" data-price="<?php echo e($service->price); ?>" data-description="<?php echo e($service->description); ?>" <?php if((string) old('service_id', request('service_id')) === (string) $service->id): ?> selected <?php endif; ?>>
                                        <?php echo e($service->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['service_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div id="serviceInfo" class="alert alert-info mt-3" style="display: none;">
                                <h6 id="serviceName"></h6>
                                <p id="serviceDescription" class="mb-2"></p>
                                <p class="mb-0"><strong>Harga: </strong><span id="servicePrice"></span></p>
                            </div>
                            <small class="text-muted d-block mt-2">Daftar layanan menyesuaikan kategori jasa yang dipilih.</small>
                        </div>

                        <!-- Teknisi Selection (Optional) -->
                        <div class="mb-4">
                            <label for="technician_id" class="form-label">Pilih Teknisi (Opsional)</label>
                            <select class="form-control <?php $__errorArgs = ['technician_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="technician_id" name="technician_id">
                                <option value="">-- Biarkan Admin Menugaskan --</option>
                                <?php $__currentLoopData = $technicians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technician): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($technician->id); ?>" <?php if(old('technician_id') == $technician->id): ?> selected <?php endif; ?>>
                                        <?php echo e($technician->name); ?> (<?php echo e($technician->specialization); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['technician_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted d-block mt-2">Jika tidak memilih, admin akan menugaskan teknisi yang tersedia</small>
                        </div>

                        <!-- Schedule Date & Time -->
                        <div class="mb-4">
                            <label for="scheduled_date" class="form-label"><strong>Tanggal & Waktu Jadwal <span class="text-danger">*</span></strong></label>
                            <input type="datetime-local" class="form-control <?php $__errorArgs = ['scheduled_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="scheduled_date" name="scheduled_date" value="<?php echo e(old('scheduled_date')); ?>" required>
                            <?php $__errorArgs = ['scheduled_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted d-block mt-2">Pilih tanggal dan waktu kapan Anda ingin layanan dilakukan</small>
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <label for="notes" class="form-label">Catatan atau Permintaan Khusus (Opsional)</label>
                            <textarea class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="notes" name="notes" rows="4" placeholder="Contoh: AC bocor, layar smartphone pecah, atau baterai cepat habis..."><?php echo e(old('notes')); ?></textarea>
                            <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted d-block mt-2">Berikan informasi tambahan untuk membantu teknisi mempersiapkan perlengkapan</small>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo e(route('customer.bookings.index')); ?>" class="btn btn-light">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Buat Pemesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Penting</h6>
                </div>
                <div class="card-body">
                    <p class="small mb-2">
                        <strong>Jadwal Layanan:</strong><br>
                        Pastikan memilih tanggal dan waktu sesuai ketersediaan Anda. Teknisi kami akan datang tepat waktu.
                    </p>
                    <hr>
                    <p class="small mb-2">
                        <strong>Catatan Penting:</strong><br>
                        Semakin detail catatan Anda, semakin baik teknisi kami dapat mempersiapkan diri.
                    </p>
                    <hr>
                    <p class="small mb-0">
                        <strong>Proses Pemesanan:</strong><br>
                        1. Buat pemesanan (status: Pending)<br>
                        2. Admin konfirmasi (status: Confirmed)<br>
                        3. Invoice dikirim untuk pembayaran<br>
                        4. Teknisi datang sesuai jadwal<br>
                        5. Pembayaran diselesaikan
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-question-circle"></i> Pertanyaan?</h6>
                </div>
                <div class="card-body">
                    <p class="small mb-0">Jika ada pertanyaan, hubungi admin melalui dashboard atau whatsapp kami.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterServices() {
            const category = document.getElementById('category').value;
            const select = document.getElementById('service_id');
            let selectedServiceHidden = false;

            Array.from(select.options).forEach(function(option) {
                if (!option.value) {
                    return;
                }

                const isAvailable = option.getAttribute('data-category') === category;
                option.hidden = !isAvailable;
                option.disabled = !isAvailable;

                if (option.selected && !isAvailable) {
                    selectedServiceHidden = true;
                }
            });

            if (selectedServiceHidden) {
                select.value = '';
                updateServiceInfo();
            }
        }

        function updateServiceInfo() {
            const select = document.getElementById('service_id');
            const selected = select.options[select.selectedIndex];
            const infoDiv = document.getElementById('serviceInfo');

            if (select.value) {
                document.getElementById('serviceName').textContent = selected.text;
                document.getElementById('serviceDescription').textContent = selected.getAttribute('data-description');
                document.getElementById('servicePrice').textContent = 'Rp ' + parseInt(selected.getAttribute('data-price')).toLocaleString('id-ID');
                infoDiv.style.display = 'block';
            } else {
                infoDiv.style.display = 'none';
            }
        }

        // Update on page load if value exists
        document.addEventListener('DOMContentLoaded', function() {
            filterServices();

            if (document.getElementById('service_id').value) {
                updateServiceInfo();
            }

            // Set minimum date to now
            const now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            document.getElementById('scheduled_date').min = now.toISOString().slice(0, 16);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\web\resources\views/customer/bookings/create.blade.php ENDPATH**/ ?>