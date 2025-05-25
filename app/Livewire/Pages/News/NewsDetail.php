<?php

namespace App\Livewire\Pages\News;

use Livewire\Component;
use App\Models\News;

class NewsDetail extends Component
{
    public $news;
    public $slug;
    public $selectedImage = null;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->news = News::with(['mediaGalleries' => function($query) {
            $query->orderBy('order', 'asc');
        }])
        ->where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();
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
        return view('livewire.pages.news.news-detail', [
            'news' => $this->news,
        ])->layout('components.layouts.app');
    }
} 