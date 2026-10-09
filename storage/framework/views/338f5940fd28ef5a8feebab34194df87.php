<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Monitoring Magang'); ?> · <?php echo e(\App\Models\Setting::ambil('nama_rs')); ?></title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="min-h-full bg-slate-50 text-slate-800 flex flex-col antialiased">

<!-- Navigation Bar -->
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/80 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        
        <!-- Brand Logo & Title -->
        <div class="flex items-center gap-3">
            <?php if(file_exists(public_path('images/logorsiapasutri4.jpg'))): ?>
                <div class="p-1.5 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center">
                    <img src="<?php echo e(asset('images/logorsiapasutri4.jpg')); ?>" alt="Logo RSIA Pasutri" class="h-8 w-auto object-contain">
                </div>
            <?php elseif($logo = \App\Models\Setting::logoUrl()): ?>
                <div class="p-1.5 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center">
                    <img src="<?php echo e($logo); ?>" alt="Logo" class="h-6 w-auto object-contain">
                </div>
            <?php endif; ?>

            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-900 tracking-tight text-base sm:text-lg">
                    Monitoring Magang
                </span>
                <span class="hidden sm:inline-block text-slate-400 font-normal text-sm">|</span>
                <span class="hidden sm:inline-block text-slate-500 font-medium text-sm">
                    <?php echo e(\App\Models\Setting::ambil('nama_rs')); ?>

                </span>
            </div>
            <span class="ml-1 text-xs font-semibold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100 px-2.5 py-0.5 capitalize">
                <?php echo e(auth()->user()->role); ?>

            </span>
        </div>

        <!-- User Info & Navigation Actions -->
        <div class="flex items-center gap-3 sm:gap-4 text-sm">
            <?php if(auth()->user()->isAdmin()): ?>
                <a href="<?php echo e(route('admin.setting.edit')); ?>" 
                   class="inline-flex items-center gap-1.5 text-slate-600 hover:text-indigo-600 font-medium px-3 py-1.5 rounded-lg hover:bg-slate-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span class="hidden md:inline">Pengaturan</span>
                </a>
            <?php endif; ?>

            <!-- User Profile Badge -->
            <div class="flex items-center gap-2 bg-slate-100/80 px-3 py-1.5 rounded-full border border-slate-200/60">
                <div class="w-6 h-6 rounded-full bg-slate-800 text-white flex items-center justify-center text-xs font-semibold">
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                </div>
                <span class="font-medium text-slate-700 max-w-[120px] sm:max-w-[180px] truncate">
                    <?php echo e(auth()->user()->name); ?>

                </span>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline-flex">
                <?php echo csrf_field(); ?>
                <button type="submit" class="inline-flex items-center gap-1.5 text-rose-600 hover:text-rose-700 hover:bg-rose-50 font-medium px-3 py-1.5 rounded-lg transition-all" title="Keluar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span class="hidden sm:inline">Keluar</span>
                </button>
            </form>
        </div>

    </div>
</nav>

<!-- Main Content Container -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6 flex-1 w-full">

    <!-- Flash Notification Success -->
    <?php if(session('ok')): ?>
        <div class="flex items-center gap-3 rounded-2xl bg-emerald-50 border border-emerald-200/80 p-4 text-emerald-800 shadow-sm">
            <div class="p-1.5 bg-emerald-500 text-white rounded-lg shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="text-sm font-medium"><?php echo e(session('ok')); ?></div>
        </div>
    <?php endif; ?>

    <!-- Flash Notification Errors -->
    <?php if($errors->any()): ?>
        <div class="rounded-2xl bg-rose-50 border border-rose-200/80 p-4 text-rose-800 shadow-sm space-y-1">
            <div class="flex items-center gap-2 font-semibold text-sm mb-1">
                <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Terjadi kesalahan:</span>
            </div>
            <ul class="list-disc list-inside text-sm space-y-0.5 text-rose-700 pl-2">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($e); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Dynamic Section Content -->
    <?php echo $__env->yieldContent('content'); ?>

</main>

</body>
</html><?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/layouts/app.blade.php ENDPATH**/ ?>