<?php

namespace App\Providers\Filament;

use App\Filament\Resources\ChangePasswords\ChangePasswordResource;
use App\Filament\Resources\Users\UserResource;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use BezhanSalleh\FilamentShield\Resources\Roles\RoleResource;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

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
                'primary' => Color::hex('#CC0000'),           // Bold Red
                'gray'    => Color::Zinc,         // Clean, neutral gray to ground the red
                'info'    => Color::Blue,         // Standard blue to contrast with red
                'success' => Color::Green,        // Classic green for "Go" actions
                'warning' => Color::Orange,       // Distinct from red to avoid confusion
                'danger'  => Color::Red,           // Soft red for errors/deletions
            ])
            ->sidebarWidth('14rem')
            ->sidebarCollapsibleOnDesktop()
            ->breadcrumbs(false)
            ->brandLogo(asset('assets/images/logo.png'))
            ->favicon(asset('assets/images/icon.png'))
            ->brandLogoHeight('1.8rem')
            ->font('Roboto')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                //AccountWidget::class,
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
            //->databaseNotifications()
            ->renderHook(PanelsRenderHook::GLOBAL_SEARCH_AFTER, function () {
                return view('filament.widgets.add-setting-button')->render();
            })
            ->userMenuItems([
                Action::make('chngpwd')
                    ->label('Change Password')
                    ->icon('heroicon-o-key')
                    ->url(fn(): string => ChangePasswordResource::getUrl('edit', ['record' => auth()->user()->id])),
            ])
            ->plugins([
                FilamentShieldPlugin::make()
                    ->navigationSort(102)
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 4,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
            ])
            ;
    }
}
