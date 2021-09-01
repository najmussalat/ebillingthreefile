<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//
Route::post('blogimageresize', 'ImageUploadController@blogpostimageresize');
Route::post('diseasepostimageresize', 'ImageUploadController@diseasepostimageresize');
Route::post('medicinepostimageresize', 'ImageUploadController@medicinepostimageresize');
Route::post('blogimageresize', 'ImageUploadController@blogimageresize');


//for flora imge upload


//
Route::get('index', 'HomeController@index'); //for home
Route::get('home', 'HomeController@home'); //for home
Route::post('/contact', 'ContactController@store'); //for contact form
Route::post('uploadtexteditorimage', 'ImageUploadController@index'); //for flora imge upload

Route::post('alldiseasename','DiseaseController@alldisease'); //for get all diseage name
Route::post('alldisease','DiseaseController@alldiseaseinfo'); //for get  diseage-medicine name
Route::post('allupdiseaseinfo','DiseaseController@allupdiseaseinfo'); //for get  allupdatedisease name
Route::post('editalldisease','DiseaseController@editalldisease'); //for get all editalldisease
Route::post('allmedicinename','MedicineController@allmedicine'); //for allmedisinename name

Route::post('forgatepassword','UserController@forgatepass'); //for forgate password generate 
Route::get('medisioneinfodetails/{id}', 'MedisineController@show');//for user productreview




 //Deseagsemedicineinformation Start
 Route::get('disease','DiseaseController@diseaseinfo'); //for get all diseage 
 Route::get('disease-info/{id}','DiseaseController@show');  

 //disease Start
  
 Route::get('diseasemedicineinformation','DisemedicineController@index');
 Route::get('diseasemedicineinformation/{id}','DisemedicineController@diseasemedicine');
 //  Route::put('updatedisease/{id}','DisemedicineController@update');
 //  Route::delete('deletedisease/{id}','DisemedicineController@destroy');
  //disease  End

  //medicineinformation area start
  Route::get('/homeo-info/{id}', 'MedicineinformationController@show'); //for medicineinformation

  //medicineinformation area end
  
    //blog area start
     Route::get('blogs', 'BlogController@index'); //for blog
  Route::get('/info/{id}', 'BlogController@show'); //for blog

  //blog area end




//division value get
Route::get('division','DivisionController@index'); //for user
// Route::get('divisonstore','DivisionController@store'); //for user

//division value get
Route::get('division','DistrictController@index'); //for user
Route::get('districtstore','DistrictController@store'); //for user
//thana value get
Route::get('thana','ThanaController@index'); //for user
Route::get('thanastore','ThanaController@store'); //for user

//user view area start
 Route::get('profile/{id}','UserController@profile'); //for user profile with post
   Route::post('login','LoginController@login'); //for user Logout
Route::post('register','UserController@store'); //for user register
Route::group([
    'prefix'=>'user',
    'namespace' => 'User',
    'middleware'=>'auth:api',
    // 'verify' => true
       ],

function () {
  
    Route::post('logout','UserController@logout'); //for user Logout
Route::post('me','UserController@me'); //for user 

    // Route::get('medisioneinfodetails/{id}', 'MedisineinfoController@show');//for user productreview
   
});