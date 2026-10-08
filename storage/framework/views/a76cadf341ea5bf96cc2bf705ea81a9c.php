<?php $__env->startSection('content'); ?>
<h1 class="text-xl font-semibold">Pengaturan</h1>

<form method="POST" action="<?php echo e(route('admin.setting.update')); ?>" enctype="multipart/form-data"
      class="bg-white rounded-lg border p-5 space-y-5 max-w-xl">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

    <div class="space-y-3">
        <h2 class="font-semibold">Identitas</h2>
        <label class="block text-sm">Nama rumah sakit
            <input type="text" name="nama_rs" value="<?php echo e(old('nama_rs', $nama_rs)); ?>" class="mt-1 w-full border rounded px-2 py-1">
        </label>
        <div class="text-sm">
            Logo
            <div class="mt-1 flex items-center gap-3">
                <?php if($logoUrl): ?><img src="<?php echo e($logoUrl); ?>" alt="Logo" class="h-12 w-12 object-contain border rounded"><?php endif; ?>
                <input type="file" name="logo" accept="image/*" class="text-sm">
            </div>
            <span class="text-xs text-slate-500">PNG, JPG, atau WebP. Maksimal 1 MB.</span>
            <?php if($logoUrl): ?>
                <label class="mt-1 flex items-center gap-2 text-xs"><input type="checkbox" name="hapus_logo" value="1"> Hapus logo saat ini</label>
            <?php endif; ?>
        </div>
    </div>

    <div class="space-y-3 border-t pt-4">
        <h2 class="font-semibold">Laporan kegiatan peserta</h2>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="terima_laporan" value="1" <?php if(old('terima_laporan', $terima_laporan)): echo 'checked'; endif; ?>>
            Peserta boleh mengirim laporan baru
        </label>
        <label class="block text-sm">Batas mundur tanggal laporan (hari)
            <input type="number" min="0" max="60" name="batas_hari_laporan" value="<?php echo e(old('batas_hari_laporan', $batas_hari_laporan)); ?>" class="mt-1 w-32 border rounded px-2 py-1">
            <span class="block text-xs text-slate-500">0 = hanya boleh tanggal hari ini.</span>
        </label>
        <label class="block text-sm">Ukuran maksimal foto (KB)
            <input type="number" min="256" max="10240" name="maks_foto_kb" value="<?php echo e(old('maks_foto_kb', $maks_foto_kb)); ?>" class="mt-1 w-32 border rounded px-2 py-1">
            <span class="block text-xs text-slate-500">2048 KB = 2 MB.</span>
        </label>
    </div>

    <button class="rounded bg-slate-800 text-white px-4 py-2 text-sm">Simpan pengaturan</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Pengaturan'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/admin/setting.blade.php ENDPATH**/ ?>