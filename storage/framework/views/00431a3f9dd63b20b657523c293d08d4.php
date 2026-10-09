<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    <!-- Top Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <?php
        $stats = [
        [
        'label' => 'Peserta Magang',
        'value' => $totalPeserta,
        'icon' => '
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />',
        'color' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
        'iconBg' => 'bg-indigo-500 text-white'
        ],
        [
        'label' => 'Pembimbing',
        'value' => $totalPembimbing,
        'icon' => '
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />',
        'color' => 'bg-blue-50 text-blue-600 border-blue-100',
        'iconBg' => 'bg-blue-500 text-white'
        ],
        [
        'label' => 'Laporan Menunggu',
        'value' => $logbookMenunggu,
        'icon' => '
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'color' => 'bg-amber-50 text-amber-600 border-amber-100',
        'iconBg' => 'bg-amber-500 text-white'
        ],
        [
        'label' => 'Belum Ada Pembimbing',
        'value' => $tanpaPembimbing,
        'icon' => '
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />',
        'color' => 'bg-rose-50 text-rose-600 border-rose-100',
        'iconBg' => 'bg-rose-500 text-white'
        ],
        ];
        ?>

        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1"><?php echo e($st['label']); ?></p>
                <h3 class="text-3xl font-bold text-slate-900"><?php echo e($st['value']); ?></h3>
            </div>
            <div class="p-3 rounded-xl <?php echo e($st['iconBg']); ?> shadow-md shadow-slate-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <?php echo $st['icon']; ?>

                </svg>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Table Section -->
    <section class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div class="flex items-center gap-2.5">
                <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-slate-800">Daftar Peserta Magang</h2>
                    <p class="text-xs text-slate-500">Kelola dan tentukan pembimbing peserta magang</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200/80 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">Nama & Email</th>
                        <th class="py-3.5 px-4">Instansi</th>
                        <th class="py-3.5 px-4">Periode Magang</th>
                        <th class="py-3.5 px-4 text-center">Laporan</th>
                        <th class="py-3.5 px-4">Pembimbing</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $pesertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-semibold flex items-center justify-center text-xs shrink-0 border border-slate-200">
                                    <?php echo e(strtoupper(substr($p->user->name, 0, 2))); ?>

                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900"><?php echo e($p->user->name); ?></div>
                                    <div class="text-xs text-slate-500"><?php echo e($p->user->email); ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-700">
                            <?php echo e($p->instansi); ?>

                        </td>
                        <td class="py-4 px-4 text-xs text-slate-600 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 bg-slate-100 px-2.5 py-1 rounded-md">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <?php echo e($p->tgl_mulai->format('d M Y')); ?> – <?php echo e($p->tgl_selesai->format('d M Y')); ?>

                            </span>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                <?php echo e($p->logbooks_count); ?> Laporan
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <form method="POST" action="<?php echo e(route('admin.peserta.assign', $p)); ?>" class="flex items-center gap-1.5">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <select name="pembimbing_id" class="text-xs border border-slate-300 rounded-lg px-2.5 py-1.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none bg-white">
                                    <option value="">— Pilih —</option>
                                    <?php $__currentLoopData = $pembimbings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pb->id); ?>" <?php if($p->pembimbing_id === $pb->id): echo 'selected'; endif; ?>><?php echo e($pb->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <button type="submit" title="Simpan Pembimbing" class="rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white p-1.5 transition-all active:scale-95 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="<?php echo e(route('cetak.logbook', $p)); ?>" target="_blank" class="inline-flex items-center gap-1 text-xs font-medium text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 hover:text-indigo-600 px-2.5 py-1.5 rounded-lg transition-all shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Cetak
                                </a>
                                <form class="inline" method="POST" action="<?php echo e(route('admin.peserta.destroy', $p)); ?>" onsubmit="return confirm('Hapus peserta ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="inline-flex items-center gap-1 text-xs font-medium text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-200 px-2 py-1.5 rounded-lg transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">
                            <div class="max-w-xs mx-auto">
                                <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p class="text-sm font-medium text-slate-600">Belum ada data peserta</p>
                                <p class="text-xs text-slate-400 mt-0.5">Gunakan formulir di bawah untuk menambahkan peserta baru.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Forms Section -->
    <div class="grid md:grid-cols-2 gap-6 items-start">



        <!-- Form Tambah Pembimbing -->
        <form method="POST" action="<?php echo e(route('admin.pembimbing.store')); ?>" class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm space-y-4">
            <?php echo csrf_field(); ?>
            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="font-bold text-slate-800">Tambah Pembimbing Lapangan</h2>
            </div>

            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Pembimbing</label>
                    <input type="text" name="name" required placeholder="cth. Dr. Jane Doe" class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" required placeholder="pembimbing@email.com" class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                </div>
            </div>

            <button type="submit" class="w-full rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 text-sm transition-all shadow-md shadow-indigo-600/10 active:scale-[0.99] flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pembimbing
            </button>
        </form>
        <!-- Form Tambah Peserta -->
        <form method="POST" action="<?php echo e(route('admin.peserta.store')); ?>" class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm space-y-4">
            <?php echo csrf_field(); ?>
            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h2 class="font-bold text-slate-800">Tambah Peserta Magang</h2>
            </div>

            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required placeholder="cth. John Doe" class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required placeholder="nama@email.com" class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Instansi / Kampus</label>
                        <input type="text" name="instansi" value="<?php echo e(old('instansi')); ?>" required placeholder="Universitas ..." class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Jurusan</label>
                        <input type="text" name="jurusan" value="<?php echo e(old('jurusan')); ?>" required placeholder="Informatika ..." class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" value="<?php echo e(old('tgl_mulai')); ?>" required class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" value="<?php echo e(old('tgl_selesai')); ?>" required class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Pembimbing Lapangan</label>
                    <select name="pembimbing_id" class="w-full text-sm border border-slate-300 rounded-xl px-3 py-2 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all bg-white">
                        <option value="">— Belum Ditentukan —</option>
                        <?php $__currentLoopData = $pembimbings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($pb->id); ?>"><?php echo e($pb->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="w-full rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-medium py-2.5 text-sm transition-all shadow-md shadow-slate-900/10 active:scale-[0.99] flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Peserta
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['title' => 'Dashboard Admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>