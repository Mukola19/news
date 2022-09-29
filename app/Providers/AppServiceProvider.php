<?php

namespace App\Providers;

use App\Models\Tag;
use App\Observers\TagObserver;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('uk_UK');
        Paginator::defaultView('vendor.pagination.bootstrap-5');

        Tag::observe(TagObserver::class);
    }
}
