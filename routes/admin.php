<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:admin', 'prefix' => 'Admin'], function () {
    Route::get('/',[AdminController::class , 'index'] )->name('Admin');
    Route::get('/logout',[LoginController::class , 'logout'] )->name('admin.logout');

    // ------------------------------Start Categories--------------------------------------------

    Route::resource('Category', CategoryController::class)->except('show');

    // ------------------------------End Categories--------------------------------------------


    // ------------------------------Start Settings--------------------------------------------

      Route::resource('Settings', SettingController::class);
   // Route::get('shipping-methods/{type}', 'SettingController@editShippingMethods')->name('edit.shippings.methods');
   // Route::put('shipping-methods/{id}', 'SettingController@updateShippingMethods')->name('update.shippings.methods');

    // ------------------------------End Settings--------------------------------------------



    // ------------------------------Start Users--------------------------------------------

    Route::resource('Users', UserController::class);

    // ------------------------------End Users--------------------------------------------


    // ------------------------------Start profile--------------------------------------------

    Route::get('profile', [AdminController::class,'profile'])->name('admin.profile');
    Route::put('profile/{id}', [AdminController::class,'updateprofile'])->name('admin.update.profile');

    // ------------------------------End profile--------------------------------------------



    // ------------------------------Start Products--------------------------------------------

    Route::resource('Products', ProductController::class);
  //  Route::put('Products/Priceupdate/{id}', 'ProductController@Priceupdate')->name('Products.Priceupdate');
  //  Route::post('Products/stockupdate/{id}', 'ProductController@stockupdate')->name('Products.stockupdate');

  //  Route::post('Products/imageupdate', 'ProductController@imageupdate')->name('Products.imageupdate');
  //  Route::post('Products/imageupdate/{id}', 'ProductController@imageupdateDB')->name('Products.imageupdate.db');
 //   Route::post('Products/imagedelete', 'ProductController@imagedelete')
   //     ->name('admin.products.images.delete');

  //  Route::post('Products/imagedelete/{id}', 'ProductController@imagedeleteId')
  //      ->name('admin.products.imagedeleteId');
    // ------------------------------End Products--------------------------------------------

    // ------------------------------Start Attribute--------------------------------------------

    Route::resource('Attributes', AttributeController::class);

    // ------------------------------End Attribute--------------------------------------------




    // ------------------------------Start Options----------------------------------------

    Route::resource('Options', OptionController::class);

    // ------------------------------End Options-----------------------------------------

    // ------------------------------Start Contacts-----------------------------------------

    Route::resource('Contact', ContactUsController::class)->only(['index','destroy','show']);

    // ------------------------------End Contacts--------------------------------------------


    // ------------------------------Start Contacts--------------------------------------

    Route::resource('OrderAdmin', OrderController::class);

    // ------------------------------End Contacts--------------------------------------

    // ------------------------------Start Slider--------------------------------------------

   // Route::resource('Slider', 'SliderImagesController');

    // ------------------------------End Slider--------------------------------------------

    // ------------------------------Start Contacts--------------------------------

    Route::resource('coupon', CouponController::class);

    // ------------------------------End Contacts----------------------------------
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    //Get
    Route::get('Users/GetUsers', [UserController::class, 'getUsers'])->name('Users.GetUsers');
    Route::get('Category/GetCategories', [CategoryController::class, 'GetCategories'])->name('Category.GetCategories');
    Route::get('Option/GetOptions', [OptionController::class, 'GetOptions'])->name('Option.GetOptions');
    Route::get('Attribute/GetAttributes', [AttributeController::class, 'GetAttributes'])->name('Attribute.GetAttributes');
});

Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin', 'prefix' => 'Admin'], function () {
    Route::get('login', [LoginController::class , 'login'])->name('admin.login');
    Route::post('login',[LoginController::class , 'postLogin'])->name('admin.post.login');

});
