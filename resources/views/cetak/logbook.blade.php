<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Logbook {{ $peserta->user->name }}</title>
<style>
    @page { size: A4; margin: 15mm; }
    * { box-sizing: border-box; }
    body { margin: 0; background: #f1f5f9; color: #000; font-family: "Times New Roman", Times, serif; font-size: 11.5pt; }
    .bar { background: #fff; border-bottom: 1px solid #cbd5e1; padding: 10px 16px; font-family: system-ui, sans-serif; font-size: 13px;
           display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
    .bar label { display: flex; gap: 4px; align-items: center; }
    .bar input, .bar select { border: 1px solid #cbd5e1; border-radius: 4px; padding: 3px 6px; font-size: 13px; }
    .bar button, .bar a.btn { border: 0; border-radius: 4px; padding: 6px 12px; font-size: 13px; cursor: pointer; text-decoration: none;
           background: #1e293b; color: #fff; }
    .bar a.btn.light { background: #e2e8f0; color: #1e293b; }
    .sheet { max-width: 210mm; margin: 16px auto; background: #fff; padding: 15mm; box-shadow: 0 1px 4px rgba(0,0,0,.15); }
    .kop { display: flex; align-items: center; gap: 14px; border-bottom: 3px double #000; padding-bottom: 8px; margin-bottom: 14px; }
    .kop img { height: 62px; width: auto; object-fit: contain; }
    .kop h1 { margin: 0; font-size: 16pt; text-transform: uppercase; }
    .kop p { margin: 2px 0 0; font-size: 11pt; }
    h2 { text-align: center; font-size: 13pt; margin: 0 0 10px; text-transform: uppercase; text-decoration: underline; }
    .id td { padding: 1px 6px 1px 0; vertical-align: top; }
    table.log { width: 100%; border-collapse: collapse; margin-top: 12px; }
    table.log th, table.log td { border: 1px solid #000; padding: 4px 6px; vertical-align: top; font-size: 10.5pt; }
    table.log th { background: #e5e7eb; text-align: center; }
    table.log thead { display: table-header-group; }
    table.log tr { page-break-inside: avoid; }
    table.log img { width: 70px; height: 70px; object-fit: cover; display: block; margin: 0 auto; }
    .ttd { display: flex; justify-content: space-between; margin-top: 28px; page-break-inside: avoid; }
    .ttd div { width: 44%; text-align: center; }
    .ttd .spasi { height: 70px; }
    .kosong { text-align: center; padding: 24px; font-style: italic; }
    @media print {
        body { background: #fff; }
        .noprint { display: none !important; }
        .sheet { margin: 0; padding: 0; max-width: none; box-shadow: none; }
    }
</style>
</head>
<body>

<form method="GET" class="bar noprint">
    <label>Dari <input type="date" name="dari" value="{{ $dari }}"></label>
    <label>Sampai <input type="date" name="sampai" value="{{ $sampai }}"></label>
    <label>Status
        <select name="status">
            @foreach(['disetujui'=>'Disetujui','semua'=>'Semua','menunggu'=>'Menunggu','ditolak'=>'Ditolak'] as $v => $t)
                <option value="{{ $v }}" @selected($status === $v)>{{ $t }}</option>
            @endforeach
        </select>
    </label>
    <button type="submit">Terapkan</button>
    <button type="button" onclick="window.print()">Cetak / Simpan PDF</button>
    <a class="btn light" href="javascript:history.back()">Kembali</a>
</form>

<div class="sheet">
    <div class="kop">
        @if($logo = \App\Models\Setting::logoUrl())<img src="{{ $logo }}" alt="">@endif
        <div>
            <h1>{{ \App\Models\Setting::ambil('nama_rs') }}</h1>
            <p>Laporan kegiatan peserta magang</p>
        </div>
    </div>

    <h2>Logbook kegiatan magang</h2>

    <table class="id">
        <tr><td>Nama</td><td>: {{ $peserta->user->name }}</td></tr>
        <tr><td>Instansi / kampus</td><td>: {{ $peserta->instansi }}</td></tr>
        @if($peserta->jurusan)<tr><td>Jurusan</td><td>: {{ $peserta->jurusan }}</td></tr>@endif
        <tr><td>Periode magang</td><td>: {{ $peserta->tgl_mulai->translatedFormat('d F Y') }} s.d. {{ $peserta->tgl_selesai->translatedFormat('d F Y') }}</td></tr>
        <tr><td>Pembimbing lapangan</td><td>: {{ $peserta->pembimbing->name ?? '-' }}</td></tr>
        <tr><td>Jumlah kegiatan</td><td>: {{ $logbooks->count() }}{{ $status !== 'semua' ? ' (status: '.$status.')' : '' }}</td></tr>
    </table>

    <table class="log">
        <thead>
            <tr><th style="width:28px">No</th><th style="width:78px">Tanggal</th><th>Kegiatan</th><th style="width:22%">Keterangan</th><th style="width:80px">Foto</th><th style="width:70px">Status</th></tr>
        </thead>
        <tbody>
        @forelse($logbooks as $i => $l)
            <tr>
                <td style="text-align:center">{{ $i + 1 }}</td>
                <td>{{ $l->tanggal->translatedFormat('d M Y') }}</td>
                <td style="white-space:pre-line">{{ $l->kegiatan }}</td>
                <td style="white-space:pre-line">{{ $l->keterangan ?: '-' }}</td>
                <td>@if($l->foto_url)<img src="{{ $l->foto_url }}" alt="Foto kegiatan">@else <span style="display:block;text-align:center">-</span>@endif</td>
                <td style="text-align:center">{{ ucfirst($l->status) }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="kosong">Tidak ada kegiatan untuk filter ini. Ubah status ke "Semua" bila laporan belum disetujui pembimbing.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="ttd">
        <div>
            <div>Peserta magang,</div>
            <div class="spasi"></div>
            <div><u>{{ $peserta->user->name }}</u></div>
        </div>
        <div>
            <div>{{ now()->translatedFormat('d F Y') }}<br>Pembimbing lapangan,</div>
            <div class="spasi"></div>
            <div><u>{{ $peserta->pembimbing->name ?? '..............................' }}</u></div>
        </div>
    </div>
</div>
</body>
</html>
