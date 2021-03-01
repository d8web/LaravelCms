<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Page;
use App\Models\Setting;

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
    // Retorna informações para serem acessadas em qualquer view do sistema.
    public function boot()
    {
        // Menu
        $frontMenu = [
            '/' => 'Home'
        ];

        $pages = Page::all();
        foreach($pages as $page) {
            $frontMenu[$page['slug']] = $page['title'];
        }

        View::share('front_menu', $frontMenu);

        // Configurações
        $config = [];

        $settings = Setting::all();
        foreach($settings as $setting)
        {
            $config[$setting['name']] = $setting['content'];
        }

        View::share('front_config', $config);
    }
}
