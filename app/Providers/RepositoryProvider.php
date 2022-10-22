<?php

namespace App\Providers;

use App\Repository\LogInterface;
use App\Repository\LogRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LogInterface::class,LogRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
