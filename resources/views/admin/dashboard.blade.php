@extends('layouts.app', ['title' => 'Dashboard Admin'])
@section('content')
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach([['Peserta magang',$totalPeserta],['Pembimbing',$totalPembimbing],['Laporan menunggu',$logbookMenunggu],['Belum ada pembimbing',$tanpaPembimbing]] as [$l,$v])
        <div class="bg-white rounded-lg border p-4"><div class="text-2xl font-semibold">{{ $v }}</div><div class="text-sm text-slate-500">{{ $l }}</div></div>
    @endforeach
</div>

<section class="bg-white rounded-lg border">
    <h2 class="px-4 py-3 font-semibold border-b">Daftar peserta magang</h2>
    <div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-left"><tr>
            <th class="p-3">Nama</th><th>Instansi</th><th>Periode</th><th>Laporan</th><th>Pembimbing</th><th></th>
        </tr></thead>
        <tbody>
        @forelse($pesertas as $p)
            <tr class="border-t">
                <td class="p-3">{{ $p->user->name }}<div class="text-xs text-slate-500">{{ $p->user->email }}</div></td>
                <td>{{ $p->instansi }}</td>
                <td>{{ $p->tgl_mulai->format('d M Y') }} – {{ $p->tgl_selesai->format('d M Y') }}</td>
                <td>{{ $p->logbooks_count }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.peserta.assign', $p) }}" class="flex gap-1">
                        @csrf @method('PATCH')
                        <select name="pembimbing_id" class="border rounded px-2 py-1">
                            <option value="">— pilih —</option>
                            @foreach($pembimbings as $pb)
                                <option value="{{ $pb->id }}" @selected($p->pembimbing_id === $pb->id)>{{ $pb->name }}</option>
                            @endforeach
                        </select>
                        <button class="rounded bg-slate-800 text-white px-2">Simpan</button>
                    </form>
                </td>
                <td class="pr-3 text-right whitespace-nowrap">
                    <a href="{{ route('cetak.logbook', $p) }}" target="_blank" class="mr-3 hover:underline">Cetak</a>
                    <form class="inline" method="POST" action="{{ route('admin.peserta.destroy', $p) }}" onsubmit="return confirm('Hapus peserta ini?')">
                        @csrf @method('DELETE')<button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="p-6 text-center text-slate-500">Belum ada peserta. Tambahkan lewat formulir di bawah.</td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
</section>

<div class="grid md:grid-cols-2 gap-6">
    <form method="POST" action="{{ route('admin.peserta.store') }}" class="bg-white rounded-lg border p-4 space-y-2">
        @csrf
        <h2 class="font-semibold">Tambah peserta magang</h2>
        @foreach([['name','Nama','text'],['email','Email','email'],['password','Kata sandi','password'],['instansi','Instansi / kampus','text'],['jurusan','Jurusan','text'],['tgl_mulai','Tanggal mulai','date'],['tgl_selesai','Tanggal selesai','date']] as [$n,$l,$t])
            <label class="block text-sm">{{ $l }}
                <input type="{{ $t }}" name="{{ $n }}" value="{{ $t==='password' ? '' : old($n) }}" class="mt-1 w-full border rounded px-2 py-1">
            </label>
        @endforeach
        <label class="block text-sm">Pembimbing lapangan
            <select name="pembimbing_id" class="mt-1 w-full border rounded px-2 py-1">
                <option value="">— belum ditentukan —</option>
                @foreach($pembimbings as $pb)<option value="{{ $pb->id }}">{{ $pb->name }}</option>@endforeach
            </select>
        </label>
        <button class="rounded bg-slate-800 text-white px-4 py-2 text-sm">Tambah peserta</button>
    </form>

    <form method="POST" action="{{ route('admin.pembimbing.store') }}" class="bg-white rounded-lg border p-4 space-y-2 self-start">
        @csrf
        <h2 class="font-semibold">Tambah pembimbing lapangan</h2>
        @foreach([['name','Nama','text'],['email','Email','email'],['password','Kata sandi','password']] as [$n,$l,$t])
            <label class="block text-sm">{{ $l }}
                <input type="{{ $t }}" name="{{ $n }}" class="mt-1 w-full border rounded px-2 py-1">
            </label>
        @endforeach
        <button class="rounded bg-slate-800 text-white px-4 py-2 text-sm">Tambah pembimbing</button>
    </form>
</div>
@endsection
