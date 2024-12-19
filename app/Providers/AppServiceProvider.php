<?php

namespace App\Providers;

use App\Policies\TaskPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('task-view', [TaskPolicy::class, 'view']);
        Gate::define('task-modify', [TaskPolicy::class, 'modify']);
    }
}
