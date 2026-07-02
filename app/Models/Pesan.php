<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'pesan',
        'status',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function getDeleteInAttribute()
    {
        return $this->tanggal ? $this->tanggal->copy()->addDays(14) : null;
    }

    public function getRemainingTimeAttribute()
    {
        if (! $this->tanggal) {
            return null;
        }

        $deleteAt = $this->tanggal->copy()->addDays(14);
        $now = Carbon::now();

        if ($deleteAt->lte($now)) {
            return 'Sudah habis';
        }

        $diff = $deleteAt->diff($now);

        $parts = [];

        if ($diff->days > 0) {
            $parts[] = $diff->days . ' hari';
        }

        if ($diff->h > 0) {
            $parts[] = $diff->h . ' jam';
        }

        if ($diff->i > 0) {
            $parts[] = $diff->i . ' menit';
        }

        return 'Akan hilang dalam ' . implode(' ', $parts);
    }
}
