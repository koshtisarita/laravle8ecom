<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware([auth::class])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/admindashboard', function () {
        return view('admin.dashboard');
    })->name('admindashboard');
    Route::get('/adminbrands', function () {
        return view('admin.masters.viewbrand');
    })->name('viewbrand');
    Route::get('/adminsizes', function () {
        return view('admin.masters.viewsize');
    })->name('viewsize');
    Route::get('/viewpincode', function () {
        return view('admin.masters.viewpincode');
    })->name('viewpincode');
     
});
 
require __DIR__.'/auth.php';
