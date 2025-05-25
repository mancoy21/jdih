<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaGalleryResource\Pages;
use App\Models\MediaGallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MediaGalleryResource extends Resource
{
    protected static ?string $model = MediaGallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Konten Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('news_id')
                    ->relationship('news', 'title')
                    ->required(),
                Forms\Components\FileUpload::make('file_path')
                    ->required()
                    ->directory('media-gallery')
                    ->disk('public')
                    ->image()
                    ->maxSize(10240)
                    ->visibility('public')
                    ->defaultImageUrl(url('/images/no-image.png')),
                Forms\Components\TextInput::make('caption')
                    ->maxLength(255),
                Forms\Components\Select::make('media_type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                        'document' => 'Document',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('news.title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('file_path')
                    ->circular()
                    ->disk('public')
                    ->visibility('public')
                    ->defaultImageUrl(url('/images/no-image.png')),
                Tables\Columns\TextColumn::make('caption')
                    ->searchable(),
                Tables\Columns\TextColumn::make('media_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaGalleries::route('/'),
            'create' => Pages\CreateMediaGallery::route('/create'),
            'edit' => Pages\EditMediaGallery::route('/{record}/edit'),
        ];
    }
} 