<?php

namespace App\Http\Controllers;

use App\Models\ContentJurusan;

class JurusanController extends Controller
{
    private array $mappings = [
        'akuntansi'  => 'Akuntansi',
        'perhotelan' => 'Perhotelan',
        'tei'        => 'Teknik Elektronika Industri',
        'titl'       => 'Teknik Instalasi Tenaga Listrik',
        'tm'         => 'Teknik Mesin',
        'tkro'       => 'Teknik Kendaraan Ringan Otomotif',
        'tsm'        => 'Teknik Bisnis Sepeda Motor',
        'tki'        => 'Teknik Kimia Industri',
    ];

    public function show($name)
    {
        if (!isset($this->mappings[$name])) {
            abort(404);
        }

        $dbName = $this->mappings[$name];
        $contentRecords = ContentJurusan::where('jurusan', $dbName)->get();

        $galleryImages = [];
        foreach ($contentRecords as $record) {
            $images = is_string($record->content)
                ? json_decode($record->content, true)
                : ($record->content ?? []);

            if (is_array($images)) {
                $galleryImages = array_merge($galleryImages, $images);
            }
        }

        return view("jurusan.{$name}", compact('galleryImages'));
    }
}
