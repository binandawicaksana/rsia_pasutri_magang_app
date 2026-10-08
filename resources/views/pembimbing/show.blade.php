@extends('layouts.app', ['title' => $peserta->user->name])
@section('content')
<a href="{{ route('pembimbing.dashboard') }}" class="text-sm text-slate-500 hover:underline">← Kembali</a>
<div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">{{ $peserta->user->name }} <span class="text-sm font-normal text-slate-500">{{ $peserta->instansi }}</span></h1>
    <a href="{{ route('cetak.logbook', $peserta) }}" target="_blank" class="rounded border px-3 py-1 text-sm hover:bg-slate-100">Cetak logbook</a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    <section class="md:col-span-2 space-y-3">
        <h2 class="font-semibold">Laporan kegiatan</h2>
        @forelse($logbooks as $l)
            <div class="bg-white rounded-lg border p-4">
                <div class="flex gap-4">
                    @if($l->foto_url)
                        <a href="{{ $l->foto_url }}" target="_blank"><img src="{{ $l->foto_url }}" alt="Foto kegiatan" class="w-28 h-28 object-cover rounded"></a>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between text-sm">
                            <b>{{ $l->tanggal->translatedFormat('l, d F Y') }} · {{ $l->nama }}</b>
                            <span class="rounded px-2 {{ ['menunggu'=>'bg-amber-100','disetujui'=>'bg-green-100','ditolak'=>'bg-red-100'][$l->status] }}">{{ $l->status }}</span>
                        </div>
                        <p class="mt-1 text-sm whitespace-pre-line">{{ $l->kegiatan }}</p>
                        @if($l->keterangan)<p class="mt-1 text-xs text-slate-500">Keterangan: {{ $l->keterangan }}</p>@endif
                        @if($l->catatan_pembimbing)<p class="mt-1 text-xs text-slate-500">Catatan Anda: {{ $l->catatan_pembimbing }}</p>@endif
                    </div>
                </div>
                @if($l->status === 'menunggu')
                <form method="POST" action="{{ route('pembimbing.logbook.review', $l) }}" class="mt-3 flex gap-2">
                    @csrf @method('PATCH')
                    <input name="catatan_pembimbing" placeholder="Catatan (opsional)" class="flex-1 border rounded px-2 py-1 text-sm">
                    <button name="status" value="disetujui" class="rounded bg-green-600 text-white px-3 text-sm">Setujui</button>
                    <button name="status" value="ditolak" class="rounded bg-red-600 text-white px-3 text-sm">Tolak</button>
                </form>
                @endif
            </div>
        @empty
            <p class="text-slate-500 text-sm">Peserta belum mengirim laporan kegiatan.</p>
        @endforelse
    </section>

    <aside>
        <form method="POST" action="{{ route('pembimbing.nilai', $peserta) }}" class="bg-white rounded-lg border p-4 space-y-2">
            @csrf
            <h2 class="font-semibold">Penilaian akhir</h2>
            @foreach(['disiplin'=>'Disiplin','kinerja'=>'Kinerja','sikap'=>'Sikap'] as $k=>$label)
                <label class="block text-sm">{{ $label }} (0–100)
                    <input type="number" min="0" max="100" name="{{ $k }}" value="{{ old($k, $peserta->penilaian->$k ?? '') }}" class="mt-1 w-full border rounded px-2 py-1">
                </label>
            @endforeach
            <textarea name="komentar" rows="3" placeholder="Komentar" class="w-full border rounded px-2 py-1 text-sm">{{ old('komentar', $peserta->penilaian->komentar ?? '') }}</textarea>
            <button class="rounded bg-slate-800 text-white px-4 py-2 text-sm">Simpan penilaian</button>
        </form>
    </aside>
</div>
@endsection
