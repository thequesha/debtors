<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\DebtorRepositoryInterface;
use App\Repositories\Eloquent\DebtorRepository;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository bindings
        $this->app->bind(DebtorRepositoryInterface::class, DebtorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
