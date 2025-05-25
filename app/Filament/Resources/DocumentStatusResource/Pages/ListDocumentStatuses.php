<?php

namespace App\Filament\Resources\DocumentStatusResource\Pages;

use App\Filament\Resources\DocumentStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocumentStatuses extends ListRecords
{
    protected static string $resource = DocumentStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
