<?php
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Pembimbing\PembimbingController;
use App\Http\Controllers\Peserta\PesertaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/cetak/logbook/{peserta}', [CetakController::class, 'logbook'])->name('cetak.logbook');

    // ---- ADMIN ----
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/peserta', [AdminController::class, 'storePeserta'])->name('peserta.store');
        Route::post('/pembimbing', [AdminController::class, 'storePembimbing'])->name('pembimbing.store');
        Route::patch('/peserta/{peserta}/pembimbing', [AdminController::class, 'assign'])->name('peserta.assign');
        Route::delete('/peserta/{peserta}', [AdminController::class, 'destroyPeserta'])->name('peserta.destroy');
        Route::get('/pengaturan', [SettingController::class, 'edit'])->name('setting.edit');
        Route::put('/pengaturan', [SettingController::class, 'update'])->name('setting.update');
    });

    // ---- PEMBIMBING LAPANGAN ----
    Route::middleware('role:pembimbing')->prefix('pembimbing')->name('pembimbing.')->group(function () {
        Route::get('/', [PembimbingController::class, 'dashboard'])->name('dashboard');
        Route::get('/peserta/{peserta}', [PembimbingController::class, 'show'])->name('show');
        Route::patch('/logbook/{logbook}', [PembimbingController::class, 'reviewLogbook'])->name('logbook.review');
        Route::post('/peserta/{peserta}/nilai', [PembimbingController::class, 'nilai'])->name('nilai');
    });

    // ---- PESERTA MAGANG ----
    Route::middleware('role:peserta')->prefix('peserta')->name('peserta.')->group(function () {
        Route::get('/', [PesertaController::class, 'dashboard'])->name('dashboard');
        Route::post('/logbook', [PesertaController::class, 'storeLogbook'])->name('logbook.store');
        Route::delete('/logbook/{logbook}', [PesertaController::class, 'destroyLogbook'])->name('logbook.destroy');
    });
});

require __DIR__.'/auth.php'; // dari Laravel Breeze
