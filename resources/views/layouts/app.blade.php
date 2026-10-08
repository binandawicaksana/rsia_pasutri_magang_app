<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Monitoring Magang' }} · {{ \App\Models\Setting::ambil('nama_rs') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800">
<nav class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
        <span class="font-semibold flex items-center gap-2">
            @if($logo = \App\Models\Setting::logoUrl())<img src="{{ $logo }}" alt="" class="h-7 w-7 object-contain">@endif
            Monitoring Magang <span class="text-slate-500 font-normal">{{ \App\Models\Setting::ambil('nama_rs') }}</span>
            <span class="ml-2 text-xs rounded bg-slate-100 px-2 py-0.5">{{ ucfirst(auth()->user()->role) }}</span>
        </span>
        <div class="flex items-center gap-4 text-sm">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.setting.edit') }}" class="hover:underline">Pengaturan</a>
            @endif
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button class="text-red-600 hover:underline">Keluar</button>
            </form>
        </div>
    </div>
</nav>
<main class="max-w-6xl mx-auto px-4 py-6 space-y-6">
    @if(session('ok'))
        <div class="rounded bg-green-50 border border-green-200 text-green-800 px-4 py-2 text-sm">{{ session('ok') }}</div>
    @endif
    @if($errors->any())
        <div class="rounded bg-red-50 border border-red-200 text-red-800 px-4 py-2 text-sm">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>
