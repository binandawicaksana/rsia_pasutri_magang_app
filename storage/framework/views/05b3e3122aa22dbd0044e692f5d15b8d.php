<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk · Monitoring Magang <?php echo e(\App\Models\Setting::ambil('nama_rs')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 flex items-center justify-center p-4">
<div class="w-full max-w-sm">
    <div class="text-center mb-6">
        <?php if($logo = \App\Models\Setting::logoUrl()): ?><img src="<?php echo e($logo); ?>" alt="" class="h-14 mx-auto mb-2 object-contain"><?php endif; ?>
        <h1 class="text-xl font-semibold">Monitoring Magang</h1>
        <p class="text-sm font-medium text-slate-600 mt-1"><?php echo e(\App\Models\Setting::ambil('nama_rs')); ?></p>
        <p class="text-sm text-slate-500 mt-1">Masuk untuk melanjutkan</p>
    </div>

    <form method="POST" action="<?php echo e(route('login')); ?>" class="bg-white border rounded-lg p-6 space-y-4">
        <?php echo csrf_field(); ?>

        <?php if(session('status')): ?>
            <div class="rounded bg-green-50 border border-green-200 text-green-800 px-3 py-2 text-sm"><?php echo e(session('status')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="rounded bg-red-50 border border-red-200 text-red-800 px-3 py-2 text-sm">
                Email atau kata sandi salah. Coba lagi.
            </div>
        <?php endif; ?>

        <label class="block text-sm">Email
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus autocomplete="username"
                   placeholder="nama@email.com"
                   class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-300">
        </label>

        <label class="block text-sm">Kata sandi
            <input type="password" name="password" required autocomplete="current-password"
                   class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-300">
        </label>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember" class="rounded border-slate-300"> Ingat saya
        </label>

        <button class="w-full rounded bg-slate-800 text-white py-2 text-sm hover:bg-slate-700">Masuk</button>
    </form>

    <p class="text-xs text-slate-500 text-center mt-4">
        Belum punya akun? Hubungi admin untuk dibuatkan akun.
    </p>

    <?php if(app()->environment('local')): ?>
        <div class="mt-4 rounded border border-dashed bg-white p-3 text-xs text-slate-600 space-y-1">
            <div class="font-medium text-slate-700">Akun demo (kata sandi: password)</div>
            <div>admin@magang.test</div>
            <div>pembimbing@magang.test</div>
            <div>peserta@magang.test</div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
<?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/auth/login.blade.php ENDPATH**/ ?>