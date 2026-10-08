<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Monitoring Magang'); ?> · <?php echo e(\App\Models\Setting::ambil('nama_rs')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800">
<nav class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
        <span class="font-semibold flex items-center gap-2">
            <?php if($logo = \App\Models\Setting::logoUrl()): ?><img src="<?php echo e($logo); ?>" alt="" class="h-7 w-7 object-contain"><?php endif; ?>
            Monitoring Magang <span class="text-slate-500 font-normal"><?php echo e(\App\Models\Setting::ambil('nama_rs')); ?></span>
            <span class="ml-2 text-xs rounded bg-slate-100 px-2 py-0.5"><?php echo e(ucfirst(auth()->user()->role)); ?></span>
        </span>
        <div class="flex items-center gap-4 text-sm">
            <?php if(auth()->user()->isAdmin()): ?>
                <a href="<?php echo e(route('admin.setting.edit')); ?>" class="hover:underline">Pengaturan</a>
            <?php endif; ?>
            <span><?php echo e(auth()->user()->name); ?></span>
            <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
                <button class="text-red-600 hover:underline">Keluar</button>
            </form>
        </div>
    </div>
</nav>
<main class="max-w-6xl mx-auto px-4 py-6 space-y-6">
    <?php if(session('ok')): ?>
        <div class="rounded bg-green-50 border border-green-200 text-green-800 px-4 py-2 text-sm"><?php echo e(session('ok')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="rounded bg-red-50 border border-red-200 text-red-800 px-4 py-2 text-sm">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($e); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</main>
</body>
</html>
<?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/layouts/app.blade.php ENDPATH**/ ?>