@extends('layouts.app', ['title' => 'Dashboard Pembimbing'])
@section('content')
<h1 class="text-xl font-semibold">Peserta bimbingan Anda</h1>
<div class="grid md:grid-cols-3 gap-4">
    @forelse($pesertas as $p)
        <a href="{{ route('pembimbing.show', $p) }}" class="bg-white rounded-lg border p-4 hover:border-slate-400">
            <div class="font-medium">{{ $p->user->name }}</div>
            <div class="text-sm text-slate-500">{{ $p->instansi }}</div>
            <div class="mt-3 flex gap-4 text-sm">
                <span>Laporan: <b>{{ $p->total_kegiatan }}</b></span>
                <span class="{{ $p->logbook_menunggu ? 'text-amber-600' : '' }}">Perlu ditinjau: <b>{{ $p->logbook_menunggu }}</b></span>
            </div>
        </a>
    @empty
        <p class="text-slate-500">Belum ada peserta yang ditugaskan kepada Anda. Hubungi admin.</p>
    @endforelse
</div>
@endsection
