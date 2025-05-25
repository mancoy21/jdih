<?php

namespace App\Services\Document;

use App\Models\Document;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    /**
     * Mendapatkan dokumen berdasarkan ID
     */
    public function getDocument(int $id): ?Document
    {
        return Cache::remember('document.' . $id, 3600, function () use ($id) {
            return Document::with(['documentType', 'documentStatus', 'mainEntryHeading', 'themes', 'labels'])
                ->find($id);
        });
    }

    /**
     * Membuat dokumen baru
     */
    public function createDocument(array $data): Document
    {
        $document = Document::create($data);

        // Attach themes jika ada
        if (isset($data['themes'])) {
            $document->themes()->attach($data['themes']);
        }

        // Attach labels jika ada
        if (isset($data['labels'])) {
            $document->labels()->attach($data['labels']);
        }

        // Clear cache
        Cache::forget('documents.list');

        return $document;
    }

    /**
     * Mengupdate dokumen
     */
    public function updateDocument(int $id, array $data): Document
    {
        $document = Document::findOrFail($id);
        $document->update($data);

        // Sync themes jika ada
        if (isset($data['themes'])) {
            $document->themes()->sync($data['themes']);
        }

        // Sync labels jika ada
        if (isset($data['labels'])) {
            $document->labels()->sync($data['labels']);
        }

        // Clear cache
        Cache::forget('document.' . $id);
        Cache::forget('documents.list');

        return $document;
    }

    /**
     * Menghapus dokumen
     */
    public function deleteDocument(int $id): bool
    {
        $document = Document::findOrFail($id);

        // Hapus file PDF jika ada
        if ($document->file_path && Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        // Hapus thumbnail jika ada
        if ($document->thumbnail_url && Storage::exists($document->thumbnail_url)) {
            Storage::delete($document->thumbnail_url);
        }

        // Hapus dokumen
        $deleted = $document->delete();

        // Clear cache
        Cache::forget('document.' . $id);
        Cache::forget('documents.list');

        return $deleted;
    }

    /**
     * Mendapatkan daftar dokumen dengan pagination
     */
    public function getDocuments(int $perPage = 10)
    {
        return Cache::remember('documents.list', 3600, function () use ($perPage) {
            return Document::with(['documentType', 'documentStatus', 'mainEntryHeading'])
                ->latest()
                ->paginate($perPage);
        });
    }

    /**
     * Mendapatkan dokumen berdasarkan jenis
     */
    public function getDocumentsByType(int $typeId, int $perPage = 10)
    {
        return Document::with(['documentType', 'documentStatus', 'mainEntryHeading'])
            ->where('type_id', $typeId)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Mendapatkan dokumen berdasarkan status
     */
    public function getDocumentsByStatus(int $statusId, int $perPage = 10)
    {
        return Document::with(['documentType', 'documentStatus', 'mainEntryHeading'])
            ->where('status_id', $statusId)
            ->latest()
            ->paginate($perPage);
    }
} 