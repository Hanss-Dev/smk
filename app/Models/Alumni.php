<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'nama_alumni',
        'jurusan_alumni',
        'image',
        'nama_pekerjaan',
        'nama_perusahaan'
    ];
}
