<?php

use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\WishListController as ApiWishListController;
use App\Http\Controllers\Api\CartController as ApiCartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('register', [UserController::class, 'register']);
// Route::post('login', [UserController::class, 'login']);
// user api 
Route::prefix('user')->group(function(){
    Route::get('/getAll' , [ApiCategoryController::class , 'getAll']);
    Route::get('/getOne' , [ApiCategoryController::class , 'getOne']);

    Route::get('/getAllProducts' , [ApiProductController::class , 'getAll']);
    Route::get('/getOneProduct' , [ApiProductController::class , 'getOne']);
    Route::get('/searchProduct', [ApiProductController::class, 'searchProduct']);

});

Route::prefix('wishlist')->group(function(){
    Route::get('/details', [ApiWishListController::class, 'getWishlistDetailed']);
    Route::post('/add_product', [ApiWishListController::class, 'addProductToWishlist']);
    Route::post('/remove_product', [ApiWishListController::class, 'removeProductFromWishlist']);
});

Route::prefix('cart')->group(function(){
            Route::get('/details', [ApiCartController::class, 'getCartDetails']);
            Route::post('/add_product', [ApiCartController::class, 'addProductToCart']);
            Route::post('/remove_product', [ApiCartController::class, 'removeProductFromCart']);
        });
 

// Route::post('register', [AuthController::class, 'register']);
// Route::post('verify_code', [AuthController::class, 'verifiedCode']);
// Route::post('resend_code', [AuthController::class, 'resendCode']);

// // Login Customer
// Route::post('login', [AuthController::class, 'customerLogin']);

// // Home
// Route::get('get_statistics', [HomeController::class, 'getStatistics']);

// // Product
// Route::get('search_product', [ProductController::class, 'searchProduct']);
// Route::get('all_products', [ProductController::class, 'allProducts']);
// Route::get('get_product', [ProductController::class, 'getProduct']);

// // Payment Redirect route
// Route::get('payment_redirect', [OrderController::class, 'paymentRedirectUsingDibsy']);


//     // get all category
//  Route::get('category' , [CategoryController::class , 'getAllCategory']);
// Route::group(['middleware' => ['auth:sanctum'] ], function () {

//     // Logout
//     Route::get('logout', [AuthController::class, 'logout']);

//    // Wishlist
//     Route::group(['prefix' => 'wishlist'], function () {
//         Route::get('/details', [WishlistController::class, 'getWishlistDetailed']);
//         Route::post('/add_product', [WishlistController::class, 'addProductToWishlist']);
//         Route::post('/remove_product', [WishlistController::class, 'removeProductFromWishlist']);
//     });
   
//     // Edit User Info
//     Route::group(['prefix' => 'account'], function () {
//         Route::get('/show_profile', [UserController::class, 'getProfile']);
//         Route::post('/update', [UserController::class, 'updateUserInfo']);
//         Route::post('/update_password', [UserController::class, 'updateUserPassword']);
//         Route::post('/delete', [UserController::class, 'deleteUserAccount']);
//     });

//     // Cart
//     Route::group(['prefix' => 'cart'], function () {
//         Route::get('/details', [CartController::class, 'getCartDetails']);
//         Route::post('/add_product', [CartController::class, 'addProductToCart']);
//         Route::post('/remove_product', [CartController::class, 'removeProductFromCart']);
//     });
    
//     // Order
//     Route::group(['prefix' => 'order'], function () {
//         Route::post('checkout', [OrderController::class, 'userCheckout']);
//         Route::get('get_checkout', [OrderController::class, 'getPaymentClientSecret']);
//         Route::get('all', [OrderController::class, 'getUserOrders']);
//         Route::get('details', [OrderController::class, 'getOrderTrackDetails']);
//     });

//     // New Payment Gateaway
//     Route::post('create_payment', [OrderController::class, 'createPaymentUsingDibsy']);


//     // Cart and Wishlist Count
//     Route::get('cart_wishlist_items_count', [HomeController::class, 'getUserCartAndWishlistCount']);