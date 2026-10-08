<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = ['user_id', 'pembimbing_id', 'instansi', 'jurusan', 'tgl_mulai', 'tgl_selesai'];
    protected $casts = ['tgl_mulai' => 'date', 'tgl_selesai' => 'date'];

    public function user()       { return $this->belongsTo(User::class); }
    public function pembimbing() { return $this->belongsTo(User::class, 'pembimbing_id'); }
    public function logbooks()   { return $this->hasMany(Logbook::class); }
    public function penilaian()  { return $this->hasOne(Penilaian::class); }
}
