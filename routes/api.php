<?php

use App\Http\Controllers\Api\Api_PatientController;
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
        Route::get('/list-patient/{id}', 'show')->name('patient.show');       
        Route::put('/list-patient/{id}', 'update')->name('patient.update');   
        Route::delete('/list-patient/{id}', 'destroy')->name('patient.delete'); 
    });
// [patient_controller----------------------------]