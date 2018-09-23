<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Auth;
use App\loan_account;

class AppServiceProvider extends ServiceProvider
{
    private $user_id;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       \Schema::defaultStringLength(191);

       if (Auth::user()) {
            $this->user_id = Auth::user()->id;
        }else
        {
           $this->user_id = Auth::user();
        }

        view()->share(
            array(
                "application_name"     =>      "FSMS $this->user_id",
                )
            );
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
