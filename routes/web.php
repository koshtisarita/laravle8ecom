<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestdemosController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\MainWebController;
use App\Http\Controllers\Backend\BrandController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


 
require __DIR__.'/auth.php'; 

/*-----------ADMIN CONTROLLER-------------------*/
   
Route::group(['middleware' => ['IsAdmin']], function () {
    Route::get('/view-dashboard',[MainAdminController::class,'dashboard'])->name('admindashboard');


    /*--------- Brand Routes-----*/
    Route::get('/view-brands',[MainAdminController::class,'viewbrand'])->name('viewbrand');
    Route::prefix('brand')->group(function(){
        Route::post('/add',[BrandController::class,'store'])->name('add.brand');
        Route::get('/edit/{brand}',[BrandController::class,'edit'])->name('edit.brand');
        Route::post('/update/{brand}',[BrandController::class,'update'])->name('update.brand');
        Route::get('/delete/{brand}',[BrandController::class,'destroy'])->name('delete.brand');
    });


    Route::get('/view-sizes', [MainAdminController::class,'viewsize'])->name('viewsize');
    Route::get('/view-incode', [MainAdminController::class,'viewpincode'])->name('viewpincode');
    Route::get('/view-setting', [MainAdminController::class,'viewsetting'])->name('viewsetting'); 
    
   
});




/*---------------- END OF ADMIN ROUTES-----------------*/
 
 
Route::get('/',  [MainWebController::class,'index'])->name('index');
Route::get('/login-registration',  [MainWebController::class,'loginpage'])->name('login-page');
Route::get('redirect/{driver}', [MainWebController::class,'redirectToProvider']);
Route::get('auth/google/callback', [MainWebController::class,'handleGoogleCallback']);
Route::post('/login-registration',  [MainWebController::class,'store'])->name('loginform');
Route::get('/active-account/{uid}',  [MainWebController::class,'activation']);
Route::get('/contact-us',  [MainWebController::class,'contactus'])->name('contact-us');
Route::get('/about-us',  [MainWebController::class,'aboutus'])->name('about-us');
Route::get('/cart',  [MainWebController::class,'cart'])->name('cart');
Route::get('/product-list',  [MainWebController::class,'product_list'])->name('product-list');
Route::get('/product-detail',  [MainWebController::class,'product_detail'])->name('product-detail');


 






// testDemos Pages Route start from here
// Image Crop demo routes
Route::get('crop-image-upload', [TestdemosController::class,'index']);
Route::post('crop-image-upload ', [TestdemosController::class,'uploadCropImage']);
  
 
//**************************************************/