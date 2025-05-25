<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $type_id = $request->input('type_id');
        $document_year = $request->input('document_year');
        $sort = $request->input('sort', 'desc');

        $query = Document::query()
            ->with(['documentType', 'documentStatus'])
            ->search($search)
            ->when($type_id, function ($query) use ($type_id) {
                return $query->where('type_id', $type_id);
            })
            ->when($document_year, function ($query) use ($document_year) {
                return $query->where('document_year', $document_year);
            });

        // Apply sorting
        $query->orderBy('announcement_date', $sort);

        $documents = $query->paginate(10);
        $documentTypes = DocumentType::all();

        return view('livewire.pages.document.index', compact('documents', 'documentTypes', 'search', 'type_id', 'document_year', 'sort'));
    }

    public function show(Document $document)
    {
        $document->load(['documentType', 'documentStatus', 'themes', 'labels']);
        return view('livewire.pages.document.show', compact('document'));
    }
} 