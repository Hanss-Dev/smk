<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keungulan extends Model
{
    protected $table = 'keunggulan';

    protected $fillable = [
        'nama_keunggulan',
        'image',
        'alt',
        'is_active',
    ];
}
