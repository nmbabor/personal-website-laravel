<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserManagementController;
use App\Http\Controllers\Backend\WebsiteSettingController;

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

// ====================== FRONTEND ======================

// homepage
Route::get('/','Frontend\HomeController@index')->name('frontend.home');
Route::get('/blogs','Frontend\HomeController@blogs')->name('frontend.blogs');
Route::get('/blogs/{category}','Frontend\HomeController@blogCategory')->name('frontend.blogs.category');
Route::get('/blog/{slug}','Frontend\HomeController@singleBlog')->name('frontend.blog.show');
Route::get('/pages/{slug}','Frontend\HomeController@singlePage')->name('frontend.page');
Route::get('/portfolio/{slug}','Frontend\HomeController@portfolio');

//authentication
Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], 'sign-up', [AuthController::class, 'signup'])->name('signup');
Route::match(['get', 'post'], 'forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
Route::match(['get', 'post'], 'new-password', [AuthController::class, 'newPassword'])->name('new.password');
Route::match(['get', 'post'], 'password-reset', [AuthController::class, 'passwordReset'])->name('password.reset');
Route::get('resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');


// google auth
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.handle.callback');


// ====================== /FRONTEND =====================

Route::get('dashboard', [AuthController::class, 'userDash'])->name('dashboard.redirect');
Route::get('user/auth-check', [AuthController::class, 'userAuthCheck'])->name('user.auth.check');

// ====================== BACKEND =======================

// admin
Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    //profile
    Route::get('profile', [DashboardController::class, 'profile'])->name('user.profile');
    Route::post('update-profile', [AuthController::class, 'updateProfile'])->name('user.update.profile');
    Route::resource('link-submit','Backend\LinkSubmitController');
    Route::get('link-check','Backend\LinkSubmitController@linkCheckForm')->name('link-check.index');
    Route::post('link-check','Backend\LinkSubmitController@linkCheck')->name('link-check.submit');
    Route::get('/pricing-plans','Backend\PurchaseController@pricingPlan')->name('user.pricing-plans');
    Route::get('/checkout/{id}','Backend\PurchaseController@checkout')->name('user.checkout');
    Route::post('/coupon-validation','Backend\PurchaseController@couponValidation')->name('coupon-validation');
    Route::post('/purchase-plan','Backend\PurchaseController@purchase')->name('purchase-plan');
    Route::get('aamarpay/process', 'Backend\PurchaseController@aamarpayProcess')->name('aamarpay.process');
    Route::get('/transections','Backend\PurchaseController@transections')->name('user.transections');
    Route::get('/transections/{id}','Backend\PurchaseController@transectionsDetails')->name('user.transections.show');
});
// Aamar pay callback url
Route::group(['prefix'=>'user','namespace' => 'Backend'], function () {
    Route::post('aamarpay/success', 'PurchaseController@aamarpaySuccess')->name('aamarpay.success');
    Route::post('aamarpay/fail', 'PurchaseController@aamarpayFail')->name('aamarpay.fail');
});
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('backend.admin.dashboard');

    
    Route::resource('text-slider','Backend\TextSliderController');
    // page builder
    Route::resource('page-builder','Backend\PageController');
    
    Route::prefix('financial')->group(function () {
        Route::resource('pricing-plan','Backend\PricingPlanController');
        Route::resource('coupons','Backend\CouponController');
        Route::put('pricing-plan-serial-update','Backend\PricingPlanController@serialUpdate')->name('pricing-plan-serial-update');
        Route::get('/transections','Backend\OrderController@transections')->name('admin.transections');
        Route::get('/transections/{id}','Backend\OrderController@transectionsDetails')->name('admin.transections.show');
        Route::get('/transections-approval/{id}','Backend\OrderController@approval')->name('admin.transections.approval');

    });

    // user management
    Route::prefix('users')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('backend.admin.users');
        Route::get('suspend/{id}/{status}', [UserManagementController::class, 'suspend'])->name('backend.admin.user.suspend');
        Route::match(['get', 'post'], 'create', [UserManagementController::class, 'create'])->name('backend.admin.user.create');
        Route::match(['get', 'post'], 'edit/{id}', [UserManagementController::class, 'edit'])->name('backend.admin.user.edit');
        Route::get('delete/{id}', [UserManagementController::class, 'delete'])->name('backend.admin.user.delete');
    });

    Route::resource('education','Backend\EducationController');
    Route::resource('experiences','Backend\ExperienceController');
    Route::resource('technology','Backend\TechnologyController');
    Route::resource('services','Backend\ServicesController');
    Route::resource('testimonials','Backend\TestimonialController');
     // Portfolio
     Route::prefix('portfolio')->as('portfolio.')->group(function () {
        // Portfolio category
        Route::resource('categories','Backend\Portfolio\PortfolioCategoryController');
        Route::resource('projects','Backend\Portfolio\PortfolioController');
        // Portfolio images
        Route::post('image-store','Backend\Portfolio\PortfolioController@imageStore')->name('projects.image-store');
        Route::delete('image-delete/{id}','Backend\Portfolio\PortfolioController@imageDelete')->name('projects.image-delete');
        Route::get('image-update','Backend\Portfolio\PortfolioController@imageStatusUpdate')->name('projects.image-update');
        // Portfolio features
        Route::get('features/{id}','Backend\Portfolio\FeaturesController@index')->name('features.index');
        Route::post('features','Backend\Portfolio\FeaturesController@store')->name('features.store');
        Route::put('features/{id}','Backend\Portfolio\FeaturesController@update')->name('features.update');
        Route::delete('features/{id}','Backend\Portfolio\FeaturesController@destroy')->name('features.destroy');
     });
    // blogs
    Route::prefix('blogs')->group(function () {
        // blog category
        Route::resource('categories','Backend\BlogCategoryController');

        Route::get('/', [BlogController::class, 'index'])->name('backend.admin.blogs');
        Route::match(['get', 'post'], 'create', [BlogController::class, 'createBlog'])->name('backend.admin.blogs.create');
        Route::match(['get', 'post'], 'edit/{id}', [BlogController::class, 'editBlog'])->name('backend.admin.blogs.edit');
        Route::get('delete/{id}', [BlogController::class, 'deleteBlog'])->name('backend.admin.blogs.delete');
    });

    // settings
    Route::prefix('settings')->group(function () {
        Route::get('payment-gateway','Backend\WebsiteSettingController@pgwSettings')->name('settings.payment-gateway');
        Route::post('payment-gateway','Backend\WebsiteSettingController@pgwInfoUpdate')->name('settings.payment-gateway.update');
        // website settings
        Route::prefix('website')->group(function () {
            Route::controller(WebsiteSettingController::class)->prefix('general')->group(function () {
                Route::get('/', 'websiteGeneral')->name('backend.admin.settings.website.general');
                Route::post('update-info', 'websiteInfoUpdate')->name('backend.admin.settings.website.info.update');
                Route::post('update-description', 'websiteDescriptionUpdate')->name('backend.admin.settings.website.description.update');
                Route::post('update-contacts', 'websiteContactsUpdate')->name('backend.admin.settings.website.contacts.update');
                Route::post('update-social-links', 'websiteSocialLinkUpdate')->name('backend.admin.settings.website.social.link.update');
                Route::post('update-style-settings', 'websiteStyleSettingsUpdate')->name('backend.admin.settings.website.style.settings.update');
                Route::post('update-custom-css', 'websiteCustomCssUpdate')->name('backend.admin.settings.website.custom.css.update');
                Route::post('update-notification-settings', 'websiteNotificationSettingsUpdate')->name('backend.admin.settings.website.notification.settings.update');
                Route::post('update-website-status', 'websiteStatusUpdate')->name('backend.admin.settings.website.status.update');
            });
            Route::controller(RoleController::class)->prefix('roles')->group(function () {
                Route::get('/', 'index')->name('backend.admin.roles');
                Route::post('create', 'store')->name('backend.admin.roles.create');
                Route::get('show/{id}', 'show')->name('backend.admin.roles.show');
                Route::put('update/{id}', 'update')->name('backend.admin.roles.update');
                Route::get('delete/{id}', 'destroy')->name('backend.admin.roles.delete');
                Route::post('role-permission/{id}', 'updatePermission')->name('backend.admin.update.role-permissions');
                Route::get('role-wise-permissions/{id?}', 'roleWisePermissions')->name('backend.admin.role-wise-permissions');
            });

            Route::controller(PermissionController::class)->prefix('permissions')->group(function () {
                Route::get('/', 'index')->name('backend.admin.permissions');
                Route::post('create', 'store')->name('backend.admin.permissions.store');
                // Route::get('show/{id}', 'show')->name('backend.admin.roles.show');
                Route::put('update/{id}', 'update')->name('backend.admin.permissions.update');
                Route::get('delete/{id}', 'destroy')->name('backend.admin.permissions.delete');
            });
        });
        Route::resource('menus','Backend\MenuController');
        Route::put('menu-serial-update','Backend\MenuController@serialUpdate')->name('menu-serial-update');
        
        Route::post('sub-menus','Backend\SubMenuController@store')->name('sub-menus.store');
        Route::match(['put','patch'],'sub-menus/{id}','Backend\SubMenuController@update')->name('sub-menus.update');
        Route::delete('sub-menus/{id}','Backend\SubMenuController@destroy')->name('sub-menus.destroy');
    });
});

// ====================== /BACKEND ======================

Route::get('clear-all', function () {
    Artisan::call('optimize:clear');
    return redirect()->back();
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');
    return redirect()->back();
});

Route::get('test', [TestController::class, 'test'])->name('test');
