<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Logbook extends Model
{
    protected $fillable = [
        'peserta_id', 'tanggal', 'nama', 'kegiatan', 'keterangan', 'foto',
        'status', 'catatan_pembimbing',
    ];
    protected $casts = ['tanggal' => 'date'];

    public function peserta() { return $this->belongsTo(Peserta::class); }

    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? Storage::disk('public')->url($this->foto) : null;
    }
}
