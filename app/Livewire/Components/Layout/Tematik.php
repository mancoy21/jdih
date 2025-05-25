<?php

namespace App\Livewire\Components\Layout;

use Livewire\Component;
use App\Models\Theme;


class Tematik extends Component
{
    public $tema;
    
    public function mount()
    {
        $this->tema = Theme::all();
    }

    public function render()
    {
        return view('livewire.components.layout.tematik', [
            'tema' => $this->tema
        ]);
    }
}
