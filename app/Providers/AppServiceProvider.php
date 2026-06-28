<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebSetting;
use App\Models\Kontak;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share data web_settings dan kontak ke semua view secara otomatis
        View::composer('*', function ($view) {
            // Ambil data pertama (asumsi ID = 1)
            $settings = WebSetting::first(); 
            $kontak = Kontak::first();
            
            $view->with('settings', $settings)
                 ->with('kontak', $kontak);
        });
    }
}
