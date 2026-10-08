<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <?php $__currentLoopData = [['Peserta magang',$totalPeserta],['Pembimbing',$totalPembimbing],['Laporan menunggu',$logbookMenunggu],['Belum ada pembimbing',$tanpaPembimbing]]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$l,$v]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-lg border p-4"><div class="text-2xl font-semibold"><?php echo e($v); ?></div><div class="text-sm text-slate-500"><?php echo e($l); ?></div></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<section class="bg-white rounded-lg border">
    <h2 class="px-4 py-3 font-semibold border-b">Daftar peserta magang</h2>
    <div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-left"><tr>
            <th class="p-3">Nama</th><th>Instansi</th><th>Periode</th><th>Laporan</th><th>Pembimbing</th><th></th>
        </tr></thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $pesertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="border-t">
                <td class="p-3"><?php echo e($p->user->name); ?><div class="text-xs text-slate-500"><?php echo e($p->user->email); ?></div></td>
                <td><?php echo e($p->instansi); ?></td>
                <td><?php echo e($p->tgl_mulai->format('d M Y')); ?> – <?php echo e($p->tgl_selesai->format('d M Y')); ?></td>
                <td><?php echo e($p->logbooks_count); ?></td>
                <td>
                    <form method="POST" action="<?php echo e(route('admin.peserta.assign', $p)); ?>" class="flex gap-1">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <select name="pembimbing_id" class="border rounded px-2 py-1">
                            <option value="">— pilih —</option>
                            <?php $__currentLoopData = $pembimbings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pb->id); ?>" <?php if($p->pembimbing_id === $pb->id): echo 'selected'; endif; ?>><?php echo e($pb->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button class="rounded bg-slate-800 text-white px-2">Simpan</button>
                    </form>
                </td>
                <td class="pr-3 text-right whitespace-nowrap">
                    <a href="<?php echo e(route('cetak.logbook', $p)); ?>" target="_blank" class="mr-3 hover:underline">Cetak</a>
                    <form class="inline" method="POST" action="<?php echo e(route('admin.peserta.destroy', $p)); ?>" onsubmit="return confirm('Hapus peserta ini?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" class="p-6 text-center text-slate-500">Belum ada peserta. Tambahkan lewat formulir di bawah.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
</section>

<div class="grid md:grid-cols-2 gap-6">
    <form method="POST" action="<?php echo e(route('admin.peserta.store')); ?>" class="bg-white rounded-lg border p-4 space-y-2">
        <?php echo csrf_field(); ?>
        <h2 class="font-semibold">Tambah peserta magang</h2>
        <?php $__currentLoopData = [['name','Nama','text'],['email','Email','email'],['password','Kata sandi','password'],['instansi','Instansi / kampus','text'],['jurusan','Jurusan','text'],['tgl_mulai','Tanggal mulai','date'],['tgl_selesai','Tanggal selesai','date']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$n,$l,$t]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="block text-sm"><?php echo e($l); ?>

                <input type="<?php echo e($t); ?>" name="<?php echo e($n); ?>" value="<?php echo e($t==='password' ? '' : old($n)); ?>" class="mt-1 w-full border rounded px-2 py-1">
            </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <label class="block text-sm">Pembimbing lapangan
            <select name="pembimbing_id" class="mt-1 w-full border rounded px-2 py-1">
                <option value="">— belum ditentukan —</option>
                <?php $__currentLoopData = $pembimbings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($pb->id); ?>"><?php echo e($pb->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </label>
        <button class="rounded bg-slate-800 text-white px-4 py-2 text-sm">Tambah peserta</button>
    </form>

    <form method="POST" action="<?php echo e(route('admin.pembimbing.store')); ?>" class="bg-white rounded-lg border p-4 space-y-2 self-start">
        <?php echo csrf_field(); ?>
        <h2 class="font-semibold">Tambah pembimbing lapangan</h2>
        <?php $__currentLoopData = [['name','Nama','text'],['email','Email','email'],['password','Kata sandi','password']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$n,$l,$t]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="block text-sm"><?php echo e($l); ?>

                <input type="<?php echo e($t); ?>" name="<?php echo e($n); ?>" class="mt-1 w-full border rounded px-2 py-1">
            </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button class="rounded bg-slate-800 text-white px-4 py-2 text-sm">Tambah pembimbing</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Dashboard Admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>