<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class Profile extends Page
{
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.profile';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth()->user()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Profil')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        FileUpload::make('avatar')
                            ->image()
                            ->imageEditor()
                            ->directory('avatars'),
                    ]),
                Section::make('Ubah Password')
                    ->schema([
                        TextInput::make('current_password')
                            ->password()
                            ->label('Password Saat Ini')
                            ->required()
                            ->dehydrated(false),
                        TextInput::make('new_password')
                            ->password()
                            ->label('Password Baru')
                            ->required()
                            ->minLength(8)
                            ->dehydrated(false),
                        TextInput::make('new_password_confirmation')
                            ->password()
                            ->label('Konfirmasi Password Baru')
                            ->required()
                            ->minLength(8)
                            ->dehydrated(false),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = auth()->user();

        // Update profile
        $user->name = $data['name'];
        $user->email = $data['email'];
        
        // Update password if provided
        if ($data['current_password'] && $data['new_password']) {
            if (!Hash::check($data['current_password'], $user->password)) {
                Notification::make()
                    ->title('Password saat ini tidak valid')
                    ->danger()
                    ->send();
                return;
            }

            if ($data['new_password'] !== $data['new_password_confirmation']) {
                Notification::make()
                    ->title('Password baru tidak cocok')
                    ->danger()
                    ->send();
                return;
            }

            $user->password = Hash::make($data['new_password']);
        }

        $user->save();

        Notification::make()
            ->title('Profil berhasil diperbarui')
            ->success()
            ->send();
    }
} 