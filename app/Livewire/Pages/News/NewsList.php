<?php

namespace App\Livewire\Pages\News;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class NewsList extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $perPage = 6;
    public $viewMode = 'grid'; // Default view mode

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'viewMode' => ['except' => 'grid'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
    }

    public function render()
    {
        $query = News::query()
            ->where('status', 'published')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function ($query) {
                $query->whereHas('categories', function ($q) {
                    $q->where('id', $this->category);
                });
            })
                
            ->latest('published_at');

        $news = $query->paginate($this->perPage);
        
        // Debug untuk memeriksa path gambar
        // if ($news->isNotEmpty()) {
        //     $firstNews = $news->first();
        //     dd([
        //         'thumbnail_path' => $firstNews->thumbnail_path,
        //         'storage_url' => Storage::url($firstNews->thumbnail_path),
        //         'full_path' => Storage::path($firstNews->thumbnail_path),
        //     ]);
        // }

        $categories = Category::all();

        return view('livewire.pages.news.news-list', [
            'news' => $news,
            'categories' => $categories,
        ])->layout('components.layouts.app');
    }
}
