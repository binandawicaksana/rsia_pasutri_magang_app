<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Logbook, Peserta, User};
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalPeserta'    => Peserta::count(),
            'totalPembimbing' => User::where('role', 'pembimbing')->count(),
            'logbookMenunggu' => Logbook::where('status', 'menunggu')->count(),
            'tanpaPembimbing' => Peserta::whereNull('pembimbing_id')->count(),
            'pesertas'        => Peserta::with(['user', 'pembimbing'])->withCount('logbooks')->latest()->get(),
            'pembimbings'     => User::where('role', 'pembimbing')->get(),
        ]);
    }

    public function storePeserta(Request $r)
    {
        $data = $r->validate([
            'name'          => 'required|string|max:100',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
            'instansi'      => 'required|string|max:150',
            'jurusan'       => 'nullable|string|max:100',
            'tgl_mulai'     => 'required|date',
            'tgl_selesai'   => 'required|date|after:tgl_mulai',
            'pembimbing_id' => 'nullable|exists:users,id',
        ]);

        $user = User::create([
            'name' => $data['name'], 'email' => $data['email'],
            'password' => $data['password'], 'role' => 'peserta',
        ]);
        $user->peserta()->create($r->only('instansi', 'jurusan', 'tgl_mulai', 'tgl_selesai', 'pembimbing_id'));

        return back()->with('ok', 'Peserta magang ditambahkan.');
    }

    public function storePembimbing(Request $r)
    {
        $data = $r->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        User::create($data + ['role' => 'pembimbing']);
        return back()->with('ok', 'Pembimbing lapangan ditambahkan.');
    }

    public function assign(Request $r, Peserta $peserta)
    {
        $r->validate(['pembimbing_id' => 'required|exists:users,id']);
        $peserta->update(['pembimbing_id' => $r->pembimbing_id]);
        return back()->with('ok', 'Pembimbing ditetapkan.');
    }

    public function destroyPeserta(Peserta $peserta)
    {
        $peserta->user()->delete(); // cascade ke data peserta
        return back()->with('ok', 'Peserta dihapus.');
    }
}
