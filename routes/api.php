<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('send-otp', [ApiController::class, 'sendOtpOnMail']);
Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);

Route::post('product', [ApiController::class, 'product']);
Route::get('product-detail/{id}/{sku}', [ApiController::class, 'productDetail']);

Route::get('category', [ApiController::class, 'categories']);
Route::get('size', [ApiController::class, 'sizes']);
Route::get('coupon', [ApiController::class, 'coupons']);
Route::get('banner', [ApiController::class, 'banners']);

Route::post('contact-us', [ApiController::class, 'contactUs']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('add-watchlist', [ApiController::class, 'addWatchlist']);
    Route::get('get-product-from-watchlist', [ApiController::class, 'getAllProductFromWatchlist']);
    Route::get('remove-product-from-watchlist/{id}', [ApiController::class, 'removeProductFromWatchlist']);

    Route::get('cart', [ApiController::class, 'getCartItem']);
    Route::post('add-to-cart', [ApiController::class, 'addProductInCart']);
    Route::get('delete-from-cart/{id}', [ApiController::class, 'deleteCartItem']);
});
