<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdviceController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PortraitController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmergencyController;
use App\Http\Controllers\Admin\LandscapeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\IntroductionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileImageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\WorkdayController;

Route::group(['prefix'=>'admin','as'=>'admin.'],function (){
    Route::get('/login',[AdminLoginController::class, 'getLogin'])->name('login-page');
    Route::post('/send-login',[AdminLoginController::class, 'postLogin'])->name('login');

    Route::group(['middleware'=>'auth:admin'],function () {
        Route::get('/logout',[AdminLoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard/{period?}',[DashboardController::class, 'index'])->name('dashboard');

        // general
        Route::resource('emergencies', EmergencyController::class);
        Route::resource('introductions', IntroductionController::class);
        Route::resource('notifications', NotificationController::class)->except(['edit','update']);
        Route::resource('faqs', FaqController::class);
        Route::resource('advices', AdviceController::class);
        Route::resource('sections', SectionController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('pages', PageController::class);
        Route::resource('admins', AdminController::class)->except(['show']);

        // users
        Route::resource('profile-images', ProfileImageController::class);
        Route::resource('users', UserController::class);

        // cities
        Route::resource('cities', CityController::class);
        Route::resource('areas', AreaController::class);

        // categories
        Route::get('areas/sort/{id}/{direction}',[AreaController::class,'sortData'])->name('areas.sort');
        Route::resource('categories', CategoryController::class);

        // partners
        Route::resource('subcategories', SubCategoryController::class);
        Route::resource('partners', PartnerController::class);
        Route::get('partners/file/{id}', [PartnerController::class, 'openFile'])->name('partners.file');
        Route::resource('portraits', PortraitController::class)->except(['show']);
        Route::get('portraits/sort/{id}/{direction}',[PortraitController::class,'sortData'])->name('portraits.sort');
        Route::resource('landscapes', LandscapeController::class)->except(['show']);
        Route::get('landscapes/sort/{id}/{direction}',[LandscapeController::class,'sortData'])->name('landscapes.sort');
        Route::resource('branches', BranchController::class);

        // woorkdays
        Route::resource('workdays', WorkdayController::class)->except(['destroy']);
        Route::get('workdays/partner/{id}/edit',[WorkdayController::class,'editShiftWorkdays'])->name('partner.workdays.edit');
        Route::put('workdays/partner/{id}/update',[WorkdayController::class,'updateShiftWorkdays'])->name('partner.workdays.update');

        // counters
        Route::get('partner/whatsapp/counter',[CounterController::class,'whatsapp'])->name('partner.whatsapp.counter');
        Route::get('partner/call/counter',[CounterController::class,'call'])->name('partner.call.counter');
        Route::get('partner/view/counter',[CounterController::class,'view'])->name('partner.view.counter');


        // reviews
        Route::resource('reviews', ReviewController::class);
        Route::get('reviews/upload/sheet',[ReviewController::class,'upload'])->name('reviews.upload');
        Route::post('reviews/import',[ReviewController::class,'import'])->name('reviews.import');



        // 404 not found
        Route::get('/{any}', function($any){
            return abort('405');
        })->where('any', '.*');
    });
});
