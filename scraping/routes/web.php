<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loeschscraping;
use App\Http\Controllers\DartenMoreController;
use App\Http\Controllers\GambioProjectController;
use App\Http\Controllers\GambioCategoryController;
use App\Http\Controllers\GambioProductLinkController;
// use App\Http\Controllers\GambioProductLinkController;
// use App\Http\Controllers\GambioProductLinkController;

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

Route::resource('loeschscraping',loeschscraping::class);


Route::resource('datenmore',DartenMoreController::class);

Route::resource('gambioProject',GambioProjectController::class);
Route::resource('gambioProjectCategory',GambioCategoryController::class);
Route::get('gambioProjectCategory/index/{id}',[GambioCategoryController::class,'index'])->name('gambioProjectCategory.index');
Route::get('gambioProjectCategory/create/{id}',[GambioCategoryController::class,'create'])->name('gambioProjectCategory.create');
Route::resource('gambioProjectProduct',GambioProductLinkController::class);
Route::get('gambioProjectProduct/index/{id}',[GambioProductLinkController::class,'index'])->name('gambioProjectProduct.index');
Route::get('gambioProjectProduct/create/{id}',[GambioProductLinkController::class,'create'])->name('gambioProjectProduct.create');
Route::resource('gambioProjectProductDetail',GambioProductLinkController::class);
Route::resource('gambioProjectProductReview',GambioProductLinkController::class);

