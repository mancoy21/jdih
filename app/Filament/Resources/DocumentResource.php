<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'JDIH Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dokumen')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Dokumen')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('document_number')
                            ->label('Nomor Dokumen')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('document_year')
                            ->label('Tahun Dokumen')
                            ->required()
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y') + 1),

                        Forms\Components\DatePicker::make('issuance_date')
                            ->label('Tanggal Ditetapkan')
                            ->required()
                            ->displayFormat('d/m/Y'),

                        Forms\Components\DatePicker::make('announcement_date')
                            ->label('Tanggal Diundangkan')
                            ->required()
                            ->displayFormat('d/m/Y'),

                        Forms\Components\Select::make('type_id')
                            ->label('Jenis Dokumen')
                            ->relationship('documentType', 'type_name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('status_id')
                            ->label('Status Hukum')
                            ->relationship('documentStatus', 'status_name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('heading_id')
                            ->label('Tajuk Entri Utama')
                            ->relationship('mainEntryHeading', 'heading_name')
                            ->searchable()
                            ->preload(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('File dan Media')
                    ->schema([
                        Forms\Components\TextInput::make('file_path')
                            ->label('Path File PDF')
                            // ->required()
                            ->nullable()
                            ->maxLength(255)
                            ->helperText('Masukkan path file PDF (contoh: /documents/pmk-123-2024.pdf)'),

                        Forms\Components\TextInput::make('thumbnail_url')
                            ->label('URL Thumbnail')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('preview_url')
                            ->label('URL Preview')
                            ->maxLength(255),

                        Forms\Components\Toggle::make('has_consolidation')
                            ->label('Memiliki Konsolidasi')
                            ->default(false),

                        Forms\Components\Toggle::make('has_translation')
                            ->label('Memiliki Terjemahan')
                            ->default(false),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Kategorisasi')
                    ->schema([
                        Forms\Components\Select::make('theme_id')
                            ->label('Tema')
                            ->relationship('themes', 'theme_name')
                            ->multiple()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('labels')
                            ->label('Label')
                            ->relationship('labels', 'label_name')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('document_number')
                    ->label('Nomor')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50)
                    ->sortable(),

                Tables\Columns\TextColumn::make('document_year')
                    ->label('Tahun')
                    ->sortable(),

                Tables\Columns\TextColumn::make('documentType.type_name')
                    ->label('Jenis')
                    ->sortable(),

                Tables\Columns\TextColumn::make('documentStatus.status_name')
                    ->label('Status')
                    ->sortable(),

                Tables\Columns\TextColumn::make('mainEntryHeading.heading_name')
                    ->label('Tajuk Entri')
                    ->sortable(),

                Tables\Columns\TextColumn::make('issuance_date')
                    ->label('Tanggal Ditetapkan')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('has_consolidation')
                    ->label('Konsolidasi')
                    ->boolean(),

                Tables\Columns\IconColumn::make('has_translation')
                    ->label('Terjemahan')
                    ->boolean(),

                Tables\Columns\IconColumn::make('file_path')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('document_year')
                    ->label('Tahun')
                    ->options(fn () => Document::distinct()
                        ->pluck('document_year', 'document_year')
                        ->toArray()),

                Tables\Filters\SelectFilter::make('type_id')
                    ->label('Jenis Dokumen')
                    ->relationship('documentType', 'type_name'),

                Tables\Filters\SelectFilter::make('status_id')
                    ->label('Status Hukum')
                    ->relationship('documentStatus', 'status_name'),

                Tables\Filters\SelectFilter::make('heading_id')
                    ->label('Tajuk Entri')
                    ->relationship('mainEntryHeading', 'heading_name'),

                Tables\Filters\Filter::make('has_consolidation')
                    ->label('Memiliki Konsolidasi')
                    ->toggle(),

                Tables\Filters\Filter::make('has_translation')
                    ->label('Memiliki Terjemahan')
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn (Document $record): string => $record->file_path)
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('document_year', 'desc');
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
