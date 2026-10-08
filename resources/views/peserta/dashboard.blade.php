@extends('layouts.app', ['title' => 'Dashboard Peserta'])
@section('content')
<div>
    <h1 class="text-xl font-semibold">Halo, {{ auth()->user()->name }}</h1>
    <p class="text-sm text-slate-500">
        Pembimbing: {{ $peserta->pembimbing->name ?? 'belum ditentukan' }} ·
        {{ $peserta->tgl_mulai->format('d M Y') }} – {{ $peserta->tgl_selesai->format('d M Y') }}
    </p>
    <a href="{{ route('cetak.logbook', $peserta) }}" target="_blank"
       class="mt-2 inline-block rounded border px-3 py-1 text-sm hover:bg-slate-100">Cetak logbook</a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    <form method="POST" action="{{ route('peserta.logbook.store') }}" enctype="multipart/form-data"
          class="bg-white rounded-lg border p-4 space-y-3 self-start">
        @csrf
        <h2 class="font-semibold">Laporan kegiatan</h2>

        <label class="block text-sm">Tanggal
            <input type="date" name="tanggal" value="{{ old('tanggal', today()->toDateString()) }}"
                   max="{{ today()->toDateString() }}" class="mt-1 w-full border rounded px-2 py-1">
        </label>
        <label class="block text-sm">Nama
            <input type="text" name="nama" value="{{ old('nama', auth()->user()->name) }}"
                   class="mt-1 w-full border rounded px-2 py-1">
        </label>
        <label class="block text-sm">Kegiatan
            <textarea name="kegiatan" rows="4" placeholder="Apa yang Anda kerjakan?"
                      class="mt-1 w-full border rounded px-2 py-1">{{ old('kegiatan') }}</textarea>
        </label>
        <label class="block text-sm">Keterangan
            <textarea name="keterangan" rows="2" placeholder="Kendala, hasil, atau catatan tambahan"
                      class="mt-1 w-full border rounded px-2 py-1">{{ old('keterangan') }}</textarea>
        </label>
        <label class="block text-sm">Foto kegiatan
            <input type="file" name="foto" accept="image/*" class="mt-1 w-full text-sm">
            <span class="text-xs text-slate-500">JPG, PNG, atau WebP. Maksimal {{ round(\App\Models\Setting::ambil('maks_foto_kb') / 1024, 1) }} MB.</span>
        </label>
        @unless(\App\Models\Setting::ambil('terima_laporan'))
            <p class="text-xs text-red-600">Pengiriman laporan sedang ditutup oleh admin.</p>
        @endunless
        <button class="rounded bg-slate-800 text-white px-4 py-2 text-sm disabled:opacity-50" @disabled(! \App\Models\Setting::ambil('terima_laporan'))>Kirim laporan</button>
    </form>

    <section class="md:col-span-2 space-y-3">
        <h2 class="font-semibold">Riwayat laporan</h2>
        @forelse($logbooks as $l)
            <div class="bg-white rounded-lg border p-4 flex gap-4">
                @if($l->foto_url)
                    <a href="{{ $l->foto_url }}" target="_blank"><img src="{{ $l->foto_url }}" alt="Foto kegiatan" class="w-24 h-24 object-cover rounded"></a>
                @endif
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between text-sm">
                        <b>{{ $l->tanggal->translatedFormat('d F Y') }} · {{ $l->nama }}</b>
                        <span class="rounded px-2 {{ ['menunggu'=>'bg-amber-100','disetujui'=>'bg-green-100','ditolak'=>'bg-red-100'][$l->status] }}">{{ $l->status }}</span>
                    </div>
                    <p class="mt-1 text-sm whitespace-pre-line">{{ $l->kegiatan }}</p>
                    @if($l->keterangan)<p class="mt-1 text-xs text-slate-500">Keterangan: {{ $l->keterangan }}</p>@endif
                    @if($l->catatan_pembimbing)<p class="mt-1 text-xs text-slate-500">Catatan pembimbing: {{ $l->catatan_pembimbing }}</p>@endif
                    @if($l->status !== 'disetujui')
                        <form method="POST" action="{{ route('peserta.logbook.destroy', $l) }}" class="mt-2" onsubmit="return confirm('Hapus laporan ini?')">
                            @csrf @method('DELETE')<button class="text-xs text-red-600 hover:underline">Hapus</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-sm text-slate-500">Belum ada laporan. Isi laporan kegiatan pertama Anda di formulir sebelah kiri.</p>
        @endforelse

        @if($peserta->penilaian)
            <div class="bg-white rounded-lg border p-4 text-sm">
                <h2 class="font-semibold mb-1">Nilai akhir: {{ $peserta->penilaian->rata_rata }}</h2>
                Disiplin {{ $peserta->penilaian->disiplin }} · Kinerja {{ $peserta->penilaian->kinerja }} · Sikap {{ $peserta->penilaian->sikap }}
                @if($peserta->penilaian->komentar)<p class="mt-1 text-slate-500">{{ $peserta->penilaian->komentar }}</p>@endif
            </div>
        @endif
    </section>
</div>
@endsection
