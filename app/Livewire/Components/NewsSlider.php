<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsSlider extends Component
{
    public function render()
    {
        $news = News::with(['categories'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'image' => $item->thumbnail_path ? Storage::url($item->thumbnail_path) : 'https://via.placeholder.com/800x600?text=News+Thumbnail',
                    'title' => $item->title,
                    'excerpt' => $item->meta_description ?? substr(strip_tags($item->content), 0, 150) . '...',
                    'category' => $item->categories->first()?->name ?? 'Uncategorized',
                    'date' => $item->published_at->format('d M Y'),
                    'slug' => $item->slug
                ];
            });

        return view('livewire.components.news-slider', [
            'news' => $news
        ]);
    }
} 