<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\API\CustomerAddressController;
use App\Http\Controllers\AuthController;
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
// */
// Route::prefix('customers')->group(function(){
//     Route::post('register', [CustomerAuthController::class,'register']);
//     Route::post('login', [CustomerAuthController::class,'login']);
//     Route::post('logout', [CustomerAuthController::class,'logout']);
//     Route::post('refresh', [CustomerAuthController::class,'refresh']);
//     Route::post('me', [CustomerAuthController::class,'me']);
// });

// Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    //     Route::post('logout', [AuthController::class,'logout']);
    //     Route::post('refresh', [AuthController::class,'refresh']);
    //     Route::post('me', [AuthController::class,'me']);
    // });
    
    Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
        Route::post('register', [CustomerAuthController::class,'register']);
        Route::post('login', [CustomerAuthController::class,'login']);
        Route::post('me', [CustomerAuthController::class,'me']);
        Route::post('logout', [CustomerAuthController::class,'logout']);
        Route::post('refresh', [CustomerAuthController::class,'refresh']);

        Route::post('/customer_files', [App\Http\Controllers\API\CustomerFilesController::class, 'customer_files']);
        Route::get('/CustomerFiles', [App\Http\Controllers\API\CustomerFilesController::class, 'CustomerFiles']);


        Route::post('/customer_question', [App\Http\Controllers\API\CustomerQuestionController::class, 'customer_question']);
        Route::get('/customerQuestion', [App\Http\Controllers\API\CustomerQuestionController::class, 'customerQuestion']);


        
        Route::post('/customer_bank', [App\Http\Controllers\API\CustomerBankController::class, 'customer_bank']);
        Route::get('/customerBank', [App\Http\Controllers\API\CustomerBankController::class, 'customerBank']);

        Route::post('/customer_job', [App\Http\Controllers\API\CustomerJobsController::class, 'customer_job']);
        Route::get('/customerJob', [App\Http\Controllers\API\CustomerJobsController::class, 'customerJob']);


        Route::post('/customer_address', [CustomerAddressController::class, 'customer_address']);
        Route::get('/customerAddress', [CustomerAddressController::class, 'customerAddress']);

        Route::post('/customer_information', [App\Http\Controllers\API\CustomerInformationController::class, 'customer_information']);
        Route::get('/customerInformation', [App\Http\Controllers\API\CustomerInformationController::class, 'customerInformation']);
});
