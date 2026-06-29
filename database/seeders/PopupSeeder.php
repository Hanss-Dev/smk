<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Popup;

class PopupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     Popup::create([
        'id' => 6,
        'title' => 'Menu Pendaftaran Online',
        'content' => 'Penerimaan Murid Baru TP. 2026/2027',
        'image' => '1769688794-brosur-ppdbb.jpeg',
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now(),
     ]);
    }
}
