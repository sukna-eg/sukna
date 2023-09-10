<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\PimageController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\PrimageController;
use App\Http\Controllers\Api\SmartController;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\IntroductionController;
use App\Http\Controllers\Api\BlackDayController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\VersionController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Auth
Route::post('login', [AuthController::class, 'login']);

Route::post('user-reg', [AuthController::class, 'store']);

Route::post('sociallogin', [AuthController::class, 'sociallogin']);

Route::get('user/{id}', [AuthController::class, 'userProfile']);

 // updateById
 Route::post('/user-edit', [AuthController::class, 'updateById']);


//forget pw step 1
Route::post('check-user', [AuthController::class, 'checkUser']);


Route::post('update-password', [AuthController::class, 'changePassword']);

Route::get('delete-user/{id}', [AuthController::class, 'delete']);


Route::middleware('changeLang')->group(function () {

    //Category
Route::get('categories', [CategoryController::class, 'pagination']);
Route::post('category-create', [CategoryController::class, 'save']);
Route::get('category/{id}', [CategoryController::class, 'view']);
Route::get('category/delete/{id}', [CategoryController::class, 'delete']);
Route::post('category/edit/{id}', [CategoryController::class, 'edit']);



//Subcategory
Route::get('subcategories', [SubcategoryController::class, 'pagination']);
Route::post('subcategory-create', [SubcategoryController::class, 'save']);
Route::get('subcategory/{id}', [SubcategoryController::class, 'view']);
Route::get('subcategory/delete/{id}', [SubcategoryController::class, 'delete']);
Route::post('subcategory/edit/{id}', [SubcategoryController::class, 'edit']);


//partner
Route::get('partners', [PartnerController::class, 'partners']);
Route::post('partner-create', [PartnerController::class, 'save']);

Route::get('partner/delete/{id}', [PartnerController::class, 'delete']);
Route::post('partner/edit/{id}', [PartnerController::class, 'edit']);

//premiumPartners
Route::get('premium-partners', [PartnerController::class, 'premiumPartners']);


//getPartnersByCategory
Route::get('partners-by-category/{id}', [CategoryController::class, 'getPartnersByCategory']);

//getPartnersBySub
Route::get('partners-by-subcategory/{id}', [SubcategoryController::class, 'getPartnersBySub']);

//filter
Route::post('partners-filter', [PartnerController::class, 'getPartnersOfSubOrCategortInArea']);

//sortAndFilter
Route::post('sort-filter', [PartnerController::class, 'sortAndFilter']);

//price for filter
Route::get('partners-prices', [PartnerController::class, 'prices']);

//spaces for filter
Route::get('partners-spaces', [PartnerController::class, 'spaces']);

//bedrooms for filter
Route::get('partners-bedrooms', [PartnerController::class, 'bedrooms']);

//bathrooms for filter
Route::get('partners-bathrooms', [PartnerController::class, 'bathrooms']);

//floors
Route::get('partners-floors', [PartnerController::class, 'floors']);

//prices range
Route::get('prices-range', [PartnerController::class, 'getMinAndMaxOfPrice']);

//sortAndFilter
Route::get('spaces-range', [PartnerController::class, 'getMinAndMaxOfSpace']);

//sortPartnersInCatOrSub
Route::post('category-sort', [PartnerController::class, 'sortPartnersInCatOrSub']);


//city
Route::get('cities', [CityController::class, 'pagination']);
Route::post('city-create', [CityController::class, 'save']);
Route::get('city/{id}', [CityController::class, 'view']);
Route::get('city/delete/{id}', [CityController::class, 'delete']);
Route::post('city/edit/{id}', [CityController::class, 'edit']);

//area
Route::get('areas', [AreaController::class, 'pagination']);
Route::post('area-create', [AreaController::class, 'save']);
Route::get('area/{id}', [AreaController::class, 'view']);
Route::get('area/delete/{id}', [AreaController::class, 'delete']);
Route::post('area/edit/{id}', [AreaController::class, 'edit']);


//favorite

Route::post('favorite-create', [FavoriteController::class, 'save']);
Route::get('favorite/delete/{partner_id}/{user_id}', [FavoriteController::class, 'deletebyID']);

//is partner fav
Route::post('partner-fav', [FavoriteController::class, 'isFav']);


//reviews
Route::get('reviews', [ReviewController::class, 'pagination']);
Route::post('review-create', [ReviewController::class, 'save']);
Route::get('review/{id}', [ReviewController::class, 'view']);
Route::get('review/delete/{id}', [ReviewController::class, 'delete']);
Route::post('review/edit/{id}', [ReviewController::class, 'edit']);


//partner image
Route::get('images', [PimageController::class, 'pagination']);
Route::post('image-create', [PimageController::class, 'save']);
Route::get('image/{id}', [PimageController::class, 'view']);
Route::get('image/delete/{id}', [PimageController::class, 'delete']);
Route::post('image/edit/{id}', [PimageController::class, 'edit']);

//question
Route::get('questions', [QuestionController::class, 'questions']);
Route::post('question-create', [QuestionController::class, 'save']);
Route::get('question/{id}', [QuestionController::class, 'view']);
Route::get('question/delete/{id}', [QuestionController::class, 'delete']);
Route::post('question/edit/{id}', [QuestionController::class, 'edit']);


//answer
Route::get('answers', [AnswerController::class, 'pagination']);
Route::post('answer-create', [AnswerController::class, 'save']);
Route::get('answer/{id}', [AnswerController::class, 'view']);
Route::get('answer/delete/{id}', [AnswerController::class, 'delete']);
Route::post('answer/edit/{id}', [AnswerController::class, 'edit']);

//Appointment
Route::get('appointments', [AppointmentController::class, 'pagination']);
Route::post('appointment-create', [AppointmentController::class, 'save']);
Route::get('appointment/{id}', [AppointmentController::class, 'view']);
Route::get('appointment/delete/{id}', [AppointmentController::class, 'delete']);
Route::post('appointment/edit/{id}', [AppointmentController::class, 'edit']);


//Service
Route::get('services', [ServiceController::class, 'pagination']);
Route::post('service-create', [ServiceController::class, 'save']);
Route::get('service/{id}', [ServiceController::class, 'view']);
Route::get('service/delete/{id}', [ServiceController::class, 'delete']);
Route::post('service/edit/{id}', [ServiceController::class, 'edit']);


//getServicesByCategory
Route::get('services-by-category/{id}', [ServiceController::class, 'getServicesByCategory']);


//project
Route::get('projects', [ProjectController::class, 'pagination']);
Route::post('project-create', [ProjectController::class, 'save']);
Route::get('project/{id}', [ProjectController::class, 'view']);
Route::get('project/delete/{id}', [ProjectController::class, 'delete']);
Route::post('project/edit/{id}', [ProjectController::class, 'edit']);

//getProjectsByService
Route::get('projects-by-service/{id}', [ProjectController::class, 'getProjectsByService']);

//partner image
Route::get('pimages', [PrimageController::class, 'pagination']);
Route::post('pimage-create', [PrimageController::class, 'save']);
Route::get('pimage/{id}', [PrimageController::class, 'view']);
Route::get('pimage/delete/{id}', [PrimageController::class, 'delete']);
Route::post('pimage/edit/{id}', [PrimageController::class, 'edit']);


//getTrendingServices
Route::get('trending', [CategoryController::class, 'getTrendingServices']);

//ourPartners
Route::get('our-partners', [ServiceController::class, 'ourPartners']);



//Smart
Route::get('smarts', [SmartController::class, 'pagination']);
Route::post('smart-create', [SmartController::class, 'save']);
Route::get('smart/{id}', [SmartController::class, 'view']);
Route::get('smart/delete/{id}', [SmartController::class, 'delete']);
Route::post('smart/edit/{id}', [SmartController::class, 'edit']);

//Work
Route::get('works', [WorkController::class, 'pagination']);
Route::post('work-create', [WorkController::class, 'save']);
Route::get('work/{id}', [WorkController::class, 'view']);
Route::get('work/delete/{id}', [WorkController::class, 'delete']);
Route::post('work/edit/{id}', [WorkController::class, 'edit']);


//Introduction
Route::get('introductions', [IntroductionController::class, 'list']);
Route::post('introduction-create', [IntroductionController::class, 'save']);
Route::get('introduction/{id}', [IntroductionController::class, 'view']);
Route::get('introduction/delete/{id}', [IntroductionController::class, 'delete']);
Route::post('introduction/edit/{id}', [IntroductionController::class, 'edit']);

//BlackDay
Route::get('blacks', [BlackDayController::class, 'list']);
Route::post('blackday-create', [BlackDayController::class, 'save']);
Route::get('blackday/{id}', [BlackDayController::class, 'view']);
Route::get('blackday/delete/{id}', [BlackDayController::class, 'delete']);
Route::post('blackday/edit/{id}', [BlackDayController::class, 'edit']);


////nearbyPartberIn5 kilometers
Route::post('nearest-partners', [PartnerController::class, 'nearest']);


//pages

Route::get('pages', [PageController::class, 'list']);
Route::post('page-create', [PageController::class, 'save']);
Route::get('page/{id}', [PageController::class, 'view']);
Route::get('page/delete/{id}', [PageController::class, 'delete']);
Route::post('page/edit/{id}', [PageController::class, 'edit']);

//Version

Route::get('versions', [VersionController::class, 'list']);
Route::post('version-create', [VersionController::class, 'save']);
Route::get('version/{id}', [VersionController::class, 'view']);
Route::get('version/delete/{id}', [VersionController::class, 'delete']);
Route::post('version/edit/{id}', [VersionController::class, 'edit']);


    });

    Route::middleware(['auth:api','changeLang'])->group(function () {

        //myFavorites
Route::get('my-favorites', [FavoriteController::class, 'myFavorites']);

  //myOrders
  Route::get('my-orders', [AppointmentController::class, 'myOrders']);

  Route::get('partner/{id}', [PartnerController::class, 'view']);

  //myPartners
  Route::get('my-partners', [PartnerController::class, 'myPartners']);
    });
