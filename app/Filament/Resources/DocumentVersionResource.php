<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentVersionResource\Pages;
use App\Filament\Resources\DocumentVersionResource\RelationManagers;
use App\Models\DocumentVersion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentVersionResource extends Resource
{
    protected static ?string $model = DocumentVersion::class;
    protected static ?string $navigationGroup = 'JDIH Management';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('document_id')
                    ->relationship('document', 'title')
                    ->required(),
                Forms\Components\TextInput::make('version_number')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('document_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('document_year')
                    ->numeric(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('issuance_date'),
                Forms\Components\DatePicker::make('announcement_date'),
                Forms\Components\TextInput::make('type_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('heading_id')
                    ->numeric(),
                Forms\Components\TextInput::make('file_path')
                    ->maxLength(255),
                Forms\Components\Textarea::make('change_notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('document.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('version_number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('document_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('document_year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('issuance_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('announcement_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('heading_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentVersions::route('/'),
            'create' => Pages\CreateDocumentVersion::route('/create'),
            'edit' => Pages\EditDocumentVersion::route('/{record}/edit'),
        ];
    }
}
