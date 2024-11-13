<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::directive('formatDate', function ($expression) {
            return "<?php echo ($expression) ? Carbon\Carbon::parse($expression)->format('d-m-Y') : ''; ?>";
        });

        Blade::directive('formatTime', function ($expression) {
            return "<?php echo ($expression) ? Carbon\Carbon::parse($expression)->format('H:i') : ''; ?>";
        });

        Blade::directive('currency', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });

        Blade::directive('formatFullDate', function ($expression) {
            return "<?php echo ($expression) ? \Carbon\Carbon::parse($expression)->translatedFormat('l, d F Y') : ''; ?>";
        });
    }
}
