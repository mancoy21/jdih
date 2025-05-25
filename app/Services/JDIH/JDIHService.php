<?php

namespace App\Services\JDIH;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentStatus;

class JDIHService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('jdih.api_url');
        $this->apiKey = config('jdih.api_key');
    }

    /**
     * Sinkronisasi dokumen dengan JDIH pusat
     */
    public function syncDocuments()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey
            ])->get($this->baseUrl . '/documents');

            if ($response->successful()) {
                $documents = $response->json()['data'];

                foreach ($documents as $doc) {
                    $this->processDocument($doc);
                }

                return true;
            }

            Log::error('JDIH Sync Failed: ' . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error('JDIH Sync Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Proses dokumen dari JDIH pusat
     */
    protected function processDocument(array $doc)
    {
        // Cari atau buat jenis dokumen
        $type = DocumentType::firstOrCreate(
            ['type_name' => $doc['type']],
            ['description' => $doc['type_description'] ?? null]
        );

        // Cari atau buat status dokumen
        $status = DocumentStatus::firstOrCreate(
            ['name' => $doc['status']],
            ['description' => $doc['status_description'] ?? null]
        );

        // Update atau buat dokumen
        Document::updateOrCreate(
            ['document_number' => $doc['number']],
            [
                'title' => $doc['title'],
                'document_year' => $doc['year'],
                'description' => $doc['description'] ?? null,
                'issuance_date' => $doc['issuance_date'],
                'announcement_date' => $doc['announcement_date'],
                'type_id' => $type->type_id,
                'status_id' => $status->status_id,
                'file_path' => $doc['file_path'] ?? null,
            ]
        );
    }

    /**
     * Pencarian dokumen di JDIH pusat
     */
    public function searchRemote(string $query, array $filters = [])
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey
            ])->get($this->baseUrl . '/search', [
                'q' => $query,
                'filters' => $filters
            ]);

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('JDIH Search Failed: ' . $response->body());
            return [];
        } catch (\Exception $e) {
            Log::error('JDIH Search Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Mendapatkan statistik dari JDIH pusat
     */
    public function getStatistics()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey
            ])->get($this->baseUrl . '/statistics');

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('JDIH Statistics Failed: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('JDIH Statistics Error: ' . $e->getMessage());
            return null;
        }
    }
} 