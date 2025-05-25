<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Facades\Filament;
use Filament\Navigation\MenuItem;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => [
                    50 => '236, 253, 245',
                    100 => '209, 250, 229',
                    200 => '167, 243, 208',
                    300 => '129, 231, 175',
                    400 => '129, 231, 175', // #81E7AF
                    500 => '16, 185, 129',
                    600 => '5, 150, 105',
                    700 => '4, 120, 87',
                    800 => '6, 95, 70',
                    900 => '6, 78, 59',
                    950 => '2, 44, 34',
                ],
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->topNavigation()
            ->brandName('CMS JDIH')
            ->navigationGroups([
                'Konten Berita',
                'JDIH Management',
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Profil')
                    ->icon('heroicon-o-user')
                    ->url(fn () => route('filament.admin.resources.users.profile')),
                MenuItem::make()
                    ->label('Manajemen User')
                    ->icon('heroicon-o-users')
                    ->url(fn () => route('filament.admin.resources.users.index'))
                    ->visible(fn () => auth()->user()->isAdmin()),
            ]);
    }
}
