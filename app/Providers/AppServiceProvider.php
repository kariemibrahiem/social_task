<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $userProvider = null;
            try {
                $userProvider = auth('admin')->user();
            } catch (\Throwable $e) {
                $userProvider = auth()->user();
            }

            $view->with('userProvider', $userProvider);
        });

        View::composer('web.layouts.app', function ($view) {
            $admin = \App\Models\Admin::first();
            $view->with('admin', $admin);
        });
    }
}
