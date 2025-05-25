<?php

namespace App\Filament\Resources\DocumentVersionResource\Pages;

use App\Filament\Resources\DocumentVersionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocumentVersions extends ListRecords
{
    protected static string $resource = DocumentVersionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
