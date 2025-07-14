<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

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

public function boot()
{
    View::composer('*', function ($view) {
        $unreadNotifications = Notification::where('is_read', false)->latest()->get();
        $view->with('notifications', $unreadNotifications);
        $view->with('unreadCount', $unreadNotifications->count());
    });
}

}
