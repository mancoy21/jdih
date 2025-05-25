<?php

namespace App\Livewire\Components\Layout;

use Livewire\Component;
use App\Models\Document;
use Carbon\Carbon;

class Highlight extends Component
{
    public $activeTab = 'terkini';
    public $perPage = 6;

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $terkini = Document::with(['documentType', 'documentStatus'])
            ->orderBy('announcement_date', 'desc')
            ->take($this->perPage)
            ->get();

        $terpopuler = Document::with(['documentType', 'documentStatus'])
            ->orderBy('created_at', 'desc')
            ->take($this->perPage)
            ->get();

        return view('livewire.components.layout.highlight', [
            'terkini' => $terkini,
            'terpopuler' => $terpopuler
        ]);
    }
}
