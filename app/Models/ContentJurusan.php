<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentJurusan extends Model
{
     protected $table = 'content_kegiatan_jurusan';

     protected $fillable = [
        'jurusan',
        'content',
     ];

     protected $cast = [
        'content' => 'array'
     ];
}
