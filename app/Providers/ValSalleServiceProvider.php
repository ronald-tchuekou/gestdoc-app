<?php

namespace App\Providers;

use App\Salle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValSalleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('uniqueSalle', function($code_salle, $val, $params) {
            $result =  Salle::where('etab_id', $params[0])
            ->where('name', $val)->count();
            return $result === 0;
        });
    }
}
