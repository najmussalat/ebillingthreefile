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
    
        view()->composer('admin/*', function ($view) {
        //my desing
        $verticalAdminMenuJson = file_get_contents(base_path('resources/json/verticalAdminMenu.json'));
        
        $verticalAdminMenuData= json_decode($verticalAdminMenuJson);
      
        View::share('AdminmenuData',[$verticalAdminMenuData]);
    }); 
	    
        view()->composer('user/*', function ($view) {
        //my desing
        $verticalUserMenuJson = file_get_contents(base_path('resources/json/verticalUserMenu.json'));
        $verticalUserMenuData= json_decode($verticalUserMenuJson);
      
        View::share('UsermenuData',[$verticalUserMenuData]);
    }); 
	
	        view()->composer('customer/*', function ($view) {
        //my desing
        $verticalCustomerMenuJson = file_get_contents(base_path('resources/json/verticalCustomerMenu.json'));
        $verticalCustomerMenuData= json_decode($verticalCustomerMenuJson);
      
        View::share('CustomermenuData',[$verticalCustomerMenuData]);
    }); 
	
    view()->composer('superadmin/*', function ($view) {
        $verticalSuperdminMenuJson = file_get_contents(base_path('resources/json/verticalSuperadminMenu.json'));
        
        $verticalSuperadminMenuData= json_decode($verticalSuperdminMenuJson);
                    
       View::share('SuperadminmenuData',[$verticalSuperadminMenuData]) ;
     }); 
    }

}
