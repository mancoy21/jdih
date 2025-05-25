<?php

namespace App\Livewire\Components\Layout;

use Livewire\Component;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class Hero extends Component
{
    public function render()
    {
        $sliders = Slider::orderBy('order')->get();
        $activeSliders = $sliders->where('status', 'active');

        return view('livewire.components.layout.hero', [
            'activeSliders' => $activeSliders
        ]);
    }
}
