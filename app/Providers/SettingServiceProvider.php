<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Providers\SettingServiceProvider;

use Config;
use App\Models\Setting;

class SettingServiceProvider extends ServiceProvider
{
    //  sono andato a vedere la repository on github,
    // e mi sono accorto, che lui nel codice aveva in piu
    // questa variabile $defer.

    /**
     * @var bool
     */
    // protected $defer = false;
        
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('settings', function ($app) {
          return new Setting();
        });

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', Setting::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // only use the Settings package if the Settings table is present in the database
        if (!\App::runningInConsole() && count(Schema::getColumnListing('settings'))) {
        $settings = Setting::all();
        foreach ($settings as $key => $setting)
        {
          Config::set('settings.'.$setting->key, $setting->value);
        }
      }
    }

}
