<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <!-- Top Action & Navigation Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <a href="<?php echo e(route('pembimbing.dashboard')); ?>" 
           class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-100 border border-slate-200/80 px-3.5 py-2 rounded-xl shadow-sm transition-all group w-fit">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali</span>
        </a>

        <a href="<?php echo e(route('cetak.logbook', $peserta)); ?>" target="_blank" 
           class="inline-flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-indigo-600 bg-white hover:bg-slate-50 border border-slate-200/80 px-4 py-2 rounded-xl shadow-sm transition-all w-fit">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            <span>Cetak Logbook</span>
        </a>
    </div>

    <!-- Student Header Banner -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm flex flex-col sm:flex-row items-start sm:items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-700 font-bold flex items-center justify-center text-lg shrink-0 border border-indigo-100">
            <?php echo e(strtoupper(substr($peserta->user->name, 0, 2))); ?>

        </div>
        <div class="space-y-1">
            <h1 class="text-2xl font-bold text-slate-900"><?php echo e($peserta->user->name); ?></h1>
            <p class="text-sm text-slate-500 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span><?php echo e($peserta->instansi); ?></span>
            </p>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="grid lg:grid-cols-3 gap-6 items-start">
        
        <!-- Left Column: Logbook Activities -->
        <section class="lg:col-span-2 space-y-4">
            <div class="flex items-center gap-2 pb-1">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h2 class="font-bold text-slate-900 text-lg">Laporan Kegiatan</h2>
            </div>

            <?php $__empty_1 = true; $__currentLoopData = $logbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <?php if($l->foto_url): ?>
                            <a href="<?php echo e($l->foto_url); ?>" target="_blank" class="shrink-0 group relative overflow-hidden rounded-xl border border-slate-200">
                                <img src="<?php echo e($l->foto_url); ?>" alt="Foto kegiatan" class="w-full sm:w-32 h-32 object-cover group-hover:scale-105 transition-transform">
                            </a>
                        <?php endif; ?>

                        <div class="flex-1 min-w-0 space-y-2">
                            <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-2">
                                <span class="text-xs font-semibold text-slate-500 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <?php echo e($l->tanggal->translatedFormat('l, d F Y')); ?>

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
                                    <div><span class="font-semibold">Catatan Anda:</span> <?php echo e($l->catatan_pembimbing); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($l->status === 'menunggu'): ?>
                        <form method="POST" action="<?php echo e(route('pembimbing.logbook.review', $l)); ?>" class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row gap-2">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <input name="catatan_pembimbing" placeholder="Tulis catatan (opsional)" 
                                   class="flex-1 text-sm border border-slate-300 rounded-xl px-3.5 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                            
                            <div class="flex gap-2">
                                <button type="submit" name="status" value="disetujui" 
                                        class="inline-flex items-center gap-1 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-4 py-2 text-sm shadow-sm transition-all active:scale-[0.98]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Setujui
                                </button>
                                <button type="submit" name="status" value="ditolak" 
                                        class="inline-flex items-center gap-1 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-medium px-4 py-2 text-sm shadow-sm transition-all active:scale-[0.98]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Tolak
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="bg-white rounded-2xl border border-slate-200/80 p-8 text-center text-slate-500">
                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-sm font-medium text-slate-600">Belum ada laporan kegiatan</p>
                    <p class="text-xs text-slate-400 mt-0.5">Peserta belum mengirimkan logbook kegiatan harian.</p>
                </div>
            <?php endif; ?>
        </section>

        <!-- Right Column: Final Evaluation Form -->
        <aside class="sticky top-20">
            <form method="POST" action="<?php echo e(route('pembimbing.nilai', $peserta)); ?>" class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm space-y-4">
                <?php echo csrf_field(); ?>
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    <h2 class="font-bold text-slate-800">Penilaian Akhir</h2>
                </div>

                <div class="space-y-3">
                    <?php $__currentLoopData = ['disiplin'=>'Disiplin','kinerja'=>'Kinerja','sikap'=>'Sikap']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <label for="<?php echo e($k); ?>" class="block text-xs font-semibold text-slate-700 mb-1"><?php echo e($label); ?> (0–100)</label>
                            <input type="number" min="0" max="100" id="<?php echo e($k); ?>" name="<?php echo e($k); ?>" 
                                   value="<?php echo e(old($k, $peserta->penilaian->$k ?? '')); ?>" 
                                   placeholder="0 - 100"
                                   class="w-full text-sm border border-slate-300 rounded-xl px-3.5 py-2 text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div>
                        <label for="komentar" class="block text-xs font-semibold text-slate-700 mb-1">Komentar / Evaluasi</label>
                        <textarea id="komentar" name="komentar" rows="3" placeholder="Tulis masukan atau evaluasi untuk peserta..." 
                                  class="w-full text-sm border border-slate-300 rounded-xl px-3.5 py-2 text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"><?php echo e(old('komentar', $peserta->penilaian->komentar ?? '')); ?></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-medium py-2.5 text-sm shadow-md shadow-slate-900/10 active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Simpan Penilaian</span>
                </button>
            </form>
        </aside>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['title' => $peserta->user->name], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/pembimbing/show.blade.php ENDPATH**/ ?>