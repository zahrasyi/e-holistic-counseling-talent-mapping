<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('components.layouts.navbar', function ($view) {
            if (Auth::check()) {
                $unreadNotifications = Auth::user()->unreadNotifications()->get();
                $unreadNotificationsCount  = Auth::user()->unreadNotifications()->count();

                // dd($unreadNotifications, $unreadNotificationsCount);
            } else {
                $unreadNotifications = collect();
                $unreadNotificationsCount = 0;
            }

            $view->with([
                'unreadNotifications' => $unreadNotifications,
                'unreadNotificationsCount' => $unreadNotificationsCount
            ]);
        });
    }
}
