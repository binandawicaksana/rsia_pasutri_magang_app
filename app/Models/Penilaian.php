<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $fillable = ['peserta_id', 'pembimbing_id', 'disiplin', 'kinerja', 'sikap', 'komentar'];

    public function peserta() { return $this->belongsTo(Peserta::class); }

    public function getRataRataAttribute(): float
    {
        return round(($this->disiplin + $this->kinerja + $this->sikap) / 3, 1);
    }
}
