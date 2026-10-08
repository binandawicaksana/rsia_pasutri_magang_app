<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pesertas', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->foreignId('pembimbing_id')->nullable()->constrained('users')->nullOnDelete();
            $t->string('instansi');
            $t->string('jurusan')->nullable();
            $t->date('tgl_mulai');
            $t->date('tgl_selesai');
            $t->timestamps();
        });

        // Laporan kegiatan harian yang diinput peserta
        Schema::create('logbooks', function (Blueprint $t) {
            $t->id();
            $t->foreignId('peserta_id')->constrained()->cascadeOnDelete();
            $t->date('tanggal');
            $t->string('nama');
            $t->text('kegiatan');
            $t->text('keterangan')->nullable();
            $t->string('foto')->nullable();
            // diisi pembimbing
            $t->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $t->text('catatan_pembimbing')->nullable();
            $t->timestamps();
        });

        Schema::create('penilaians', function (Blueprint $t) {
            $t->id();
            $t->foreignId('peserta_id')->unique()->constrained()->cascadeOnDelete();
            $t->foreignId('pembimbing_id')->constrained('users');
            $t->unsignedTinyInteger('disiplin');
            $t->unsignedTinyInteger('kinerja');
            $t->unsignedTinyInteger('sikap');
            $t->text('komentar')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
        Schema::dropIfExists('logbooks');
        Schema::dropIfExists('pesertas');
    }
};
