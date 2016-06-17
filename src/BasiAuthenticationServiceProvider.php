<?php

namespace Luckys\BasicAithentication;

use Illuminate\Support\ServiceProvider;
use Luckys\BasicAithentication\Console\Commands\AuthenticationCommand;
use App;

class BasiAuthenticationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        // App::singleton('Luckys\BasicAithentication\Console\Kernel');
        // include __DIR__ . '/Console/Kernel.php';
         $this->publishes([
            __DIR__.'/Config/admin-auth.php' => config_path('admin-auth.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->commands([
            AuthenticationCommand::class
        ]);

        include __DIR__ . '/routes.php';
    }
}
