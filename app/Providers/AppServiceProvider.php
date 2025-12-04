<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Scramble::routes(function (Route $route) {
            return Str::startsWith($route->uri, 'api/') ||
                Str::startsWith($route->uri, 'login') ||
                Str::startsWith($route->uri, 'register') ||
                Str::startsWith($route->uri, 'logout') ||
                Str::startsWith($route->uri, 'forgot-password') ||
                Str::startsWith($route->uri, 'reset-password') ||
                Str::startsWith($route->uri, 'verify-email') ||
                Str::startsWith($route->uri, 'email/verification') ||
                Str::startsWith($route->uri, 'sanctum/csrf-cookie');
        });

    }
}
