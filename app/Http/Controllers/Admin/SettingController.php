<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        return view('admin.setting', [
            'nama_rs'            => Setting::ambil('nama_rs'),
            'logoUrl'            => Setting::logoUrl(),
            'maks_foto_kb'       => Setting::ambil('maks_foto_kb'),
            'batas_hari_laporan' => Setting::ambil('batas_hari_laporan'),
            'terima_laporan'     => (bool) Setting::ambil('terima_laporan'),
        ]);
    }

    public function update(Request $r)
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $data = $r->validate([
            'nama_rs'            => 'required|string|max:100',
            'logo'               => 'nullable|image|mimes:png,jpg,jpeg,webp|max:1024',
            'maks_foto_kb'       => 'required|integer|between:256,10240',
            'batas_hari_laporan' => 'required|integer|between:0,60',
        ]);

        Setting::simpan('nama_rs', $data['nama_rs']);
        Setting::simpan('maks_foto_kb', $data['maks_foto_kb']);
        Setting::simpan('batas_hari_laporan', $data['batas_hari_laporan']);
        Setting::simpan('terima_laporan', $r->boolean('terima_laporan') ? 1 : 0);

        // Logo: ganti atau hapus
        $lama = Setting::ambil('logo');
        if ($r->hasFile('logo')) {
            if ($lama) Storage::disk('public')->delete($lama);
            Setting::simpan('logo', $r->file('logo')->store('setting', 'public'));
        } elseif ($r->boolean('hapus_logo') && $lama) {
            Storage::disk('public')->delete($lama);
            Setting::simpan('logo', null);
        }

        return back()->with('ok', 'Pengaturan disimpan.');
    }
}
