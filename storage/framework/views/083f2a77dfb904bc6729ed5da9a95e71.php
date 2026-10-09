<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logbook Kegiatan <?php echo e($peserta->user->name); ?></title>
    
    <!-- Google Fonts Inter untuk UI Bar -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @page { 
            size: A4; 
            margin: 15mm; 
        }
        * { box-sizing: border-box; }
        
        body { 
            margin: 0; 
            background-color: #f8fafc; 
            color: #0f172a; 
            font-family: "Times New Roman", Times, serif; 
            font-size: 11pt; 
            line-height: 1.4;
        }

        /* Sheet / Paper styling */
        .sheet { 
            max-width: 210mm; 
            margin: 20px auto; 
            background: #ffffff; 
            padding: 15mm 20mm; 
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.08); 
            border-radius: 8px;
        }

        /* Kop Surat Formal */
        .kop-surat {
            display: flex;
            align-items: center;
            gap: 18px;
            border-bottom: 4px double #000000;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }
        .kop-surat img {
            height: 70px;
            width: auto;
            object-fit: contain;
        }
        .kop-text {
            flex: 1;
            text-align: center;
        }
        .kop-text h1 {
            margin: 0;
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kop-text h2 {
            margin: 2px 0 0;
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .kop-text p {
            margin: 3px 0 0;
            font-size: 9.5pt;
            font-style: italic;
            color: #333;
        }

        /* Judul Laporan */
        .judul-laporan {
            text-align: center;
            margin: 16px 0 14px;
        }
        .judul-laporan h3 {
            margin: 0;
            font-size: 12.5pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            letter-spacing: 0.5px;
        }
        .judul-laporan p {
            margin: 3px 0 0;
            font-size: 10pt;
        }

        /* Identitas Table */
        table.identitas {
            width: 100%;
            margin-bottom: 16px;
            font-size: 10.5pt;
            border-collapse: collapse;
        }
        table.identitas td {
            padding: 2px 4px 2px 0;
            vertical-align: top;
        }

        /* Table Logbook */
        table.logbook { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        table.logbook th, table.logbook td { 
            border: 1px solid #000000; 
            padding: 6px 8px; 
            vertical-align: top; 
            font-size: 10pt; 
        }
        table.logbook th { 
            background-color: #f1f5f9; 
            text-align: center; 
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9.5pt;
        }
        table.logbook thead { display: table-header-group; }
        table.logbook tr { page-break-inside: avoid; }
        table.logbook img { 
            width: 65px; 
            height: 65px; 
            object-fit: cover; 
            display: block; 
            margin: 0 auto; 
            border: 1px solid #ccc;
        }

        /* Tanda Tangan */
        .ttd-container { 
            display: flex; 
            justify-content: space-between; 
            margin-top: 36px; 
            page-break-inside: avoid; 
            font-size: 10.5pt;
        }
        .ttd-box { 
            width: 42%; 
            text-align: center; 
        }
        .ttd-space { 
            height: 65px; 
        }

        /* Print Override */
        @media print {
            body { 
                background: #ffffff; 
                font-size: 11pt;
            }
            .noprint { 
                display: none !important; 
            }
            .sheet { 
                margin: 0; 
                padding: 0; 
                max-width: none; 
                box-shadow: none; 
                border-radius: 0;
            }
        }
    </style>
</head>
<body class="antialiased">

<!-- Modern Filter Toolbar (Noprint) -->
<div class="noprint bg-white/90 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 px-4 py-3 shadow-sm font-['Inter'] text-sm">
    <div class="max-w-6xl mx-auto flex flex-wrap items-center justify-between gap-4">
        
        <!-- Filter Form -->
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <div class="flex items-center gap-1.5">
                <label for="dari" class="text-xs font-semibold text-slate-600">Dari:</label>
                <input type="date" id="dari" name="dari" value="<?php echo e($dari); ?>" 
                       class="text-xs border border-slate-300 rounded-lg px-2.5 py-1.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>

            <div class="flex items-center gap-1.5">
                <label for="sampai" class="text-xs font-semibold text-slate-600">Sampai:</label>
                <input type="date" id="sampai" name="sampai" value="<?php echo e($sampai); ?>" 
                       class="text-xs border border-slate-300 rounded-lg px-2.5 py-1.5 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>

            <div class="flex items-center gap-1.5">
                <label for="status" class="text-xs font-semibold text-slate-600">Status:</label>
                <select id="status" name="status" class="text-xs border border-slate-300 rounded-lg px-2.5 py-1.5 focus:ring-2 focus:ring-indigo-500 outline-none">
                    <?php $__currentLoopData = ['disetujui'=>'Disetujui','semua'=>'Semua','menunggu'=>'Menunggu','ditolak'=>'Ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($v); ?>" <?php if($status === $v): echo 'selected'; endif; ?>><?php echo e($t); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <button type="submit" class="inline-flex items-center gap-1.5 bg-slate-800 hover:bg-slate-900 text-white font-medium text-xs px-3.5 py-1.5 rounded-lg transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.447.894l-4 2A1 1 0 017 21v-7.586L2.293 6.707A1 1 0 012 6V4z"/></svg>
                <span>Filter</span>
            </button>
        </form>

        <!-- Action Buttons -->
        <div class="flex items-center gap-2">
            <a href="javascript:history.back()" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Kembali</span>
            </a>

            <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-1.5 rounded-lg shadow-sm transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak / PDF</span>
            </button>
        </div>

    </div>
</div>

<!-- Formal Report Sheet -->
<div class="sheet">
    
    <!-- Formal Header / Kop Surat -->
    <div class="kop-surat">
        <?php if(file_exists(public_path('images/logorsiapasutri4.jpg'))): ?>
            <img src="<?php echo e(asset('images/logorsiapasutri4.jpg')); ?>" alt="Logo RSIA Pasutri">
        <?php elseif($logo = \App\Models\Setting::logoUrl()): ?>
            <img src="<?php echo e($logo); ?>" alt="Logo Instansi">
        <?php endif; ?>
        <div class="kop-text">
            <h1><?php echo e(\App\Models\Setting::ambil('nama_rs')); ?></h1>
            <h2>Laporan Kegiatan Peserta Magang</h2>
            <p>Dokumen Resmi Evaluasi & Catatan Logbook Harian Peserta</p>
        </div>
    </div>

    <!-- Title Section -->
    <div class="judul-laporan">
        <h3>LOGBOOK KEGIATAN MAGANG</h3>
        <p>Periode Tanggal: <?php echo e(\Carbon\Carbon::parse($dari)->translatedFormat('d F Y')); ?> s.d. <?php echo e(\Carbon\Carbon::parse($sampai)->translatedFormat('d F Y')); ?></p>
    </div>

    <!-- Student Information Table -->
    <table class="identitas">
        <tr>
            <td style="width: 180px;">Nama Peserta</td>
            <td style="width: 10px;">:</td>
            <td><strong><?php echo e($peserta->user->name); ?></strong></td>
        </tr>
        <tr>
            <td>Instansi / Kampus</td>
            <td>:</td>
            <td><?php echo e($peserta->instansi); ?></td>
        </tr>
        <?php if($peserta->jurusan): ?>
            <tr>
                <td>Program Studi / Jurusan</td>
                <td>:</td>
                <td><?php echo e($peserta->jurusan); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td>Periode Magang</td>
            <td>:</td>
            <td><?php echo e($peserta->tgl_mulai->translatedFormat('d F Y')); ?> s.d. <?php echo e($peserta->tgl_selesai->translatedFormat('d F Y')); ?></td>
        </tr>
        <tr>
            <td>Pembimbing Lapangan</td>
            <td>:</td>
            <td><?php echo e($peserta->pembimbing->name ?? '-'); ?></td>
        </tr>
        <tr>
            <td>Total Catatan Laporan</td>
            <td>:</td>
            <td><?php echo e($logbooks->count()); ?> Kegiatan <?php echo e($status !== 'semua' ? '(Filter Status: '.ucfirst($status).')' : ''); ?></td>
        </tr>
    </table>

    <!-- Main Activity Table -->
    <table class="logbook">
        <thead>
            <tr>
                <th style="width: 32px">No</th>
                <th style="width: 85px">Tanggal</th>
                <th>Deskripsi Kegiatan</th>
                <th style="width: 25%">Keterangan / Hasil</th>
                <th style="width: 75px">Foto</th>
                <th style="width: 70px">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $logbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td style="text-align: center"><?php echo e($i + 1); ?></td>
                <td style="text-align: center"><?php echo e($l->tanggal->translatedFormat('d/m/Y')); ?></td>
                <td style="white-space: pre-line; text-align: justify;"><?php echo e($l->kegiatan); ?></td>
                <td style="white-space: pre-line; text-align: justify;"><?php echo e($l->keterangan ?: '-'); ?></td>
                <td>
                    <?php if($l->foto_url): ?>
                        <img src="<?php echo e($l->foto_url); ?>" alt="Dokumentasi">
                    <?php else: ?> 
                        <span style="display: block; text-align: center; color: #777;">-</span>
                    <?php endif; ?>
                </td>
                <td style="text-align: center; font-weight: 500;"><?php echo e(ucfirst($l->status)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px; font-style: italic; color: #555;">
                    Tidak ada catatan kegiatan pada periode filter ini.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Signatures Section -->
    <div class="ttd-container">
        <div class="ttd-box">
            <div>Mengetahui,<br><strong>Peserta Magang</strong></div>
            <div class="ttd-space"></div>
            <div><u><strong><?php echo e($peserta->user->name); ?></strong></u></div>
        </div>
        <div class="ttd-box">
            <div><?php echo e(\App\Models\Setting::ambil('nama_rs')); ?>, <?php echo e(now()->translatedFormat('d F Y')); ?><br><strong>Pembimbing Lapangan</strong></div>
            <div class="ttd-space"></div>
            <div><u><strong><?php echo e($peserta->pembimbing->name ?? '..........................................'); ?></strong></u></div>
        </div>
    </div>

</div>

</body>
</html><?php /**PATH E:\DOSEN\UNBIN\Magang\2026\program_jhosse\monitoring-magang\monitoring-magang-laravel11\resources\views/cetak/logbook.blade.php ENDPATH**/ ?>