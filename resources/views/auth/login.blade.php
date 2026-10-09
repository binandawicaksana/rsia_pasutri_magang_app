<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk · Monitoring Magang {{ \App\Models\Setting::ambil('nama_rs') }}</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="min-h-full bg-slate-50 text-slate-800 flex items-center justify-center p-4 sm:p-6 relative overflow-x-hidden">

    <!-- Decorative Background Elements -->
    <div class="absolute -top-24 -left-20 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-20 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Header / Logo Section -->
        <div class="text-center mb-8">
            @if($logo = \App\Models\Setting::logoUrl())
                <div class="inline-flex items-center justify-center p-3 bg-white rounded-2xl shadow-sm border border-slate-100 mb-4">
                    <img src="{{ $logo }}" alt="Logo" class="h-12 w-auto object-contain">
                </div>
            @endif
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Monitoring Magang</h1>
            <p class="text-sm font-semibold text-indigo-600 mt-1">{{ \App\Models\Setting::ambil('nama_rs') }}</p>
            <p class="text-sm text-slate-500 mt-1">Selamat datang kembali! Silakan masuk ke akun Anda.</p>
        </div>

        <!-- Card Form -->
        <div class="bg-white/80 backdrop-blur-xl border border-slate-200/80 rounded-2xl shadow-xl shadow-slate-200/50 p-6 sm:p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Session Status -->
                @if(session('status'))
                    <div class="flex items-center gap-2 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 p-3.5 text-sm font-medium">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- Errors -->
                @if($errors->any())
                    <div class="flex items-center gap-2 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 p-3.5 text-sm font-medium">
                        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Email atau kata sandi salah. Coba lagi.</span>
                    </div>
                @endif

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           placeholder="nama@email.com"
                           class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Kata Sandi</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                           placeholder="••••••••"
                           class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2.5 text-sm font-medium text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 transition-all">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-medium py-2.5 px-4 text-sm shadow-lg shadow-slate-900/10 hover:shadow-slate-900/20 active:scale-[0.99] transition-all">
                    Masuk ke Akun
                </button>
            </form>
        </div>

        <!-- Footer Info -->
        <p class="text-xs text-slate-500 text-center mt-6">
            Belum punya akun? <span class="text-slate-700 font-medium">Hubungi admin untuk dibuatkan akun.</span>
        </p>

        <!-- Local Demo Accounts -->
        @if(app()->environment('local'))
            <div class="mt-6 rounded-2xl border border-amber-200/80 bg-amber-50/50 p-4 text-xs text-slate-600 space-y-2 backdrop-blur-sm">
                <div class="flex items-center gap-1.5 font-semibold text-amber-900">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Akun Demo (Kata Sandi: password)</span>
                </div>
                <div class="grid grid-cols-1 gap-1 text-slate-700 font-mono text-[11px] pt-1">
                    <div class="flex justify-between border-b border-amber-200/40 pb-1"><span>Admin:</span> <span class="font-bold">admin@magang.test</span></div>
                    <div class="flex justify-between border-b border-amber-200/40 py-1"><span>Pembimbing:</span> <span class="font-bold">pembimbing@magang.test</span></div>
                    <div class="flex justify-between pt-1"><span>Peserta:</span> <span class="font-bold">peserta@magang.test</span></div>
                </div>
            </div>
        @endif

    </div>

</body>
</html>