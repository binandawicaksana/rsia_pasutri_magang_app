<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /** Nilai bawaan bila belum pernah diatur admin */
    public const DEFAULTS = [
        'nama_rs'            => 'RSIA Pasutri',
        'logo'               => null,
        'maks_foto_kb'       => 2048,
        'batas_hari_laporan' => 7,
        'terima_laporan'     => 1,
    ];

    private static function semua(): array
    {
        return Cache::rememberForever('app_settings', fn () => static::pluck('value', 'key')->all());
    }

    public static function ambil(string $key)
    {
        return static::semua()[$key] ?? static::DEFAULTS[$key] ?? null;
    }

    public static function simpan(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('app_settings');
    }

    public static function logoUrl(): ?string
    {
        $logo = static::ambil('logo');
        return $logo ? Storage::disk('public')->url($logo) : null;
    }
}
