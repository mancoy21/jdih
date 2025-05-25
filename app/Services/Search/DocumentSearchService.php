<?php

namespace App\Services\Search;

use App\Models\Document;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class DocumentSearchService
{
    /**
     * Melakukan pencarian dokumen berdasarkan query dan filter
     */
    public function search(string $query, array $filters = []): Collection
    {
        $search = Document::query()
            ->with(['documentType', 'documentStatus', 'mainEntryHeading'])
            ->when($query, function (Builder $builder) use ($query) {
                $builder->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('document_number', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                });
            })
            ->when(isset($filters['year']), function (Builder $builder) use ($filters) {
                $builder->where('document_year', $filters['year']);
            })
            ->when(isset($filters['type_id']), function (Builder $builder) use ($filters) {
                $builder->where('type_id', $filters['type_id']);
            })
            ->when(isset($filters['status_id']), function (Builder $builder) use ($filters) {
                $builder->where('status_id', $filters['status_id']);
            })
            ->when(isset($filters['heading_id']), function (Builder $builder) use ($filters) {
                $builder->where('heading_id', $filters['heading_id']);
            });

        return $search->get();
    }

    /**
     * Melakukan pencarian lanjutan dengan parameter yang lebih spesifik
     */
    public function advancedSearch(array $params): Collection
    {
        $query = Document::query()
            ->with(['documentType', 'documentStatus', 'mainEntryHeading', 'themes', 'labels']);

        // Filter berdasarkan tanggal
        if (isset($params['start_date']) && isset($params['end_date'])) {
            $query->whereBetween('issuance_date', [$params['start_date'], $params['end_date']]);
        }

        // Filter berdasarkan tema
        if (isset($params['theme_id'])) {
            $query->whereHas('themes', function ($q) use ($params) {
                $q->where('theme_id', $params['theme_id']);
            });
        }

        // Filter berdasarkan label
        if (isset($params['label_id'])) {
            $query->whereHas('labels', function ($q) use ($params) {
                $q->where('label_id', $params['label_id']);
            });
        }

        // Filter berdasarkan status konsolidasi
        if (isset($params['has_consolidation'])) {
            $query->where('has_consolidation', $params['has_consolidation']);
        }

        // Filter berdasarkan status terjemahan
        if (isset($params['has_translation'])) {
            $query->where('has_translation', $params['has_translation']);
        }

        return $query->get();
    }

    /**
     * Mendapatkan saran pencarian berdasarkan input pengguna
     */
    public function getSearchSuggestions(string $query): Collection
    {
        return Document::query()
            ->where('title', 'like', "%{$query}%")
            ->orWhere('document_number', 'like', "%{$query}%")
            ->select('title', 'document_number')
            ->limit(5)
            ->get();
    }
} 