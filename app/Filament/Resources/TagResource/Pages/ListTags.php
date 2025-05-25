<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Components\Table\Columns\ImageColumn;

class ListTags extends ListRecords
{
    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getFormComponents(): array
    {
        return [
            FileUpload::make('thumbnail_path')
                ->directory('news-thumbnails')
                ->image()
                ->maxSize(10240)
                ->imageResizeMode('cover')
                ->imageCropAspectRatio('16:9')
                ->imageResizeTargetWidth('1920')
                ->imageResizeTargetHeight('1080'),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            ImageColumn::make('thumbnail_path')
                ->square()
                ->width(60)
                ->height(60)
                ->defaultImageUrl(url('/images/no-image.png'))
                ->searchable(),
        ];
    }
} 