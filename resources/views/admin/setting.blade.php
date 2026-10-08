@extends('layouts.app', ['title' => 'Pengaturan'])
@section('content')
<h1 class="text-xl font-semibold">Pengaturan</h1>

<form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data"
      class="bg-white rounded-lg border p-5 space-y-5 max-w-xl">
    @csrf @method('PUT')

    <div class="space-y-3">
        <h2 class="font-semibold">Identitas</h2>
        <label class="block text-sm">Nama rumah sakit
            <input type="text" name="nama_rs" value="{{ old('nama_rs', $nama_rs) }}" class="mt-1 w-full border rounded px-2 py-1">
        </label>
        <div class="text-sm">
            Logo
            <div class="mt-1 flex items-center gap-3">
                @if($logoUrl)<img src="{{ $logoUrl }}" alt="Logo" class="h-12 w-12 object-contain border rounded">@endif
                <input type="file" name="logo" accept="image/*" class="text-sm">
            </div>
            <span class="text-xs text-slate-500">PNG, JPG, atau WebP. Maksimal 1 MB.</span>
            @if($logoUrl)
                <label class="mt-1 flex items-center gap-2 text-xs"><input type="checkbox" name="hapus_logo" value="1"> Hapus logo saat ini</label>
            @endif
        </div>
    </div>

    <div class="space-y-3 border-t pt-4">
        <h2 class="font-semibold">Laporan kegiatan peserta</h2>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="terima_laporan" value="1" @checked(old('terima_laporan', $terima_laporan))>
            Peserta boleh mengirim laporan baru
        </label>
        <label class="block text-sm">Batas mundur tanggal laporan (hari)
            <input type="number" min="0" max="60" name="batas_hari_laporan" value="{{ old('batas_hari_laporan', $batas_hari_laporan) }}" class="mt-1 w-32 border rounded px-2 py-1">
            <span class="block text-xs text-slate-500">0 = hanya boleh tanggal hari ini.</span>
        </label>
        <label class="block text-sm">Ukuran maksimal foto (KB)
            <input type="number" min="256" max="10240" name="maks_foto_kb" value="{{ old('maks_foto_kb', $maks_foto_kb) }}" class="mt-1 w-32 border rounded px-2 py-1">
            <span class="block text-xs text-slate-500">2048 KB = 2 MB.</span>
        </label>
    </div>

    <button class="rounded bg-slate-800 text-white px-4 py-2 text-sm">Simpan pengaturan</button>
</form>
@endsection
