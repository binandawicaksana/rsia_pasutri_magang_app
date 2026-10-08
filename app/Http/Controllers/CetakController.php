<?php
namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    /**
     * Halaman logbook siap cetak (A4). Dibuka dari tombol "Cetak" lalu Ctrl+P
     * atau tombol Cetak di halaman; di dialog cetak pilih "Simpan sebagai PDF"
     * kalau ingin berkas PDF.
     */
    public function logbook(Request $r, Peserta $peserta)
    {
        $u = auth()->user();

        // Admin: semua peserta. Pembimbing: hanya bimbingannya. Peserta: hanya miliknya.
        abort_unless(
            $u->isAdmin()
            || ($u->isPembimbing() && $peserta->pembimbing_id === $u->id)
            || ($u->isPeserta() && $peserta->user_id === $u->id),
            403
        );

        $f = $r->validate([
            'dari'   => 'nullable|date',
            'sampai' => 'nullable|date|after_or_equal:dari',
            'status' => 'nullable|in:semua,disetujui,menunggu,ditolak',
        ]);
        $status = $f['status'] ?? 'disetujui'; // bawaan: hanya yang sudah disetujui

        $logbooks = $peserta->logbooks()
            ->when($status !== 'semua', fn ($q) => $q->where('status', $status))
            ->when($f['dari'] ?? null, fn ($q, $d) => $q->whereDate('tanggal', '>=', $d))
            ->when($f['sampai'] ?? null, fn ($q, $d) => $q->whereDate('tanggal', '<=', $d))
            ->orderBy('tanggal')->orderBy('id')
            ->get();

        return view('cetak.logbook', [
            'peserta'  => $peserta->load('user', 'pembimbing'),
            'logbooks' => $logbooks,
            'status'   => $status,
            'dari'     => $f['dari'] ?? null,
            'sampai'   => $f['sampai'] ?? null,
        ]);
    }
}
