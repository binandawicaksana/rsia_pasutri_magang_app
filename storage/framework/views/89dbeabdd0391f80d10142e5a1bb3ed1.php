<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <!-- Header / Welcome Banner -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 font-bold flex items-center justify-center text-base shrink-0 border border-indigo-100">
                <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

            </div>
            <div class="space-y-1">
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Halo, <?php echo e(auth()->user()->name); ?>!</h1>
                <div class="flex flex-wrap items-center gap-y-1 gap-x-3 text-xs text-slate-500">
                    <span class="inline-flex items-center gap-1 font-medium text-slate-700">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Pembimbing: <span class="text-indigo-600 font-semibold ml-0.5"><?php echo e($peserta->pembimbing->name ?? 'Belum ditentukan'); ?></span>
                    </span>
                    <span>•</span>
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <?php echo e($peserta->tgl_mulai->format('d M Y')); ?> – <?php echo e($peserta->tgl_selesai->format('d M Y')); ?>

                    </span>
                </div>
            </div>
        </div>

        <a href="<?php echo e(route('cetak.logbook', $peserta)); ?>" target="_blank"
           class="inline-flex items-center justify-center gap-2 text-sm font-medium text-slate-700 hover:text-indigo-600 bg-white hover:bg-slate-50 border border-slate-200/80 px-4 py-2.5 rounded-xl shadow-sm transition-all w-full md:w-auto">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            <span>Cetak Logbook</span>
        </a>
    </div>

    <!-- Main Content Layout -->
    <div class="grid lg:grid-cols-3 gap-6 items-start">
        
        <!-- Left Column: Form Laporan -->
        <form method="POST" action="<?php echo e(route('peserta.logbook.store')); ?>" enctype="multipart/form-data"
              class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm space-y-4 self-start">
            <?php echo csrf_field(); ?>
            
            <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <h2 class="font-bold text-slate-800">Buat Laporan Kegiatan</h2>
            </div>

            <div class="space-y-3.5">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal" value="<?php echo e(old('tanggal', today()->toDateString())); ?>"
                           max="<?php echo e(today()->toDateString()); ?>" 
                           class="w-full text-sm border border-slate-300 rounded-xl px-3.5 py-2 text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Peserta</label>
                    <input type="text" name="nama" value="<?php echo e(old('nama', auth()->user()->name)); ?>"
                           class="w-full text-sm border border-slate-300 rounded-xl px-3.5 py-2 text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Kegiatan</label>
                    <textarea name="kegiatan" rows="4" placeholder="Apa yang Anda kerjakan hari ini?"
                              class="w-full text-sm border border-slate-300 rounded-xl px-3.5 py-2 text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"><?php echo e(old('kegiatan')); ?></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Keterangan (Opsional)</label>
                    <textarea name="keterangan" rows="2" placeholder="Kendala, hasil, atau catatan tambahan..."
                              class="w-full text-sm border border-slate-300 rounded-xl px-3.5 py-2 text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"><?php echo e(old('keterangan')); ?></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Foto Kegiatan</label>
                    <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl space-y-1.5">
                        <input type="file" name="foto" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-slate-900 file:text-white hover:file:bg-slate-800 cursor-pointer">
                        <p class="text-[11px] text-slate-500">JPG, PNG, atau WebP. Maksimal <?php echo e(round(\App\Models\Setting::ambil('maks_foto_kb') / 1024, 1)); ?> MB.</p>
                    </div>
                </div>
            </div>

            <?php if (! (\App\Models\Setting::ambil('terima_laporan'))): ?>
                <div class="flex items-center gap-2 p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium">
                    <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>Pengiriman laporan sedang ditutup oleh admin.</span>
                </div>
            <?php endif; ?>

            <button type="submit" 
                    class="w-full rounded-xl bg-slate-900 hover:bg-slate-800 disabled:bg-slate-300 text-white font-medium py-2.5 text-sm transition-all shadow-md shadow-slate-900/10 active:scale-[0.99] flex items-center justify-center gap-2"
                    <?php if(! \App\Models\Setting::ambil('terima_laporan')): echo 'disabled'; endif; ?>>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                <span>Kirim Laporan</span>
            </button>
        </form>

        <!-- Right Column: Riwayat & Penilaian -->
        <section class="lg:col-span-2 space-y-6">
            
            <!-- Riwayat Laporan Section -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-1">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h2 class="font-bold text-slate-900 text-lg">Riwayat Laporan</h2>
                </div>

                <?php $__empty_1 = true; $__currentLoopData = $logbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-3">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <?php if($l->foto_url): ?>
                                <a href="<?php echo e($l->foto_url); ?>" target="_blank" class="shrink-0 group relative overflow-hidden rounded-xl border border-slate-200">
                                    <img src="<?php echo e($l->foto_url); ?>" alt="Foto kegiatan" class="w-full sm:w-28 h-28 object-cover group-hover:scale-105 transition-transform">
                                </a>
                            <?php endif; ?>

                            <div class="flex-1 min-w-0 space-y-2">
                                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-2">
                                    <span class="text-xs font-semibold text-slate-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <?php echo e($l->tanggal->translatedFormat('d F Y')); ?>

                                    </span>

                                    <?php
                                        $statusStyle = [
                                            'menunggu'  => 'bg-amber-50 text-amber-700 border-amber-200/80',
                                            'disetujui' => 'bg-emerald-50 text-emerald-700 border-emerald-200/80',
                                            'ditolak'   => 'bg-rose-50 text-rose-700 border-rose-200/80',
                                        ][$l->status] ?? 'bg-slate-100 text-slate-700';
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border capitalize <?php echo e($statusStyle); ?>">
                                        <?php echo e($l->status); ?>

                                    </span>
                                </div>

                                <h3 class="font-bold text-slate-800 text-base"><?php echo e($l->nama); ?></h3>
                                <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line"><?php echo e($l->kegiatan); ?></p>

                                <?php if($l->keterangan): ?>
                                    <div class="p-2.5 rounded-xl bg-slate-50 text-xs text-slate-600 border border-slate-100">
                                        <span class="font-semibold text-slate-700">Keterangan:</span> <?php echo e($l->keterangan); ?>

                                    </div>
                                <?php endif; ?>

                                <?php if($l->catatan_pembimbing): ?>
                                    <div class="p-2.5 rounded-xl bg-indigo-50/60 text-xs text-indigo-900 border border-indigo-100/80 flex items-start gap-1.5">
                                        <svg class="w-4 h-4 text-indigo-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                        <div><span class="font-semibold">Catatan Pembimbing:</span> <?php echo e($l->catatan_pembimbing); ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if($l->status !== 'disetujui'): ?>
                            <div class="pt-2 border-t border-slate-100 flex justify-end">
                                <form method="POST" action="<?php echo e(route('peserta.logbook.destroy', $l)); ?>" onsubmit="return confirm('Hapus laporan ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="inline-flex items-center gap-1 text-xs font-medium text-rose-600 hover:text-rose-700 hover:bg-rose-50 px-2.5 py-1.5 rounded-lg transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-8 text-center text-slate-500">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <p class="text-sm font-medium text-slate-600">Belum ada laporan kegiatan</p>
                        <p class="text-xs text-slate-400 mt-0.5">Isi dan kirimkan laporan kegiatan pertama Anda melalui formulir di samping.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Penilaian Akhir Section -->
            <?php if($peserta->penilaian): ?>
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            </div>
                            <h2 class="font-bold text-slate-800">Hasil Penilaian Akhir</h2>
                        </div>
                        <span class="text-sm font-semibold px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full">
                            Rata-rata: <?php echo e($peserta->penilaian->rata_rata); ?>

                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="p-3 bg-slate-50 border border-slate-100 rounded-xl">
                            <span class="text-xs text-slate-500 block mb-0.5">Disiplin</span>
                            <span class="text-base font-bold text-slate-900"><?php echo e($peserta->penilaian->disiplin); ?></span>
                        </div>
                        <div class="p-3 bg-slate-50 border border-slate-100 rounded-xl">
                            <span class="text-xs text-slate-500 block mb-0.5">Kinerja</span>
                            <span class="text-base font-bold text-slate-900"><?php echo e($peserta->penilaian->kinerja); ?></span>
                        </div>
                        <div class="p-3 bg-slate-50 border border-slate-100 rounded-xl">
                            <span class="text-xs text-slate-500 block mb-0.5">Sikap</span>
                            <span class="text-base font-bold text-slate-900"><?php echo e($peserta->penilaian->sikap); ?></span>
                        </div>
                    </div>

                    <?php if($peserta->penilaian->komentar): ?>
                        <div class="p-3.5 rounded-xl bg-slate-50 text-xs text-slate-600 border border-slate-100 space-y-1">
                            <span class="font-semibold text-slate-700 block">Komentar Evaluasi Pembimbing:</span>
                            <p class="leading-relaxed"><?php echo e($peserta->penilaian->komentar); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </section>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['title' => 'Dashboard Peserta'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/peserta/dashboard.blade.php ENDPATH**/ ?>