<?php $__env->startSection('content'); ?>
<div class="max-w-3xl space-y-6">

    <!-- Page Title Header -->
    <a href="<?php echo e(route('admin.dashboard')); ?>"
        class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-100 border border-slate-200/80 px-3.5 py-2 rounded-xl shadow-sm transition-all group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali</span>
    </a>
    </a>
    <div class="flex items-center gap-3">
        <div class="p-2.5 bg-indigo-50 text-indigo-600 rounded-2xl border border-indigo-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Pengaturan Sistem</h1>
            <p class="text-sm text-slate-500">Atur identitas instansi dan aturan pengiriman laporan kegiatan peserta</p>
        </div>
    </div>

    <!-- Main Settings Form -->
    <form method="POST" action="<?php echo e(route('admin.setting.update')); ?>" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Card Section: Identitas -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-5">
            <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h2 class="font-bold text-slate-800">Identitas Instansi</h2>
            </div>

            <div class="space-y-4">
                <!-- Nama RS -->
                <div>
                    <label for="nama_rs" class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Rumah Sakit / Instansi</label>
                    <input type="text" id="nama_rs" name="nama_rs" value="<?php echo e(old('nama_rs', $nama_rs)); ?>" required
                        class="w-full text-sm border border-slate-300 rounded-xl px-3.5 py-2.5 text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                </div>

                <!-- Logo Upload -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Logo Instansi</label>
                    <div class="flex items-start gap-4 p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                        <?php if($logoUrl): ?>
                        <div class="p-2 bg-white rounded-xl border border-slate-200 shrink-0 shadow-sm">
                            <img src="<?php echo e($logoUrl); ?>" alt="Logo Instansi" class="h-12 w-12 object-contain">
                        </div>
                        <?php else: ?>
                        <div class="p-3 bg-slate-100 text-slate-400 rounded-xl border border-slate-200 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <?php endif; ?>

                        <div class="space-y-2 flex-1">
                            <input type="file" name="logo" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-slate-900 file:text-white hover:file:bg-slate-800 transition-all cursor-pointer">
                            <p class="text-xs text-slate-500">Format gambar: PNG, JPG, atau WebP. Ukuran maksimal 1 MB.</p>

                            <?php if($logoUrl): ?>
                            <div class="pt-1">
                                <label class="inline-flex items-center gap-2 text-xs font-medium text-rose-600 cursor-pointer select-none">
                                    <input type="checkbox" name="hapus_logo" value="1" class="w-4 h-4 rounded border-slate-300 text-rose-600 focus:ring-rose-500 transition-all">
                                    <span>Hapus logo saat ini</span>
                                </label>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Section: Laporan Kegiatan -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-5">
            <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h2 class="font-bold text-slate-800">Aturan Laporan Kegiatan Peserta</h2>
            </div>

            <div class="space-y-4">
                <!-- Toggle Status Laporan -->
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-slate-800">Izin Pengiriman Laporan</div>
                        <div class="text-xs text-slate-500">Izinkan atau cegah peserta mengirim laporan kegiatan baru</div>
                    </div>
                    <label class="flex items-center gap-2 text-sm font-medium text-slate-700 cursor-pointer select-none">
                        <input type="checkbox" name="terima_laporan" value="1" <?php if(old('terima_laporan', $terima_laporan)): echo 'checked'; endif; ?>
                            class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 transition-all">
                        <span>Aktif</span>
                    </label>
                </div>

                <!-- Input Grid -->
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="batas_hari_laporan" class="block text-xs font-semibold text-slate-700 mb-1.5">Batas Mundur Tanggal (Hari)</label>
                        <div class="relative">
                            <input type="number" min="0" max="60" id="batas_hari_laporan" name="batas_hari_laporan"
                                value="<?php echo e(old('batas_hari_laporan', $batas_hari_laporan)); ?>"
                                class="w-full text-sm border border-slate-300 rounded-xl px-3.5 py-2.5 text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Isi <code class="bg-slate-100 px-1 py-0.5 rounded text-slate-700">0</code> jika laporan hanya boleh dibuat pada hari yang sama.</p>
                    </div>

                    <div>
                        <label for="maks_foto_kb" class="block text-xs font-semibold text-slate-700 mb-1.5">Ukuran Maksimal Foto (KB)</label>
                        <div class="relative">
                            <input type="number" min="256" max="10240" id="maks_foto_kb" name="maks_foto_kb"
                                value="<?php echo e(old('maks_foto_kb', $maks_foto_kb)); ?>"
                                class="w-full text-sm border border-slate-300 rounded-xl px-3.5 py-2.5 text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Contoh: <code class="bg-slate-100 px-1 py-0.5 rounded text-slate-700">2048 KB</code> setara dengan 2 MB.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-medium px-6 py-2.5 text-sm shadow-md shadow-slate-900/10 active:scale-[0.99] transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Simpan Pengaturan</span>
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['title' => 'Pengaturan'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/admin/setting.blade.php ENDPATH**/ ?>