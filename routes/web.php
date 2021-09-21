<?php 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/testview', function () {
        return view('test.index');
    }

);

//gobal location 
Route::get('/location', 'OnchangeController@index');
Route::get('getdistrict/{id}', 'OnchangeController@district');
Route::get('getthana/{id}', 'OnchangeController@thana');
Route::get('getarea/{id}', 'OnchangeController@area');
Route::get('gettpackageinfo/{id}', 'OnchangeController@package');
Route::get('getcustomerinfo', 'OnchangeController@customerinfo');
Route::get('gettsmstypeinfo/{id}', 'OnchangeController@smstype');
Route::get('getpaymentmessage/{id}', 'OnchangeController@payment');


Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/blog.xml', 'SitemapController@blog');
Route::get('/homeoinfo.xml', 'SitemapController@homeoinfo');
Route::get('/disease.xml', 'SitemapController@disease');

Route::get('/', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/user', 'Auth\LoginController@showAdminLoginForm');
Auth::routes(['verify'=> true]);
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/admin/verificationlink/{id}', 'Auth\LoginController@showEmailveirfyForm');
Route::get('/admin/verificationphone/{id}', 'Auth\LoginController@showOTPveirfyForm');
Route::post('/admin/adminverifyphone', 'Auth\LoginController@adminverifyphone');
Route::post('/admin/adminverifyemail', 'Auth\LoginController@adminverifyemail');

Route::get('/login/superadmin', 'Auth\LoginController@showSuperadminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');


Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::get('/login/user', 'Auth\LoginController@showLoginuserForm');
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
  Route::post('adminstatus', 'AdminController@setapproval'); 
   //Accountcreate  End


//smssettinglist Start 

Route::get('smssettinglist','SmsController@index');
Route::get('editsmssetting/{id}','SmsController@edit');
 Route::patch('updatesmssetting/{id}','SmsController@update');
Route::post('searchsmssetting', 'SmsController@searchmedicine');
Route::get('smstypelist', 'SmsController@smstype');
Route::get('createsmstype', 'SmsController@createsmstype');
Route::post('createsmstype', 'SmsController@smstypestore');
Route::get('editsmstype/{id}', 'SmsController@editsmstype');
Route::patch('updatesmstype/{id}', 'SmsController@smstypeupdate');

//smssettinglist  End

//salesms Start 

Route::get('salesmslist','BuysmsController@index');
Route::get('createsalesms','BuysmsController@create');
Route::post('createsalesms','BuysmsController@store');
Route::get('editsalesms/{id}','BuysmsController@edit');
Route::patch('updatesalesms/{id}','BuysmsController@update');
Route::post('searchsalesms', 'BuysmsController@searchmedicine');
Route::post('aprovesalesms/{id}', 'BuysmsController@setapproval');
Route::delete('deletesalesms/{id}','BuysmsController@destroy');
//smssettinglist  End

//payment Start 

Route::get('paymentlist','PaymentController@index');
Route::get('createpayment','PaymentController@create');
Route::post('createpayment','PaymentController@store');
Route::get('editpayment/{id}','PaymentController@edit');
 Route::patch('updatepayment/{id}','PaymentController@update');
 Route::delete('deletepayment/{id}','PaymentController@destroy');

//payment  End


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


//Sitemap  End

//Contact Start 

Route::get('emaillist','ContactController@index');
Route::get('createemail','ContactController@create');
Route::post('fdgfcreateblog','ContactController@store');
Route::get('replymail/{id}','ContactController@edit');
Route::post('replyemail','ContactController@store');


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
Route::post('searcharea', 'AreaController@search');

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
Route::post('sendsmscustomer','CustomerController@sendsmscustomer');
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
 Route::post('blogstatus', 'CollectionController@setapproval');
Route::post('searchsinglecustomer', 'CollectionController@searchsinglecustomer');
Route::post('searchsinglecustomerbill', 'CollectionController@singlecustomerbill');
Route::get('cancelcollection', 'CollectionController@cancelcollection');
Route::delete('cancelcollection/{id}', 'CollectionController@collectiondelete');
//Collection  End


//Complain Start 
Route::get('complainlist','ComplainController@index');
Route::get('createcomplain','ComplainController@create');
Route::post('createcomplain','ComplainController@store');
Route::get('editcomplain/{id}','ComplainController@edit');
Route::get('replycomplain/{id}','ComplainController@show');
Route::post('replycomplaintext','ComplainController@replycomplain');
Route::post('addcomplaintext','ComplainController@addcomplaintext');
 Route::patch('updatecomplain/{id}','ComplainController@update');
 Route::delete('deletecomplain/{id}','ComplainController@destroy');
 Route::post('closecomplain/{id}','ComplainController@closecomplain');
Route::post('searchsinglecustomerforcomplain', 'ComplainController@searchsinglecustomer');
Route::get('complainsetting', 'ComplainController@opencomplainsetting');
Route::post('complainsetting', 'ComplainController@storecomplainsetting');
Route::get('editcomplainsetting/{id}', 'ComplainController@editcomplainsetting');
Route::put('editcomplainsetting/{id}', 'ComplainController@updatecomplainsetting');
Route::delete('deletecomplainsetting/{id}', 'ComplainController@deletecomplainsetting');
//Complain  End

//buysms Start 

Route::get('buysmslist','BuysmsController@index');
Route::get('createbuysms','BuysmsController@create');
Route::post('createbuysms','BuysmsController@store');
Route::get('editbuysms/{id}','BuysmsController@edit');
Route::patch('updatebuysms/{id}','BuysmsController@update');
Route::post('searchbuysms', 'BuysmsController@searchmedicine');
Route::get('showbuysmsdetails/{id}', 'BuysmsController@show');
Route::get('downloadesmsinvoice/{id}','PdfController@buysmsinvoice');
//buysms  End



   //AccountRole Start
   Route::get('accountrolelist','RoleController@index');
   Route::post('rolesearch','RoleController@rolesearch');
   Route::get('createaccountrole','RoleController@create');
   Route::post('createaccountrole','RoleController@store');
   Route::post('allpermissionlist','RoleController@allpermissionlist');
   Route::get('editaccountrole/{id}','RoleController@edit');
   Route::get('showrolepermission/{id}','RoleController@show');
   Route::put('updateaccountrole/{id}','RoleController@update');
   Route::delete('deleteaccountrole/{id}','RoleController@destroy');
   //AccountRole End


   
   //user create Start
   Route::get('userlist','UserController@index');
   Route::post('searchuser','UserController@search');
   Route::post('allrolename','UserController@allrolename');
   Route::get('createuser','UserController@create');
   Route::post('createuser','UserController@store');
   Route::get('edituser/{id}','UserController@edit');
   Route::patch('updateuser/{id}','UserController@update');
  Route::delete('deleteuser/{id}','UserController@destroy');
  Route::post('userstatus', 'UserController@setapproval'); 
   //user create  End
       
    }
);


Route::group([ 'prefix'=>'user',
    'namespace'=>'User',
    'middleware'=> 'auth',
   

    ], function() {
        Route::get('dashboard', 'DashboardController@index');
       
       
    }
);