-- Database Monitoring Magang RSIA Pasutri (MySQL / MariaDB)
-- Impor lewat phpMyAdmin atau: mysql -u root -p < monitoring_magang.sql
-- Kata sandi akun demo: password  (WAJIB diganti sebelum dipakai sungguhan)

CREATE DATABASE IF NOT EXISTS monitoring_magang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE monitoring_magang;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS penilaians, logbooks, pesertas, settings, users, password_reset_tokens,
  sessions, cache, cache_locks, jobs, job_batches, failed_jobs, migrations;
SET FOREIGN_KEY_CHECKS = 1;

-- ---------- Tabel bawaan Laravel ----------
CREATE TABLE users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  email_verified_at TIMESTAMP NULL DEFAULT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','pembimbing','peserta') NOT NULL DEFAULT 'peserta',
  remember_token VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE password_reset_tokens (
  email VARCHAR(255) NOT NULL,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE sessions (
  id VARCHAR(255) NOT NULL,
  user_id BIGINT UNSIGNED DEFAULT NULL,
  ip_address VARCHAR(45) DEFAULT NULL,
  user_agent TEXT,
  payload LONGTEXT NOT NULL,
  last_activity INT NOT NULL,
  PRIMARY KEY (id),
  KEY sessions_user_id_index (user_id),
  KEY sessions_last_activity_index (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE cache (
  `key` VARCHAR(255) NOT NULL,
  value MEDIUMTEXT NOT NULL,
  expiration INT NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE cache_locks (
  `key` VARCHAR(255) NOT NULL,
  owner VARCHAR(255) NOT NULL,
  expiration INT NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE jobs (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  queue VARCHAR(255) NOT NULL,
  payload LONGTEXT NOT NULL,
  attempts TINYINT UNSIGNED NOT NULL,
  reserved_at INT UNSIGNED DEFAULT NULL,
  available_at INT UNSIGNED NOT NULL,
  created_at INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  KEY jobs_queue_index (queue)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE job_batches (
  id VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  total_jobs INT NOT NULL,
  pending_jobs INT NOT NULL,
  failed_jobs INT NOT NULL,
  failed_job_ids LONGTEXT NOT NULL,
  options MEDIUMTEXT,
  cancelled_at INT DEFAULT NULL,
  created_at INT NOT NULL,
  finished_at INT DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE failed_jobs (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  uuid VARCHAR(255) NOT NULL,
  connection TEXT NOT NULL,
  queue TEXT NOT NULL,
  payload LONGTEXT NOT NULL,
  exception LONGTEXT NOT NULL,
  failed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY failed_jobs_uuid_unique (uuid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------- Tabel aplikasi ----------
CREATE TABLE pesertas (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id BIGINT UNSIGNED NOT NULL,
  pembimbing_id BIGINT UNSIGNED DEFAULT NULL,
  instansi VARCHAR(255) NOT NULL,
  jurusan VARCHAR(255) DEFAULT NULL,
  tgl_mulai DATE NOT NULL,
  tgl_selesai DATE NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT pesertas_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT pesertas_pembimbing_id_foreign FOREIGN KEY (pembimbing_id) REFERENCES users (id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE logbooks (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  peserta_id BIGINT UNSIGNED NOT NULL,
  tanggal DATE NOT NULL,
  nama VARCHAR(255) NOT NULL,
  kegiatan TEXT NOT NULL,
  keterangan TEXT,
  foto VARCHAR(255) DEFAULT NULL,
  status ENUM('menunggu','disetujui','ditolak') NOT NULL DEFAULT 'menunggu',
  catatan_pembimbing TEXT,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY logbooks_peserta_tanggal_index (peserta_id, tanggal),
  CONSTRAINT logbooks_peserta_id_foreign FOREIGN KEY (peserta_id) REFERENCES pesertas (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE penilaians (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  peserta_id BIGINT UNSIGNED NOT NULL,
  pembimbing_id BIGINT UNSIGNED NOT NULL,
  disiplin TINYINT UNSIGNED NOT NULL,
  kinerja TINYINT UNSIGNED NOT NULL,
  sikap TINYINT UNSIGNED NOT NULL,
  komentar TEXT,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY penilaians_peserta_id_unique (peserta_id),
  CONSTRAINT penilaians_peserta_id_foreign FOREIGN KEY (peserta_id) REFERENCES pesertas (id) ON DELETE CASCADE,
  CONSTRAINT penilaians_pembimbing_id_foreign FOREIGN KEY (pembimbing_id) REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE settings (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(255) NOT NULL,
  value TEXT,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY settings_key_unique (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Daftar migration: agar "php artisan migrate" tidak membuat ulang tabel di atas
CREATE TABLE migrations (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  migration VARCHAR(255) NOT NULL,
  batch INT NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations (migration, batch) VALUES
 ('0001_01_01_000000_create_users_table', 1),
 ('0001_01_01_000001_create_cache_table', 1),
 ('0001_01_01_000002_create_jobs_table', 1),
 ('2025_01_01_000001_add_role_to_users_table', 1),
 ('2025_01_01_000002_create_magang_tables', 1),
 ('2025_01_01_000003_create_settings_table', 1);

-- ---------- Data awal (akun demo) ----------
INSERT INTO users (id, name, email, password, role, created_at, updated_at) VALUES
 (1, 'Admin',        'admin@magang.test',      '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin',      NOW(), NOW()),
 (2, 'Budi Santoso', 'pembimbing@magang.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pembimbing', NOW(), NOW()),
 (3, 'Siti Rahma',   'peserta@magang.test',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'peserta',    NOW(), NOW());

INSERT INTO pesertas (id, user_id, pembimbing_id, instansi, jurusan, tgl_mulai, tgl_selesai, created_at, updated_at) VALUES
 (1, 3, 2, 'Universitas Pamulang', 'Teknik Informatika', '2026-10-01', '2026-12-31', NOW(), NOW());

INSERT INTO logbooks (peserta_id, tanggal, nama, kegiatan, keterangan, status, catatan_pembimbing, created_at, updated_at) VALUES
 (1, '2026-10-06', 'Siti Rahma', 'Mempelajari struktur database dan merancang ERD.', NULL, 'disetujui', 'Bagus, lanjutkan ke migrasi.', NOW(), NOW()),
 (1, '2026-10-07', 'Siti Rahma', 'Membuat halaman login dan validasi form pada modul laporan.', 'Validasi foto masih diuji.', 'menunggu', NULL, NOW(), NOW());

INSERT INTO settings (`key`, value, created_at, updated_at) VALUES
 ('nama_rs', 'RSIA Pasutri', NOW(), NOW()),
 ('maks_foto_kb', '2048', NOW(), NOW()),
 ('batas_hari_laporan', '7', NOW(), NOW()),
 ('terima_laporan', '1', NOW(), NOW());
