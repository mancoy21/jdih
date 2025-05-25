<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentType;
use App\Models\DocumentStatus;
use App\Models\MainEntryHeading;

class DocumentMasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Document Types
        $types = [
            ['type_name' => 'Peraturan Daerah', 'description' => 'Peraturan yang ditetapkan oleh DPRD'],
            ['type_name' => 'Peraturan Gubernur', 'description' => 'Peraturan yang ditetapkan oleh Gubernur'],
            ['type_name' => 'Peraturan Walikota', 'description' => 'Peraturan yang ditetapkan oleh Walikota'],
            ['type_name' => 'Keputusan Gubernur', 'description' => 'Keputusan yang ditetapkan oleh Gubernur'],
            ['type_name' => 'Keputusan Walikota', 'description' => 'Keputusan yang ditetapkan oleh Walikota'],
        ];

        foreach ($types as $type) {
            DocumentType::firstOrCreate(
                ['type_name' => $type['type_name']],
                $type
            );
        }

        // Seed Document Statuses
        $statuses = [
            ['status_name' => 'Berlaku', 'description' => 'Dokumen masih berlaku'],
            ['status_name' => 'Tidak Berlaku', 'description' => 'Dokumen sudah tidak berlaku'],
            ['status_name' => 'Dicabut', 'description' => 'Dokumen telah dicabut'],
            ['status_name' => 'Diubah', 'description' => 'Dokumen telah diubah'],
        ];

        foreach ($statuses as $status) {
            DocumentStatus::firstOrCreate(
                ['status_name' => $status['status_name']],
                $status
            );
        }

        // Seed Main Entry Headings (Instansi)
        $headings = [
            ['heading_name' => 'Dewan Perwakilan Rakyat Daerah', 'description' => 'DPRD Provinsi'],
            ['heading_name' => 'Pemerintah Provinsi', 'description' => 'Pemprov'],
            ['heading_name' => 'Pemerintah Kota', 'description' => 'Pemkot'],
            ['heading_name' => 'Dinas Pendidikan', 'description' => 'Disdik'],
            ['heading_name' => 'Dinas Kesehatan', 'description' => 'Dinkes'],
        ];

        foreach ($headings as $heading) {
            MainEntryHeading::firstOrCreate(
                ['heading_name' => $heading['heading_name']],
                $heading
            );
        }
    }
} 