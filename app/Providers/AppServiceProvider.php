<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        Validator::extend('uuid', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^[[:xdigit:]]{8}\-[[:xdigit:]]{4}\-[[:xdigit:]]{4}\-[[:xdigit:]]{4}\-[[:xdigit:]]{12}$/', $value) === 1;
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
