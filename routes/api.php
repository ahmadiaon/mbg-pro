<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Database\DatabaseTableController;
use App\Http\Controllers\Api\Pendapatan\HaulingController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Employee\EmployeeAbsenController;
use App\Http\Controllers\Recruitment\RecruitmentController;
use App\Http\Controllers\Support\DatabaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('recruitment')->group(function () {
    Route::post('store', [RecruitmentController::class, 'store']);
    Route::post('cek-rekruitment', [RecruitmentController::class, 'getDataRecruitment']);
    Route::post('get', [RecruitmentController::class, 'getData']);
});

Route::prefix('mbg')->group(function () {
    Route::get('db/{table}', [DatabaseController::class, 'getTableData']);
    Route::post('employee', [UserController::class, 'getfull']);
    Route::post('/local-storage', [UserController::class, 'localStorage']);

    Route::prefix('absensi')->group(function () {
        Route::post('/', [ApiEmployeeAbsensiController::class, 'getAbsenEmployee']);
    });
    Route::prefix('slip')->group(function () {
        Route::post('/data', [ApiSlipController::class, 'data']);
    });

    Route::prefix('pendapatan')->group(function () {
        Route::prefix('hauling')->group(function () {
            Route::post('/store', [HaulingController::class, 'store']);
            Route::post('/get', [HaulingController::class, 'get']);
            Route::post('/delete', [HaulingController::class, 'delete']);
        });     
    });

    Route::prefix('pengelolaan')->group(function () {//  /api/mbg/pengelolaan/absensi
        Route::prefix('absensi')->group(function () {
            // Route::post('/store', [HaulingController::class, 'store']);
            Route::post('/get', [EmployeeAbsenController::class, 'getApiAbsensi']);
            Route::post('/store-single', [EmployeeAbsenController::class, 'storeApiAbsensiSingle']);
            // Route::post('/delete', [HaulingController::class, 'delete']);
        });     
    });

    Route::post('/get/user', [UserController::class, 'getUser']);

    Route::post('/user', [UserController::class, 'storeUser']);
    
    Route::post('/get/user/available', [UserController::class, 'cekAvailableEmployee']);

    Route::prefix('manage')->group(function () {/// /api/mbg/manage/
        Route::prefix('employees')->group(function () {
            Route::post('/get', [UserController::class, 'getEmployees']);
        });

        Route::prefix('users')->group(function () {
            Route::post('/edit', [UserController::class, 'editUser']);            
        });

        Route::prefix('app')->group(function () {
            Route::post('/store', [DatabaseController::class, 'store']);
        });
        
        

        Route::prefix('database')->group(function () {// /api/mbg/manage/database/
            Route::post('/store-database', [DatabaseController::class, 'storeData']);
            Route::post('/store-database-file', [DatabaseController::class, 'storeDataFile']);
            Route::post('/delete-data-database', [DatabaseController::class, 'deleteData']);
            Route::post('/get-table', [DatabaseController::class, 'getData']);
            Route::post('/store-template', [DatabaseController::class, 'storeTemplate']);
            
            Route::post('/import-datatable', [DatabaseController::class, 'importDatatable']);
        });

        Route::prefix('menu')->group(function () {
            Route::post('/', [MenuController::class, 'store']);  
            Route::post('/get', [MenuController::class, 'get']);  
            Route::post('/delete', [MenuController::class, 'delete']); 
        });
    });   
});

Route::prefix('v1')->group(function () {
    Route::post('login', [Api\Auth\AuthController::class, 'login']);
    Route::get('fail', [Api\Auth\AuthController::class, 'fail'])->name('fail');
    Route::get('employees-list', [Api\User\ApiEmployeeController::class, 'employees']);
    Route::group(['middleware' => ['auth:users']], function () {
        Route::get('employees-lists', [Api\User\ApiEmployeeController::class, 'employees']);
    });
});

Route::prefix('v2')->group(function () {
    //* Utilities
    Route::post('admin/check-email', [Api\UtilityController::class, 'checkEmailAdmin']);
    Route::post('user/check-email', [Api\UtilityController::class, 'checkEmailUser']);
    Route::post('admin/check-phone', [Api\UtilityController::class, 'checkPhoneAdmin']);
    Route::post('user/check-phone', [Api\UtilityController::class, 'checkPhoneUser']);
    Route::get('businesss/list', [Api\User\BusinessController::class, 'listBusiness']);

    //* Role Admin


    //* Role User
    Route::prefix('user')->group(function () {
        //* Auth
        Route::post('login', [Api\Auth\AuthController::class, 'loginUser']);
        Route::post('checkEmail', [Api\Auth\AuthController::class, 'checkEmail']);
        Route::post('register', [Api\Auth\AuthController::class, 'registerUser']);
        Route::post('update-password/{id}', [Api\Auth\AuthController::class, 'updatePassword']);

        Route::group(['middleware' => ['auth:users']], function () {

            // Financial Service
            Route::get('financial-service/list', [Api\User\FinancialServicesController::class, 'listFinancialServicesUser']);
            // Financial Registers
            Route::post('financial-service/register/{id}', [Api\User\FinancialServicesController::class, 'registerFinancialServicesUser']);
            Route::post('financial-service/register-download/{id}', [Api\User\FinancialServicesController::class, 'downloadRegister']);

            // Financial Submission
            Route::post('financial-service/submission/{id}', [Api\User\FinancialServicesController::class, 'submissionFinancialServicesUser']);
            Route::get('detail-financial/{id}', [Api\User\FinancialServicesController::class, 'DetailFinancial']);
            Route::get('detail-data-financial/{id}', [Api\User\FinancialServicesController::class, 'DetailDataFinancial']);
            Route::get('financial/slide/{id}', [Api\User\FinancialServicesController::class, 'ListSlideFinancial']);
            Route::post('financial-slide/{id}/slide', [Api\User\FinancialServicesController::class, 'createSlideFinancial']);
            Route::post('financial-slide/{id}/delete', [Api\User\FinancialServicesController::class, 'deleteSlideFinancial']);
            Route::get('financial-registers/{id}', [Api\User\FinancialServicesController::class, 'listRegistersFinancial']);
            Route::get('financial-submissions/{id}', [Api\User\FinancialServicesController::class, 'listSubmissionFinancial']);
            Route::post('edit-financial/{id}', [Api\User\FinancialServicesController::class, 'editFinancial']);


            // Tour
            Route::get('tour/list', [Api\User\TourController::class, 'listTourUser']);
            Route::get('detail-tours/{id}', [Api\User\TourController::class, 'DetailTour']);

            // News
            Route::get('news/list', [Api\User\NewsController::class, 'listNewsUser']);
            Route::get('news/list/single', [Api\User\NewsController::class, 'listNewsUserSingle']);
            Route::get('detail-news/{id}', [Api\User\NewsController::class, 'DetailNews']);

            // Gallery User
            Route::get('gallery/{id}', [Api\User\GalleryController::class, 'showGalleryById']);

            // Business Category
            Route::get('business/category/list', [Api\User\BusinessController::class, 'listBusinessCategories']);

            // Profiling User
            Route::get('profile/{id}', [Api\User\UserController::class, 'ShowProfile']);
            Route::put('profile/{id}', [Api\User\UserController::class, 'UpdateProfile']);

            // Community
            Route::get('community/list', [Api\User\CommunityController::class, 'listCommunity']);
            Route::get('detail-community/{id}', [Api\User\CommunityController::class, 'DetailCommunity']);

            // Community Register
            Route::post('community/register/{id}', [Api\User\CommunityRegisterController::class, 'registerCommunityMember']);

            // Business
            Route::get('business/list', [Api\User\BusinessController::class, 'listBusiness']);
            Route::get('detail-business/{id}', [Api\User\BusinessController::class, 'DetailBusiness']);

            //* Business Review
            Route::get('business/{id}/review/list', [Api\User\ReviewController::class, 'listReviewByBusiness']);
            Route::get('business/{id}/review/listLimit', [Api\User\ReviewController::class, 'lisLimitReviewByBusiness']);
            Route::post('business/{id}/review', [Api\User\ReviewController::class, 'createReview']);

            // Slide User
            Route::get('slide', [Api\User\SlideController::class, 'index']);
            Route::get('slide/list', [Api\User\SlideController::class, 'listSlide']);

            // youtube
            Route::get('youtube/list', [Api\User\SlideController::class, 'listYoutube']);

            // Community Category User
            Route::get('community/category', [Api\User\CommunityCategoryController::class, 'index']);
            Route::get('communities/category', [Api\User\CommunityController::class, 'listCommunityCategories']);

            //* Logout
            Route::post('logout', [Api\Auth\AuthController::class, 'logoutUser']);
        });
    });
});
