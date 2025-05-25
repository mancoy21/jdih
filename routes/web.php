<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\News\NewsList;
use App\Livewire\Pages\News\NewsDetail;
use App\Http\Controllers\DocumentController;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Document\DocumentIndex;
use App\Livewire\Pages\Document\DocumentShow;

Route::get('/hukum', function () {
    return view('livewire.pages.dokumen-hukum');
});

Route::get('/news', NewsList::class)->name('news.index');
Route::get('/news/{slug}', NewsDetail::class)->name('news.show');

Route::get('/documents', DocumentIndex::class)->name('documents.index');
Route::get('/documents/{document}', DocumentShow::class)->name('documents.show');

Route::get('/', Home::class)->name('home');