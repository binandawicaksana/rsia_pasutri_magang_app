<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@magang.test', 'password' => 'password', 'role' => 'admin']);

        $pb = User::create(['name' => 'Budi Santoso', 'email' => 'pembimbing@magang.test', 'password' => 'password', 'role' => 'pembimbing']);

        $ps = User::create(['name' => 'Siti Rahma', 'email' => 'peserta@magang.test', 'password' => 'password', 'role' => 'peserta']);
        $ps->peserta()->create([
            'pembimbing_id' => $pb->id, 'instansi' => 'Universitas Pamulang', 'jurusan' => 'Teknik Informatika',
            'tgl_mulai' => now()->startOfMonth(), 'tgl_selesai' => now()->addMonths(3)->endOfMonth(),
        ]);
    }
}
