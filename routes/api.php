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
Route::get('categories', [CategoryController::class, 'list']);
Route::post('category-create', [CategoryController::class, 'save']);
Route::get('category/{id}', [CategoryController::class, 'view']);
Route::get('category/delete/{id}', [CategoryController::class, 'delete']);
Route::post('category/edit/{id}', [CategoryController::class, 'edit']);



//Subcategory
Route::get('subcategories', [SubcategoryController::class, 'list']);
Route::post('subcategory-create', [SubcategoryController::class, 'save']);
Route::get('subcategory/{id}', [SubcategoryController::class, 'view']);
Route::get('subcategory/delete/{id}', [SubcategoryController::class, 'delete']);
Route::post('subcategory/edit/{id}', [SubcategoryController::class, 'edit']);


//partner
Route::get('partners', [PartnerController::class, 'list']);
Route::post('partner-create', [PartnerController::class, 'save']);
Route::get('partner/{id}', [PartnerController::class, 'view']);
Route::get('partner/delete/{id}', [PartnerController::class, 'delete']);
Route::post('partner/edit/{id}', [PartnerController::class, 'edit']);

//premiumPartners
Route::get('premium-partners', [PartnerController::class, 'premiumPartners']);


//city
Route::get('cities', [CityController::class, 'list']);
Route::post('city-create', [CityController::class, 'save']);
Route::get('city/{id}', [CityController::class, 'view']);
Route::get('city/delete/{id}', [CityController::class, 'delete']);
Route::post('city/edit/{id}', [CityController::class, 'edit']);

//area
Route::get('areas', [AreaController::class, 'list']);
Route::post('area-create', [AreaController::class, 'save']);
Route::get('area/{id}', [AreaController::class, 'view']);
Route::get('area/delete/{id}', [AreaController::class, 'delete']);
Route::post('area/edit/{id}', [AreaController::class, 'edit']);


//favorite

Route::post('favorite-create', [FavoriteController::class, 'save']);
Route::get('favorite/delete/{partner_id}/{user_id}', [FavoriteController::class, 'deletebyID']);

//is partner fav
Route::post('partner-fav', [FavoriteController::class, 'isFav']);




    });

    Route::middleware(['auth:api','changeLang'])->group(function () {

        //myFavorites
Route::get('my-favorites', [FavoriteController::class, 'myFavorites']);

    });
