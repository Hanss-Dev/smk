<?php

use App\Models\Pesan;

describe('Pesan cleanup', function () {
    it('deletes pesan older than 14 days through cleanup command', function () {
        $oldPesan = Pesan::create([
            'nama' => 'Test Lama',
            'email' => 'lama@example.com',
            'telepon' => '081234567890',
            'pesan' => 'Pesan lama',
            'status' => 'read',
            'tanggal' => now()->subDays(15),
        ]);

        $recentPesan = Pesan::create([
            'nama' => 'Test Baru',
            'email' => 'baru@example.com',
            'telepon' => '081234567891',
            'pesan' => 'Pesan baru',
            'status' => 'unread',
            'tanggal' => now()->subDays(3),
        ]);

        $this->artisan('pesan:cleanup')->assertSuccessful();

        $this->assertDatabaseMissing('pesan', ['id' => $oldPesan->id]);
        $this->assertDatabaseHas('pesan', ['id' => $recentPesan->id]);
    });
});
