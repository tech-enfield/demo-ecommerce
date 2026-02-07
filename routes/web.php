<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

// Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
// Route::get('product/{product_variant:slug}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
// Route::get('products', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
// Route::get('/{search}', [App\Http\Controllers\HomeController::class, 'lists'])->name('lists');

// // Route::get('carts', [App\Http\Controllers\HomeController::class, 'carts'])->name('carts');
// Route::resource('carts', CartController::class);
// Route::post('getcarts', [CartController::class, 'getCart'])->name('get.cart');

//Admin Endpoints
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin/', 'as' => 'admin.'], function () {
    Route::middleware('guest')->group(function () {
        // Route::get('register', [RegisteredUserController::class, 'create'])
        //     ->name('register');

        Route::get('register', function(){
            return abort(403);
        })->name('register');

        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        Route::get('dashboard', 'HomeController@dashboard')->middleware(['verified'])->name('dashboard');

        Route::middleware(['role:super-admin'])->group(function() {
            Route::resource('users', 'UserController');
            Route::get('assign-role-to-user/{user}', 'UserController@assignRole')->name('assign.role');
            Route::post('assign-role-to-user/{user}', 'UserController@assignRoleStore')->name('assign.role.store');
        });

        Route::get('category-assign-parent', 'CategoryController@assignParent')->name('categories.assign.parent');
        Route::post('category-assign-parent-store', 'CategoryController@assignParentStore')->name('categories.assign.parent.store');
        Route::delete('category-relation/{categoryRelation}', 'CategoryController@deleteRelation')->name('categories.delete.relation');
        Route::get('categories/import', 'CategoryController@import')->name('categories.import');
        Route::post('categories/import', 'CategoryController@importCategory')->name('categories.import.store');
        Route::get('categories/export', 'CategoryController@export')->name('categories.export');
        Route::resource('categories', 'CategoryController');

        Route::group(['prefix' => 'products/', 'as' => 'products.'], function () {

            Route::resource('images', 'ProductImageController');

            Route::get('assign-to-category', 'ProductController@assignCategory')->name('assign.category');
            Route::post('assign-to-category', 'ProductController@assignCategoryStore')->name('assign.category.store');
            Route::delete('delete-category-product-relation', 'ProductController@deleteCategoryProductRelation')->name('category.relation.destroy');
            Route::group(['prefix' => 'variants/', 'as' => 'variants.'], function () {
                Route::resource('attributes', 'ProductVariantAttributeController');
                Route::resource('images', 'ProductVariantImageController');
                Route::get('assign-color-family/{variant}', 'ProductVariantController@assignColorFamily')->name('assign.color.family');
                Route::post('assign-color-family', 'ProductVariantController@assignColorFamilyStore')->name('assign.color.family.store');
                Route::delete('assign-color-family/{product_variant_color}', 'ProductVariantController@assignColorFamilyDelete')->name('assign.color.family.delete');
            });
            Route::resource('variants', 'ProductVariantController');

            Route::get('import', 'ProductController@import')->name('import');
            Route::post('import', 'ProductController@importStore')->name('import.store');
            Route::get('export', 'ProductController@export')->name('export');
        });

        Route::resource('products', 'ProductController');

        Route::group(['prefix' => 'attributes/', 'as' => 'attributes.'], function () {
            Route::resource('groups', 'AttributeGroupController');
            Route::resource('values', 'AttributeValueController');
        });
        Route::get('attributes/import', 'AttributeController@import')->name('attributes.import');
        Route::post('attributes/import', 'AttributeController@importStore')->name('attributes.import.store');
        Route::get('attributes/export', 'AttributeController@export')->name('attributes.export');
        Route::resource('attributes', 'AttributeController');

        Route::resource('sales', 'SaleController');

        Route::post('banners/import', 'BannerController@importStore')->name('banners.import.store');
        Route::resource('banners', 'BannerController');
    });
});
