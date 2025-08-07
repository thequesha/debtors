<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\DebtorRepositoryInterface;
use App\Repositories\Eloquent\DebtorRepository;
use App\Repositories\Contracts\GoogleSheetUrlRepositoryInterface;
use App\Repositories\Eloquent\GoogleSheetUrlRepository;
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
        $this->app->bind(GoogleSheetUrlRepositoryInterface::class, GoogleSheetUrlRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
