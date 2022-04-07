<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestdemosController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\MainWebController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\PincodeController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\CustomerfeedbackController;
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
    Route::get('/view-brands',[BrandController::class,'viewbrand'])->name('viewbrand');
    Route::prefix('brand')->group(function(){
        Route::post('/add',[BrandController::class,'store'])->name('add.brand');
        Route::get('/get-brand/{brand}',[BrandController::class,'edit'])->name('get.brand');
        // Route::get('/edit/{brand}',[BrandController::class,'edit'])->name('edit.brand');
        Route::post('/update',[BrandController::class,'update'])->name('update.brand');
        Route::get('/delete/{brand}',[BrandController::class,'destroy'])->name('delete.brand');
    });

    /**-------------Size Master Route ---------- */
    Route::get('/view-sizes', [SizeController::class,'viewsize'])->name('viewsize');
    Route::prefix('size')->group(function(){
        Route::post('/add',[SizeController::class,'store'])->name('add.size'); 
        Route::get('/get-size/{size}',[SizeController::class,'edit'])->name('get.size'); 
        Route::post('/update',[SizeController::class,'update'])->name('update.size');
        Route::get('/delete/{size}',[SizeController::class,'destroy'])->name('delete.size');
    });   

    /*----------------Slider Routes -----------------------*/
    Route::get('/view-slider',  [SliderController::class,'viewslider'])->name('viewslider');
    Route::prefix('slider')->group(function(){
        Route::post('/add',[SliderController::class,'store'])->name('add.slider');
        Route::get('/update-status/{slider}',[SliderController::class,'update_status'])->name('update-status.slider');
        Route::get('/get-slider/{slider}',[SliderController::class,'edit'])->name('get.slider'); 
        Route::post('/update',[SliderController::class,'update'])->name('update.slider');
        Route::get('/delete/{slider}',[SliderController::class,'destroy'])->name('delete.slider');
    });

    Route::get('/view-pincode', [PincodeController::class,'viewpincode'])->name('viewpincode');
    Route::prefix('pincode')->group(function(){
        Route::post('/add',[PincodeController::class,'store'])->name('add.pincode');
        Route::get('/update-status/{pincode}',[PincodeController::class,'update_status'])->name('update-status.pincode');       
        Route::get('/delete/{pincode}',[PincodeController::class,'destroy'])->name('delete.pincode');
    });



    Route::get('/view-category', [CategoryController::class,'viewcategory'])->name('viewcategory');
    Route::prefix('category')->group(function(){
        Route::post('/add',[CategoryController::class,'store'])->name('add.category');      
        Route::get('/get-category/{category}',[CategoryController::class,'edit'])->name('get.category'); 
        Route::post('/update',[CategoryController::class,'update'])->name('update.category');
        Route::get('/delete/{category}',[CategoryController::class,'destroy'])->name('delete.category');
    });

    /********** SubcategoryRoutes *************/ 

    Route::get('/view-subcategory', [SubCategoryController::class,'viewsubcategory'])->name('viewsubcategory');
    Route::prefix('subcategory')->group(function(){
        Route::post('/add',[SubCategoryController::class,'store'])->name('add.subcategory');      
        Route::get('/get-category/{subcategory}',[SubCategoryController::class,'edit'])->name('get.subcategory'); 
        Route::post('/update',[SubCategoryController::class,'update'])->name('update.subcategory');
        Route::get('/delete/{subcategory}',[SubCategoryController::class,'destroy'])->name('delete.subcategory');
    });

    /********** Product Routes *************/  
    Route::get('/view-product', [ProductController::class,'viewproduct'])->name('viewproduct');
    Route::prefix('products')->group(function(){
        // Route::get('add_product', [ProductController::class,'createStepOne'])->name('products.create.step.one');
        // Route::post('add_product', [ProductController::class,'store'])->name('add.product');
 
        Route::get('add', [ProductController::class,'createStepOne'])->name('products.create.step.one');
        Route::post('add', [ProductController::class,'postStepOne'])->name('add.product');
        Route::get('edit/{product}', [ProductController::class,'edit'])->name('product.edit');
        Route::post('update', [ProductController::class,'update'])->name('products.update');        
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/update-status/{product}',[ProductController::class,'update_status'])->name('update-status.product');
        Route::get('/update-stock/{product}',[ProductController::class,'update_stock'])->name('update-stock.product');
        Route::post('/get-description',[ProductController::class,'get_description'])->name('get.description.product');

        //image
        Route::get('view-image/{product}', [ProductController::class, 'image'])->name('product.image.view');
        Route::post('/add-image',[ProductController::class,'storeImage'])->name('add.image'); 
        Route::get('/delete-image/{image}',[ProductController::class,'destroyImage'])->name('delete.image');
        


	    Route::get('/slug/validate', [ProductController::class,'validateSlug'])->name('products.slug.validate');

       

        //Product Trash Route
        Route::get('trash', [ProductController::class, 'trash_index'])->name('product.trash.index');
        Route::get('restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
        Route::get('restore-all', [ProductController::class, 'restoreAll'])->name('product.restoreAll');
    });

    Route::get('/view-setting', [MainAdminController::class,'viewsetting'])->name('viewsetting'); 


    
   
});




/*---------------- END OF ADMIN ROUTES-----------------*/
 
 
Route::get('/',  [MainWebController::class,'index'])->name('index');
Route::get('/login-registration',  [MainWebController::class,'loginpage'])->name('login-page');
//  login with social media
Route::get('redirect/{driver}', [MainWebController::class,'redirectToProvider']);
Route::get('auth/google/callback', [MainWebController::class,'handleGoogleCallback']);
Route::post('/login-registration',  [MainWebController::class,'store'])->name('loginform');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/myaccount',  [MainWebController::class,'myaccount'])->name('myaccount'); 
    Route::post('/update-account',  [MainWebController::class,'update_account'])->name('update-account'); 
});

// Route::get('/wishlist',  [MainWebController::class,'wishlist'])->name('wishlist')->middleware('auth');


Route::get('/active-account/{uid}',  [MainWebController::class,'activation']);
Route::get('/contact-us',  [MainWebController::class,'contactus'])->name('contact-us');
Route::get('/about-us',  [MainWebController::class,'aboutus'])->name('about-us');
Route::get('/all-brands',[MainWebController::class,'aboutus'])->name('all-brands');
Route::get('/cart',  [MainWebController::class,'cart'])->name('cart');

Route::get('/product-list',  [MainWebController::class,'product_list'])->name('product-list');
Route::get('/product-detail',  [MainWebController::class,'product_detail'])->name('product-detail');


 






// testDemos Pages Route start from here
// Image Crop demo routes
Route::get('crop-image-upload', [TestdemosController::class,'index']);
Route::post('crop-image-upload ', [TestdemosController::class,'uploadCropImage']);
  
 
//**************************************************/



/*--------------------- CUSTOMER PANEL------------------------*/
Route::get('/customerfeedback',function(){
    return view('website.pages.customerfeedback');
})->name('customerfeedback');
Route::post('/customerfeedback/store',[CustomerfeedbackController::class,'store'])->name('customerfeedback.store');