<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\News;

class NewsDetail extends Component
{
    public $news;
    public $selectedImage = null;

    public function mount(News $news)
    {
        $this->news = $news->load(['mediaGalleries' => function($query) {
            $query->orderBy('order', 'asc');
        }]);
    }

    public function showImage($imagePath)
    {
        $this->selectedImage = $imagePath;
    }

    public function closeImage()
    {
        $this->selectedImage = null;
    }

    public function render()
    {
        return view('components.news-detail');
    }
} 