<?php

namespace App\Providers;

use App\Models\Locale;
use Illuminate\Support\ServiceProvider;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Загружаем локали из базы данных
        $locales = Locale::all()->pluck('name', 'code')->toArray();

        // Добавляем их в конфигурацию
        config(['app.available_locales' => $locales]);
    }
}
