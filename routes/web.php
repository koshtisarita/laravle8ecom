<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestdemosController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\MainWebController;
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
   
Route::group(['middleware' => ['IsAdmin']], function () {

 
    Route::get('/view-dashboard',[MainAdminController::class,'dashboard'])->name('admindashboard');
    Route::get('/view-brands',[MainAdminController::class,'viewbrand'])->name('viewbrand');
    Route::get('/view-sizes', [MainAdminController::class,'viewsize'])->name('viewsize');
    Route::get('/view-incode', [MainAdminController::class,'viewpincode'])->name('viewpincode');
    Route::get('/view-setting', [MainAdminController::class,'viewsetting'])->name('viewsetting');
    
});
 
 
Route::get('/', function () {
    return view('website.pages.index');
});
 






// testDemos Pages Route start from here
// Image Crop demo routes
Route::get('crop-image-upload', [TestdemosController::class,'index']);
Route::post('crop-image-upload ', [TestdemosController::class,'uploadCropImage']);
  
 
//**************************************************/