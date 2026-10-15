<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penyedia Jasa - JASAKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background: #f4f6f8; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 30px; }
        .card { max-width: 680px; margin: 0 auto; border-radius: 10px; box-shadow: 0 8px 30px rgba(28,38,51,0.08); }
        .form-label { font-weight: 600; }
        .btn-primary { background: #0d6efd; border: none; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar sebagai Penyedia Jasa / Teknisi</h4>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('auth.register.provider')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" class="form-control" rows="2" required><?php echo e(old('address')); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="specialization" class="form-label">Jenis Jasa *</label>
                    <select id="specialization" name="specialization" class="form-select <?php $__errorArgs = ['specialization'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">Pilih jenis jasa</option>
                        <option value="AC" <?php if(old('specialization') === 'AC'): echo 'selected'; endif; ?>>Penyedia Jasa AC</option>
                        <option value="Gadget" <?php if(old('specialization') === 'Gadget'): echo 'selected'; endif; ?>>Penyedia Jasa Gadget</option>
                    </select>
                    <?php $__errorArgs = ['specialization'];
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

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-person-plus"></i> Daftar Penyedia</button>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-secondary">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\web\resources\views/auth/register_provider.blade.php ENDPATH**/ ?>