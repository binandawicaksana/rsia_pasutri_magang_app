<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['password' => 'hashed'];

    public function isAdmin(): bool      { return $this->role === 'admin'; }
    public function isPembimbing(): bool { return $this->role === 'pembimbing'; }
    public function isPeserta(): bool    { return $this->role === 'peserta'; }

    /** Profil magang (khusus role peserta) */
    public function peserta() { return $this->hasOne(Peserta::class); }

    /** Daftar peserta yang dibimbing (khusus role pembimbing) */
    public function bimbingan() { return $this->hasMany(Peserta::class, 'pembimbing_id'); }
}
