<?php
namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\{Logbook, Peserta};
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function dashboard()
    {
        $pesertas = auth()->user()->bimbingan()
            ->with('user')
            ->withCount([
                'logbooks as total_kegiatan',
                'logbooks as logbook_menunggu' => fn ($q) => $q->where('status', 'menunggu'),
            ])->get();

        return view('pembimbing.dashboard', compact('pesertas'));
    }

    public function show(Peserta $peserta)
    {
        $this->authorizePeserta($peserta);
        $peserta->load(['user', 'penilaian']);

        return view('pembimbing.show', [
            'peserta'  => $peserta,
            'logbooks' => $peserta->logbooks()->latest('tanggal')->latest('id')->get(),
        ]);
    }

    public function reviewLogbook(Request $r, Logbook $logbook)
    {
        $this->authorizePeserta($logbook->peserta);
        $data = $r->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan_pembimbing' => 'nullable|string|max:500',
        ]);
        $logbook->update($data);
        return back()->with('ok', 'Laporan kegiatan diperbarui.');
    }

    public function nilai(Request $r, Peserta $peserta)
    {
        $this->authorizePeserta($peserta);
        $data = $r->validate([
            'disiplin' => 'required|integer|between:0,100',
            'kinerja'  => 'required|integer|between:0,100',
            'sikap'    => 'required|integer|between:0,100',
            'komentar' => 'nullable|string|max:1000',
        ]);
        $peserta->penilaian()->updateOrCreate(
            ['peserta_id' => $peserta->id],
            $data + ['pembimbing_id' => auth()->id()]
        );
        return back()->with('ok', 'Penilaian disimpan.');
    }

    private function authorizePeserta(Peserta $peserta): void
    {
        abort_unless($peserta->pembimbing_id === auth()->id(), 403);
    }
}
