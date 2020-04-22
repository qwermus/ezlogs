<?php

namespace App\Providers;

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
        \Validator::extend('maxKeyIs56', function($attribute, $value, $parameters, $validator) {

            // Convert array to keys;
            $keys = array_keys($value);

            // Return true
            return is_array($value) &&
                count(array_filter($keys, 'is_string')) === 0 &&
                max($keys) <= config('api.commentMax');
        });
    }
}
