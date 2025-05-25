<?php

namespace App\Filament\Resources\MainEntryHeadingResource\Pages;

use App\Filament\Resources\MainEntryHeadingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMainEntryHeadings extends ListRecords
{
    protected static string $resource = MainEntryHeadingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
