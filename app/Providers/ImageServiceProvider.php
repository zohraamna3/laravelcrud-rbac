<?php

namespace App\Providers;

use App\Interfaces\ImageRepositoryInterface;
use App\Repositories\ImageRepository;

use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
