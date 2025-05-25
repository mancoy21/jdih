<?php

namespace App\Livewire\Pages\Document;

use App\Models\Document;
use Livewire\Component;

class DocumentShow extends Component
{
   
    public Document $document;
    public $embedUrl;

    public function mount(Document $document)
    {
        $this->document = $document->load([
            'documentType',
            'documentStatus',
            'mainEntryHeading',
            'themes',
            'labels',
            'versions'
        ]);

        // Konversi URL Google Drive ke URL embed
        if ($this->document->preview_url) {
            preg_match('/\/d\/(.+?)\//', $this->document->preview_url, $matches);
            $fileId = $matches[1] ?? null;
            $this->embedUrl = $fileId ? "https://drive.google.com/uc?export=download&id={$fileId}" : null;
        }
    }

    public function render()
    {
        return view('livewire.pages.document.show');
    }
} 