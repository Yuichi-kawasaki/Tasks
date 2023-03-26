<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // ここにバリデーションルールの追加を記述する
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new MyValidator($translator, $data, $rules, $messages);
        });
    }
}
