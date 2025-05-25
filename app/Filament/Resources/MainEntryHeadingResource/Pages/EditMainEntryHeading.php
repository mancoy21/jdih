<?php

namespace App\Filament\Resources\MainEntryHeadingResource\Pages;

use App\Filament\Resources\MainEntryHeadingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMainEntryHeading extends EditRecord
{
    protected static string $resource = MainEntryHeadingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
