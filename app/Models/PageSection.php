<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $table = 'page_sections';

    protected $fillable = [
        'page_key',
        'page_title',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    // ── Konstanta page_key ──────────────────────────────────────────────────
    const KEY_PODCAST       = 'podcast';
    const KEY_LAB           = 'lab-komputer';
    const KEY_SAFETY_RIDING = 'safety-riding';

    // ── Helper: ambil atau buat row untuk satu halaman ──────────────────────
    public static function forPage(string $key): self
    {
        return static::firstOrCreate(
            ['page_key' => $key],
            ['page_title' => ucfirst(str_replace('-', ' ', $key)), 'content' => []]
        );
    }

    // ── Helper: path folder storage berdasarkan page_key ───────────────────
    // Mengembalikan path relatif terhadap storage/app/public (disk 'public')
    public static function uploadFolder(string $key): string
    {
        $map = [
            self::KEY_PODCAST       => 'podcast',
            self::KEY_LAB           => 'lab-komputer',
            self::KEY_SAFETY_RIDING => 'safety-riding',
        ];
        return $map[$key] ?? $key;
    }

    // ── Helper: path public (untuk asset()) ────────────────────────────────
    public static function publicFolder(string $key): string
    {
        return 'storage/' . static::uploadFolder($key);
    }
}
