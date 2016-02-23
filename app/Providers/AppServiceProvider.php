<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('check_password', function($attribute, $value, $parameter){
            return Hash::check($value, Auth::user()->getAuthPassword());
        });

        Blade::directive('datetime', function($expression) {
            return "<?php echo with{$expression}->format('d/m/Y H:i'); ?>";
        });

        Blade::directive('fulldate', function($expression) {
            return "<?php echo with{$expression}->format('d F Y'); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
