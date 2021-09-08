<?php 
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/invoiceview', function () {
       return view('admin.customer.padinvoice');
    }
);
Route::get('/smspayreceipt', function () {
    return view('admin.customer.smspayreceipt');
 }
);
Route::get('/user', function () {
    return view('admin.customer.smspayreceipt');
 }
);

Route::get('/show', function () {
    $customer=Customer::first();
    return view('customer.profile.show')->with('customer',$customer);
 }
);
Route::get('/customerview', function () {
    $customer=Customer::first();
    return view('customer.status.customerview');
 }
);
Route::get('/customersupport', function () {
    $customer=Customer::first();
    return view('customer.support.customersupport');
 }
);

//gobal location 
Route::get('/location', 'OnchangeController@index');
Route::get('getdistrict/{id}', 'OnchangeController@district');
Route::get('getthana/{id}', 'OnchangeController@thana');
Route::get('getarea/{id}', 'OnchangeController@area');
Route::get('gettpackageinfo/{id}', 'OnchangeController@package');
Route::get('getcustomerinfo', 'OnchangeController@customerinfo');




Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/blog.xml', 'SitemapController@blog');
Route::get('/homeoinfo.xml', 'SitemapController@homeoinfo');
Route::get('/disease.xml', 'SitemapController@disease');

Route::get('/', 'Auth\LoginController@showAdminLoginForm');

Auth::routes(['verify'=> true]);
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/admin/verificationlink/{id}', 'Auth\LoginController@showEmailveirfyForm');
Route::get('/admin/verificationphone/{id}', 'Auth\LoginController@showOTPveirfyForm');
Route::post('/admin/adminverifyphone', 'Auth\LoginController@adminverifyphone');
Route::post('/admin/adminverifyemail', 'Auth\LoginController@adminverifyemail');

Route::get('/login/superadmin', 'Auth\LoginController@showSuperadminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');


Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/user', 'Auth\LoginController@adminLogin');
Route::post('/login/superadmin', 'Auth\LoginController@superadminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

Route::prefix('admin')->group(function () {

        //admin password reset routes
        Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
        Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    }

);

// locale route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::group(['prefix'=> 'filemanager', 'middleware'=> ['auth:superadmin,admin']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    }

);



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    }

)->middleware(['auth', 'signed'])->name('verification.verify');


Route::group([ 'prefix'=>'superadmin',
    'namespace'=>'Superadmin',
    'middleware'=> 'auth:superadmin'

    ], function() {
        Route::get('dashboard', 'DashboardController@index');
        Route::post('deletenotification', 'DashboardController@deletenotification');
        Route::post('seennotification', 'DashboardController@seennotification');
  //AccountPermission Start
  Route::get('permissionlist','PermissionController@index');
  Route::post('permissionsearch','PermissionController@permissionsearch');
  Route::get('createpermission','PermissionController@create');
  Route::post('createpermission','PermissionController@store');
  Route::get('editpermission/{id}','PermissionController@edit');
  Route::patch('updatepermission/{id}','PermissionController@update');
  Route::delete('deletepermission/{id}','PermissionController@destroy');
  //AccountPermission End

   //AccountRole Start
   Route::get('accountrolelist','RoleController@index');
   Route::get('rolesearch','RoleController@rolesearch');
   Route::get('createaccountrole','RoleController@create');
   Route::post('createaccountrole','RoleController@store');
   Route::post('allpermissionlist','RoleController@allpermissionlist');
   Route::get('editaccountrole/{id}','RoleController@edit');
   Route::get('showrolepermission/{id}','RoleController@show');
   Route::put('updateaccountrole/{id}','RoleController@update');
   Route::delete('deleteaccountrole/{id}','RoleController@destroy');
   //AccountRole End

  


   //Accountcreate Start
   Route::get('adminlist','AdminController@index');
   Route::post('searchadmin','AdminController@adminsearch');
   Route::post('allrolename','AdminController@allrolename');
   Route::get('createadmin','AdminController@create');
   Route::post('createadmin','AdminController@store');
   Route::get('editadmin/{id}','AdminController@edit');
   Route::put('updateadmin/{id}','AdminController@update');
  Route::delete('deleteteadmin/{id}','AdminController@destroy');
  Route::post('adminstatus', 'AdminController@setapproval'); //for inactive account status
//   Route::post('adminsetstatusactive/{id}', 'AdminController@adminsetstatusactive');//for active account status


   //Accountcreate  End

   //Deseagse Start
   Route::get('diseaselist','DiseaseController@index');
   Route::get('createdisease','DiseaseController@create');
   Route::post('createdisease','DiseaseController@store');
   Route::get('editdisease/{id}','DiseaseController@edit');
    Route::patch('updatedisease/{id}','DiseaseController@update');
    Route::delete('deletedisease/{id}','DiseaseController@destroy');
Route::post('diseasestatus', 'DiseaseController@setapproval');
   Route::post('searchdisease', 'DiseaseController@searchdisease');
  //Deseagse  End

    //Deseagsemedicineinformation Start
    Route::get('disemedicinelist','DisemedicineController@index');
    Route::get('createdisemedicinelist','DisemedicineController@create');
    Route::post('createdisemedicinelist','DisemedicineController@store');
    Route::get('editdisemedicinelist/{id}','DisemedicineController@edit');
     Route::patch('updatedisemedicinelist/{id}','DisemedicineController@update');
     Route::delete('deletedisemedicinelist/{id}','DisemedicineController@destroy');
 Route::post('disemedicineliststatus', 'DisemedicineController@setapproval');
    Route::post('searchdisemedicinelist', 'DisemedicineController@searchdisemedicine');
     
    //Deseagsemedicineinformation  End
  

//Medisine Start
Route::get('medicinelist','MedicineController@index');
Route::get('createmedicinelist','MedicineController@create');
Route::post('createmedicinelist','MedicineController@store');
Route::get('editmedicinelist/{id}','MedicineController@edit');
 Route::patch('updatemedicinelist/{id}','MedicineController@update');
 Route::delete('deletemedicinelist/{id}','MedicineController@destroy');
Route::post('medicinestatus', 'MedicineController@setapproval');
Route::post('searchmedicine', 'MedicineController@searchmedicine');
//Medisine  End

//Medicineinfo Start 

Route::get('medicineinformationlist','MedicineinformationController@index');
Route::get('createmedicineinformation','MedicineinformationController@create');
Route::post('createmedicineinformation','MedicineinformationController@store');
Route::get('editmedicineinformation/{id}','MedicineinformationController@edit');
 Route::patch('updatemedicineinformation/{id}','MedicineinformationController@update');
 Route::delete('deletemedicineinformation/{id}','MedicineinformationController@destroy');
Route::post('medicineinfostatus', 'MedicineinformationController@setapproval');
Route::post('searchmedicine', 'MedicineinformationController@searchmedicine');

//Medisineinfo  End


//Blog Start 

Route::get('bloglist','BlogController@index');
Route::get('createblog','BlogController@create');
Route::post('createblog','BlogController@store');
Route::get('editblog/{id}','BlogController@edit');
 Route::patch('updateblog/{id}','BlogController@update');
 Route::get('deleteblog/{id}','BlogController@destroy');
Route::post('blogstatus', 'BlogController@setapproval');
Route::post('searchblog', 'BlogController@searchblog');

//Blog  End


//countryy 
Route::get('countrylist','CountryController@index');
Route::post('searchcountry','CountryController@search');
Route::get('createcountry','CountryController@create');
Route::post('createcountry','CountryController@store');
Route::get('editcountry/{id}','CountryController@edit');
 Route::patch('updatecountry/{id}','CountryController@update');
 Route::delete('deletecountry/{id}','CountryController@destroy');
//Division Start 

 
 
 Route::get('divisionlist','DivisionController@index');
Route::post('searchdivision','DivisionController@search');
Route::get('createdivision','DivisionController@create');
Route::post('createdivision','DivisionController@store');
Route::get('editdivision/{id}','DivisionController@edit');
 Route::patch('updatedivision/{id}','DivisionController@update');
 Route::delete('deletedivision/{id}','DivisionController@destroy');


//Division  End

//district Start 

Route::get('districtlist','DistrictController@index');
Route::post('searchdistrict','DistrictController@search');
Route::get('createdistrict','DistrictController@create');
Route::post('createdistrict','DistrictController@store');
Route::get('editdistrict/{id}','DistrictController@edit');
 Route::patch('updatedistrict/{id}','DistrictController@update');
 Route::delete('deletedistrict/{id}','DistrictController@destroy');


//district  End


//Thana Start 

Route::get('thanalist','ThanaController@index');
Route::get('createthana','ThanaController@create');
Route::post('createthana','ThanaController@store');
Route::get('editthana/{id}','ThanaController@edit');
 Route::patch('updatethana/{id}','ThanaController@update');
 Route::get('deletethana/{id}','ThanaController@destroy');
Route::post('searchthana', 'ThanaController@searchblog');

//Thana  End

//Sitemap Start 

 Route::get('addcountry','CommandController@addcountry');
 Route::get('commandlist','CommandController@index');
 Route::get('cacheclear','CommandController@cacheclear');
 Route::get('databasebackupclear','CommandController@databasebackupclear');
 Route::get('routerclear','CommandController@routerclear');
 Route::get('queueclear','CommandController@queueclear');
 Route::get('eventclear','CommandController@eventclear');
 Route::get('telescopeclear','CommandController@telescopeclear');
 Route::get('configclear','CommandController@configclear');
 Route::get('cache','CommandController@cacheall');
  Route::get('databasecacheclear','CommandController@databasecacheclear');
 Route::get('dbseeder','CommandController@dbseeder');
 Route::get('databckup','CommandController@databckup');
 Route::get('queuework','CommandController@queuework');
 Route::get('migratedata','CommandController@migratedata');
 Route::get('blogsitemap','SitemapController@blogsitemapgenerate');
 Route::get('allsitemap','SitemapController@allsitemap');


// Route::get('editblog/{id}','SitemapController@edit');
//  Route::patch('updateblog/{id}','SitemapController@update');
//  Route::get('deleteblog/{id}','SitemapController@destroy');
// Route::post('blogstatus', 'SitemapController@setapproval');
// Route::post('searchblog', 'SitemapController@searchblog');

//Sitemap  End

//Contact Start 

Route::get('emaillist','ContactController@index');
Route::get('createemail','ContactController@create');
Route::post('fdgfcreateblog','ContactController@store');
Route::get('replymail/{id}','ContactController@edit');
Route::post('replyemail','ContactController@store');

 //Route::patch('updateblog/{id}','ContactController@update');
 //Route::get('deleteblog/{id}','ContactController@destroy');
//Route::post('blogstatus', 'ContactController@setapproval');
//Route::post('searchblog', 'ContactController@searchblog');

//Contact  End

    }

);

Route::group([ 'prefix'=>'admin',
    'namespace'=>'Admin',
    'middleware'=> 'auth:admin',
   

    ], function() {
        Route::get('dashboard', 'DashboardController@index');
        Route::post('seennotification', 'DashboardController@seennotification');
        Route::post('deletenotification', 'DashboardController@deletenotification');
        Route::get('profile', 'AdminController@profile');
        Route::post('checkprofile', 'AdminController@checkprofile');
        Route::post('updateprofilephoto', 'AdminController@updateprofilephoto');
        Route::patch('updateprofileinfo/{id}', 'AdminController@updateprofileinfo');
        Route::post('updatepassword', 'AdminController@updatepassword');
       
//area list

Route::get('arealist','AreaController@index');
Route::get('createarea','AreaController@create');
Route::post('createarea','AreaController@store');
Route::get('editarea/{id}','AreaController@edit');
 Route::patch('updatearea/{id}','AreaController@update');
 Route::delete('deletearea/{id}','AreaController@destroy');
Route::post('searcharea', 'AreaController@searchblog');

   //Merchant Start
   Route::get('merchantlist','MerchantController@index');
   Route::get('createmerchant','MerchantController@create');
   Route::post('createmerchant','MerchantController@store');
   Route::get('editmerchant/{id}','MerchantController@edit');
    Route::patch('updatemerchant/{id}','MerchantController@update');
    Route::delete('deletemerchant/{id}','MerchantController@destroy');
Route::post('merchantstatus', 'MerchantController@setapproval');
   Route::post('searchmerchant', 'MerchantController@search');
  //Merchant  End

    //createpackage Start
    Route::get('packagelist','PackageController@index');
    Route::get('createpackage','PackageController@create');
    Route::post('createpackage','PackageController@store');
    Route::get('editpackage/{id}','PackageController@edit');
     Route::patch('updatepackage/{id}','PackageController@update');
     Route::delete('deletepackage/{id}','PackageController@destroy');
 Route::post('packagestatus', 'PackageController@setapproval');
    Route::post('searchpackage', 'PackageController@search');
     
    //createpackage  End
  
    //payby Start
    Route::get('paybylist','PaybyController@index');
    Route::get('createpayby','PaybyController@create');
    Route::post('createpayby','PaybyController@store');
    Route::get('editpayby/{id}','PaybyController@edit');
     Route::patch('updatepayby/{id}','PaybyController@update');
     Route::delete('deletepayby/{id}','PaybyController@destroy');
   Route::post('searchpayby', 'PaybyController@search');
     
    //payby  End
  

//Customer Start
Route::get('customerlist','CustomerController@index');
Route::get('pendingcustomerlist','CustomerController@pendingcustomer');
Route::get('createcustomer','CustomerController@create');
Route::post('createcustomer','CustomerController@store');
Route::get('editcustomer/{id}','CustomerController@edit');
Route::get('customerprofile/{id}','CustomerController@show');
 Route::patch('updatecustomer/{id}','CustomerController@update');
 Route::delete('deletecustomer/{id}','CustomerController@destroy');
Route::post('customerstatus', 'CustomerController@setapproval');
Route::post('searchcustomer', 'CustomerController@searchmedicine');
Route::get('findbill/{id}','CustomerController@findbill');
Route::post('updatebillcustomer','CustomerController@updatebillcustomer');
Route::get('inactivecustomer','CustomerController@inactivecustomer');
Route::get('inactivecustomerfind','CustomerController@findinactivecustomer');
Route::get('restorecustomer/{id}','CustomerController@restorecustomer');
//Customer  End
//sms Start
Route::get('smsmessagesetting','SmsController@index');
Route::patch('updatesmssetting/{id}','SmsController@update');
Route::get('printsetting','PrintController@index');
Route::patch('updateprintsetting/{id}','PrintController@update');

//sms  End

//print
Route::get('monthlyprint','PrintController@monthly');
Route::get('printlocationwise','PrintController@printlocationwise');
Route::get('billlocationwise','PrintController@billlocationwise');
Route::get('printbylocation','PrintController@printbylocation');


//print end
//Collection Start 

Route::get('collection','CollectionController@index');
Route::get('createcollection','CollectionController@create');
Route::post('createcollection','CollectionController@store');
Route::get('editcollect/{id}','CollectionController@edit');
 Route::put('updatecollection/{id}','CollectionController@update');
 Route::get('deleteblog/{id}','CollectionController@destroy');
Route::post('blogstatus', 'CollectionController@setapproval');
Route::post('searchsinglecustomer', 'CollectionController@searchsinglecustomer');
Route::post('searchsinglecustomerbill', 'CollectionController@singlecustomerbill');
Route::get('cancelcollection', 'CollectionController@cancelcollection');
Route::delete('cancelcollection/{id}', 'CollectionController@collectiondelete');
//Collection  End


       
    }
);