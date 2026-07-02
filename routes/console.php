<?php

use App\Models\Pesan;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('pesan:cleanup', function () {
    $deleted = Pesan::where('tanggal', '<', now()->subDays(14))->delete();

    $this->info("Pesan lama yang dihapus: {$deleted}");
})->describe('Hapus pesan yang sudah lebih dari 14 hari');

Schedule::command('pesan:cleanup')->daily();
