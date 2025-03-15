<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
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
        $isProduction = $this->app->isProduction();

        Model::shouldBeStrict($isProduction);
        DB::prohibitDestructiveCommands($isProduction);
        URL::forceScheme('https');

        date_default_timezone_set(config('app.timezone'));

        Vite::prefetch(concurrency: 3)->useAggressivePrefetching();

        $this->handleGates();

    }

    private function handleGates(): void
    {
        Gate::define('viewPulse', function (User $user): bool {
            return $user->isAdmin();
        });

        Gate::guessPolicyNamesUsing(function (string $modelClass) {
            return str_replace('Models', 'Policies', $modelClass).'Policy';
        });

        Gate::define('viewPulse', fn (User $user): bool => $user->isAdmin());
    }
}
