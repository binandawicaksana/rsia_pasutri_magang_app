@extends('layouts.app', ['title' => 'Dashboard Pembimbing'])

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-indigo-50 text-indigo-600 rounded-2xl border border-indigo-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Peserta Bimbingan Anda</h1>
                <p class="text-sm text-slate-500">Pantau dan beri masukan pada laporan kegiatan peserta magang</p>
            </div>
        </div>
        
        <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
            Total: {{ $pesertas->count() }} Peserta
        </span>
    </div>

    <!-- Grid Cards Peserta -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($pesertas as $p)
            <a href="{{ route('pembimbing.show', $p) }}" 
               class="group bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md hover:border-indigo-300 transition-all duration-200 relative flex flex-col justify-between">
                
                <div class="space-y-3">
                    <!-- Top Info: Avatar & Name -->
                    <div class="flex items-start gap-3">
                        <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-700 font-bold flex items-center justify-center text-sm shrink-0 border border-indigo-100 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            {{ strtoupper(substr($p->user->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h2 class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors truncate">
                                {{ $p->user->name }}
                            </h2>
                            <p class="text-xs text-slate-500 flex items-center gap-1 mt-0.5 truncate">
                                <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span class="truncate">{{ $p->instansi }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-slate-100 pt-3"></div>

                    <!-- Stats Badges -->
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="bg-slate-50 border border-slate-100 p-2.5 rounded-xl">
                            <span class="text-slate-500 block mb-0.5">Total Laporan</span>
                            <span class="font-bold text-slate-800 text-sm flex items-center gap-1">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $p->total_kegiatan }}
                            </span>
                        </div>

                        <div class="p-2.5 rounded-xl border {{ $p->logbook_menunggu ? 'bg-amber-50/80 border-amber-200/80 text-amber-900' : 'bg-slate-50 border-slate-100 text-slate-700' }}">
                            <span class="{{ $p->logbook_menunggu ? 'text-amber-700 font-medium' : 'text-slate-500' }} block mb-0.5">Perlu Ditinjau</span>
                            <span class="font-bold text-sm flex items-center gap-1 {{ $p->logbook_menunggu ? 'text-amber-700' : 'text-slate-800' }}">
                                <svg class="w-4 h-4 {{ $p->logbook_menunggu ? 'text-amber-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $p->logbook_menunggu }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Footer Link Arrow -->
                <div class="mt-4 pt-3 border-t border-slate-100/80 flex items-center justify-between text-xs font-semibold text-indigo-600 group-hover:text-indigo-700">
                    <span>Lihat Logbook</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-slate-200/80 p-8 text-center">
                <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800">Belum Ada Peserta Bimbingan</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">Saat ini belum ada peserta magang yang ditugaskan kepada Anda. Silakan hubungi admin untuk informasi lebih lanjut.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection