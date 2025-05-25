<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('title_part_1')
                ->required()
                ->maxLength(255)
                ->label('Title Part 1 (e.g., "Selamat Datang di JDIH")')
                ->helperText('Bagian pertama dari title yang akan diberi warna berbeda.'),
            TextInput::make('title_part_2')
                ->required()
                ->maxLength(255)
                ->label('Title Part 2 (e.g., "Kemenkes Biro Hukum")')
                ->helperText('Bagian kedua dari title yang akan diberi warna berbeda.'),
            Textarea::make('description')
                ->nullable()
                ->label('Description')
                ->helperText('Deskripsi singkat untuk slider.'),
            FileUpload::make('image_url')
                ->label('Image')
                ->disk('public')
                ->directory('sliders')
                ->image()
                ->required()
                ->helperText('Upload a circular image (e.g., 256x256px) for the slider.'),
            TextInput::make('button_label_1')
                ->nullable()
                ->label('Button 1 Label')
                ->helperText('Label untuk tombol pertama.'),
            TextInput::make('button_link_1')
                ->nullable()
                ->url()
                ->label('Button 1 Link')
                ->helperText('Link untuk tombol pertama.'),
            TextInput::make('button_label_2')
                ->nullable()
                ->label('Button 2 Label')
                ->helperText('Label untuk tombol kedua.'),
            TextInput::make('button_link_2')
                ->nullable()
                ->url()
                ->label('Button 2 Link')
                ->helperText('Link untuk tombol kedua.'),
            TextInput::make('order')
                ->numeric()
                ->default(0)
                ->label('Order')
                ->helperText('Urutan tampilan slider (angka lebih kecil akan ditampilkan lebih awal).'),
            Select::make('status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
                ->default('active')
                ->label('Status')
                ->helperText('Menentukan apakah slider akan ditampilkan atau tidak.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('title_part_1')
                ->label('Title Part 1')
                ->searchable()
                ->sortable(),
            TextColumn::make('title_part_2')
                ->label('Title Part 2')
                ->searchable()
                ->sortable(),
            TextColumn::make('description')
                ->label('Description')
                ->limit(50)
                ->searchable()
                ->sortable(),
            ImageColumn::make('image_url')
                ->label('Image')
                ->disk('public')
                ->searchable(),
            TextColumn::make('order')
                ->label('Order')
                ->sortable(),
            TextColumn::make('status')
                ->label('Status')
                ->searchable()
                ->sortable(),
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable(),
            TextColumn::make('updated_at')
                ->label('Updated At')
                ->dateTime()
                ->sortable(),
            TextColumn::make('deleted_at')
                ->label('Deleted At')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Tables\Filters\TrashedFilter::make(),
        ])
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
            RestoreAction::make(),
            ForceDeleteAction::make(),
        ])
        ->bulkActions([
            DeleteBulkAction::make(),
            RestoreBulkAction::make(),
            ForceDeleteBulkAction::make(),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->withTrashed();
    }
}
