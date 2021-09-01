<?php

namespace App\Http\Controllers\Superadmin;

use config;
use App\Models\Blog;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Medicineinformation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Database\Seeders\PermissionSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Spatie\Backup\BackupDestination\BackupCollection;



class CommandController extends Controller
{
    public function index(){
        $pageConfigs = ['navbarLarge' => false];
        
       return view('superadmin.command.index',['pageConfigs' => $pageConfigs]);
    }
public function cacheclear () {
            
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Toastr::success("All Cache Clear", "Done");
        return Redirect::to('superadmin/commandlist');
       
}
public function databasecacheclear () {
   
    Cache::flush();
        Toastr::success("All Database Cache Clear", "Done");
        return Redirect::to('superadmin/commandlist');
       
}
public function databasebackupclear () {
    Artisan::call('backup:clean');
        Toastr::success("All Backup Data Clear", "Done");
        return Redirect::to('superadmin/commandlist');
       
}
public function routerclear () {
    Artisan::call('route:clear');
        Toastr::success("All Router Data Clear", "Done");
        return Redirect::to('superadmin/commandlist');
       
}
public function queueclear () {
    Artisan::call('queue:clear');
        Toastr::success("All Queue Data Clear", "Done");
        return Redirect::to('superadmin/commandlist');
       
}
public function eventclear () {
    Artisan::call('event:clear');
        Toastr::success("All Event Data Clear", "Done");
        return Redirect::to('superadmin/commandlist');
       
}
public function telescopeclear () {
   // Artisan::call('sitemonitor:clear');
 
   DB::table('telescope_entries')->delete();
      DB::table('telescope_entries_tags')->delete();
        DB::table('telescope_monitoring')->delete();
   
        Toastr::success("All Telescope Data Clear", "Done");
        return Redirect::to('superadmin/commandlist');
       
}
public function configclear () {
    Artisan::call('config:clear');
        Toastr::success("All Config Data Clear", "Done");
        return Redirect::to('superadmin/commandlist');
       
}
public function cacheall () {
    Artisan::call('view:cache');
  Artisan::call('config:cache');
       Artisan::call('event:cache');
     Artisan::call('route:cache');
    Toastr::success("All Cache ", "Done");
    return Redirect::to('superadmin/commandlist');
   
}

public function databckup () {
      Artisan::call('backup:run --only-db');
   Toastr::success("All Databckup ", "Done");
    return Redirect::to('superadmin/commandlist');
   

}
public function queuework () {
      Artisan::call('queue:work');
   Toastr::success("All Queuework Start", "Done");
    return Redirect::to('superadmin/commandlist');
   
}

public function migratedata () {
    Artisan::call('migrate',
 array(
   '--path' => 'database/migrations',
   '--database' => 'mysql',
   '--force' => true));
 Toastr::success("All Migrate Work", "Done");
  return Redirect::to('superadmin/commandlist');
 
}
public function dbseeder(){
    Artisan::call('db:seed', [
        '--class' => PermissionSeeder::class
    ]);
    Toastr::success("All Seeding Work", "Done");
  return Redirect::to('superadmin/commandlist');
}


public function addcountry(){
    $country=\App\Helpers\CommonFx::Country();
  
    foreach( $country as $can ){
      $list = new Country();
            $list->countryname =$can;
             $list->save();
        

    }
    
    Toastr::success("All Seeding Work", "Done");
  return Redirect::to('superadmin/commandlist');
}

}
