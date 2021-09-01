<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
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
        // get all data from menu.json file
        // $verticalMenuJson = file_get_contents(base_path('resources/json/verticalMenu.json'));

        // $verticalMenuData= json_decode($verticalMenuJson);
        // $horizontalMenuJson=file_get_contents(base_path('resources/json/horizontalMenu.json'));
        // $horizontalMenuData= json_decode($horizontalMenuJson);

        // share all menuData to all the views



        // View::share('menuData',[$verticalMenuData, $horizontalMenuData]) ;
        view()->composer('admin/*', function ($view) {
        //my desing
        $verticalAdminMenuJson = file_get_contents(base_path('resources/json/verticalAdminMenu.json'));
        
        $verticalAdminMenuData= json_decode($verticalAdminMenuJson);
      
        
       
        View::share('AdminmenuData',[$verticalAdminMenuData]);
    }); 
    view()->composer('superadmin/*', function ($view) {
        $verticalSuperdminMenuJson = file_get_contents(base_path('resources/json/verticalSuperadminMenu.json'));
        
        $verticalSuperadminMenuData= json_decode($verticalSuperdminMenuJson);
                    
       View::share('SuperadminmenuData',[$verticalSuperadminMenuData]) ;
     }); 
    }

}
