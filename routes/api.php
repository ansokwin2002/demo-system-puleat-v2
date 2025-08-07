<?php

use App\Http\Controllers\Api\Api_PatientController;
use App\Http\Controllers\Api_DashboardController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// [patient_controller----------------------------]
    Route::controller(Api_PatientController::class)->group(function(){
        Route::get('/list-patient','index')->name('index.patient');
        Route::post('/create-patient','create')->name('create.patient');
        Route::get('/show-patient/{id}', 'show')->name('patient.show');       
        Route::put('/update-patient/{id}', 'update')->name('patient.update');   
        Route::delete('/delete-patient/{id}', 'destroy')->name('patient.delete'); 
    });
// [patient_controller----------------------------]

// [login_controller---------------------------]
    Route::controller(Api_DashboardController::class)->group(function(){
      
    });
// [login_controller---------------------------]
