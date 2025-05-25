<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class NavbarSearch extends Component
{
    public $search = '';
    public $showDropdown = false;
    protected $results = [];

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->results = Document::search($this->search)
                ->take(5)
                ->get(['id', 'title', 'document_number']);
        } else {
            $this->results = [];
        }

        $this->showDropdown = true;
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->results = [];
        $this->showDropdown = false;
    }

    public function performSearch()
    {
        if (!empty($this->search)) {
            return redirect()->route('documents.index', ['search' => urlencode($this->search)]);
        }
    }

    public function selectResult($id)
    {
        // Redirect ke halaman detail dokumen
        return redirect()->route('documents.show', $id);
    }

    public function render()
    {
        return view('livewire.components.navbar-search', [
            'results' => $this->results,
        ]);
    }
} 