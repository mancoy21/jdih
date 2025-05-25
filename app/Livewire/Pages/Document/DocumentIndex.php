<?php

namespace App\Livewire\Pages\Document;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentStatus;
use App\Models\MainEntryHeading;
use App\Models\Theme;
use Livewire\Component;
use Livewire\WithPagination;

class DocumentIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $type_id = '';
    public $status_id = '';
    public $heading_id = '';
    public $theme_id = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $document_year = '';
    public $sort = 'desc';
    public $perPage = 10;
    protected $paginationTheme = 'tailwind';

    protected $queryString = [
        'search' => ['except' => ''],
        'type_id' => ['except' => ''],
        'status_id' => ['except' => ''],
        'heading_id' => ['except' => ''],
        'theme_id' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
        'document_year' => ['except' => ''],
        'sort' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function setPerPage($value)
    {
        $this->perPage = $value;
        $this->resetPage();
    }

    public function render()
    {
        $query = Document::query()
            ->with(['documentType', 'documentStatus', 'mainEntryHeading', 'themes'])
            ->search($this->search)
            ->filter([
                'type_id' => $this->type_id,
                'status_id' => $this->status_id,
                'heading_id' => $this->heading_id,
                'theme_id' => $this->theme_id,
                'date_from' => $this->dateFrom,
                'date_to' => $this->dateTo,
                'document_year' => $this->document_year,
            ])
            ->orderBy('announcement_date', $this->sort);

        $totalDocuments = $query->count();
        $documents = $query->paginate($this->perPage);

        // Cache data statis untuk 24 jam
        $documentTypes = cache()->remember('document_types', now()->addHours(24), function () {
            return DocumentType::all();
        });

        $documentStatuses = cache()->remember('document_statuses', now()->addHours(24), function () {
            return DocumentStatus::all();
        });

        $mainEntryHeadings = cache()->remember('main_entry_headings', now()->addHours(24), function () {
            return MainEntryHeading::all();
        });

        $themes = cache()->remember('themes', now()->addHours(24), function () {
            return Theme::all();
        });

        return view('livewire.pages.document.index', [
            'documents' => $documents,
            'documentTypes' => $documentTypes,
            'documentStatuses' => $documentStatuses,
            'mainEntryHeadings' => $mainEntryHeadings,
            'themes' => $themes,
            'totalDocuments' => $totalDocuments,
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['search', 'type_id', 'status_id', 'heading_id', 'theme_id', 'dateFrom', 'dateTo', 'document_year', 'sort']);
        $this->resetPage();
    }
} 