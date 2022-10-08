<?php

namespace App\Providers;

use App\Infrastructure\FilesystemAdapter;
use App\Infrastructure\FilesystemAdapterInterface;
use Illuminate\Support\ServiceProvider;
use SwaggerLume\ServiceProvider as SwaggerServiceProvider;
use Urameshibr\Providers\FormRequestServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(FilesystemAdapterInterface::class, FilesystemAdapter::class);
        $this->app->register(FormRequestServiceProvider::class);
        $this->app->register(SwaggerServiceProvider::class);
    }
}
