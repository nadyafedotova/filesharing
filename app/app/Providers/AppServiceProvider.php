<?php

namespace App\Providers;

use App\Helpers\FileMedia\FileIcon;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    final public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
        $this->app->singleton(FileIcon::class, fn() => new FileIcon(
            json_decode(
                file_get_contents(base_path('/node_modules/file-icon-vectors/dist/icons/vivid/catalog.json')),
                true,
            ),
        ));
    }

    /**
     * Bootstrap any application services.
     */
    final public function boot(): void
    {
        //
    }
}
