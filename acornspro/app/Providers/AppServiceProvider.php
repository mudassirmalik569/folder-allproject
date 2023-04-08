<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function (): void {
            Filament::registerTheme(mix('css/filament.css'));

            if (str_contains(config('app.name'), 'ELS')) {
                Filament::registerUserMenuItems([
                    UserMenuItem::make()
                        ->label('FEI')
                        ->url('https://acornspro.com')
                        ->icon('heroicon-s-sun'),
                ]);
            } else {
                Filament::registerUserMenuItems([
                    UserMenuItem::make()
                        ->label('ELS')
                        ->url('https://els.acornspro.com')
                        ->icon('heroicon-s-scissors'),
                ]);
            }
        });
    }
}
