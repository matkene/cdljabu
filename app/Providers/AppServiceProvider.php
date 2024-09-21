<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Job;
use App\Models\User;

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
        // Add the code to prevent Lazy loading
        //Model::preventLazyLoading();
        //Paginator::useBootstrapFive();
        Gate::define('edit', function (User $user, Job $job) {
            return $job->employer->user->is($user);
            
        });


        
    }
}
