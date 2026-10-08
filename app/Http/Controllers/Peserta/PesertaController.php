<?php
namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\{Logbook, Setting};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    private function peserta()
    {
        return auth()->user()->peserta()->firstOrFail();
    }

    public function dashboard()
    {
        $peserta = $this->peserta()->load('pembimbing', 'penilaian');

        return view('peserta.dashboard', [
            'peserta'  => $peserta,
            'logbooks' => $peserta->logbooks()->latest('tanggal')->latest('id')->get(),
        ]);
    }

    /** Peserta hanya menginput: tanggal, nama, kegiatan, keterangan, foto */
    public function storeLogbook(Request $r)
    {
        if (! Setting::ambil('terima_laporan')) {
            return back()->withErrors('Pengiriman laporan sedang ditutup oleh admin.');
        }

        $batas = now()->subDays((int) Setting::ambil('batas_hari_laporan'))->toDateString();

        $data = $r->validate([
            'tanggal'    => 'required|date|before_or_equal:today|after_or_equal:'.$batas,
            'nama'       => 'required|string|max:100',
            'kegiatan'   => 'required|string|min:5',
            'keterangan' => 'nullable|string|max:500',
            'foto'       => 'required|image|mimes:jpg,jpeg,png,webp|max:'.(int) Setting::ambil('maks_foto_kb'),
        ]);

        $data['foto'] = $r->file('foto')->store('logbook', 'public');

        $this->peserta()->logbooks()->create($data);

        return back()->with('ok', 'Kegiatan dikirim ke pembimbing.');
    }

    /** Hanya boleh menghapus milik sendiri dan yang belum disetujui */
    public function destroyLogbook(Logbook $logbook)
    {
        abort_unless($logbook->peserta_id === $this->peserta()->id && $logbook->status !== 'disetujui', 403);

        if ($logbook->foto) {
            Storage::disk('public')->delete($logbook->foto);
        }
        $logbook->delete();

        return back()->with('ok', 'Kegiatan dihapus.');
    }
}
