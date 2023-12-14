<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('/admin/login');
});
Route::get('/admin', function () {
    return redirect('/admin/login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'preventBackHistory'])->group(function () {
        Route::view('/login', 'admin.auth.login')->name('login');
        Route::view('/register', 'admin.auth.register')->name('register');
        Route::post('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin', 'preventBackHistory'])->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::view('/home', 'admin.auth.home')->name('home');
        Route::view('/profile', 'admin.auth.profile')->name('profile');
        Route::post('/profile', [SettingController::class, 'profileSetting'])->name('profile.setting');

        Route::resource('product', ProductController::class);

        Route::get('product-attribute-list/{id}', [ProductController::class, 'productAttributeList'])->name('product.attribute');
        Route::get('product-attribute-create/{pro_id}', [ProductController::class, 'productAttributeCreate'])->name('product.attribute.create');
        Route::post('product-attribute-store', [ProductController::class, 'productAttributeStore'])->name('product.attribute.store');
        Route::get('product-attribute-edit/{id}', [ProductController::class, 'productAttributeEdit'])->name('product.attribute.edit');
        Route::post('product-attribute-update/{id}', [ProductController::class, 'productAttributeUpdate'])->name('product.attribute.update');
        Route::delete('product-attribute-delete/{id}', [ProductController::class, 'productAttributeDelete'])->name('product.attribute.destroy');

        Route::post('product-status', [ProductController::class, 'productStatus'])->name('product.status');
        Route::post('product-tranding', [ProductController::class, 'productTranding'])->name('product.tranding');
        Route::post('product-out-of-stock', [ProductController::class, 'productOutOfStock'])->name('product.outOfStock');

        Route::resource('category', CategoryController::class);
        Route::resource('color', ColorController::class);
        Route::resource('size', SizeController::class);
        Route::resource('coupon', CouponController::class);
        Route::post('coupon-status', [CouponController::class, 'couponStatus'])->name('coupon.status');
        Route::resource('order', OrderController::class);
        Route::resource('user', UserController::class);
        Route::resource('banner', BannerController::class);
        Route::resource('testimonial', TestimonialController::class);
        Route::resource('section', SectionController::class);
    });
});
