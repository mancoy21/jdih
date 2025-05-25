<?php

namespace App\Filament\Resources\DocumentStatusResource\Pages;

use App\Filament\Resources\DocumentStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentStatus extends EditRecord
{
    protected static string $resource = DocumentStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
