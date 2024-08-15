<?php

use App\Http\Controllers\Dashbaord\DashboardController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\PatientHistory\PatientHistoryController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Service\ServiceController;
use Illuminate\Support\Facades\Route;

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

// [Admin---------------------------------]
    Route::get('/', function () {
        return view('backend.dashboard');
    })->middleware(['auth', 'verified'])->name('backend.dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    require __DIR__.'/auth.php';
// [Admin---------------------------------]


// [dashboard_controller----------------------------]
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard','dashboard')->name('dashboard');
    });
// [dashboard_controller----------------------------]

// [payment_controller----------------------------]
    Route::controller(PaymentController::class)->group(function(){
        Route::get('/view-payment','view_Payment')->name('view_Payment');
        Route::post('/create-patient','create_Patient')->name('create_Patient');

    });
// [payment_controller----------------------------]

// [service_controller----------------------------]
    Route::controller(ServiceController::class)->group(function(){
        Route::get('/add-service','add_Service')->name('add_Service');
        Route::post('/create-service','create_Service')->name('create_Service');
        Route::get('/view-service','view_Service')->name('view_Service');
        Route::get('/edit-service/{id}','edit_Service')->name('edit_Service');


        Route::delete('/service-delete/{id}','serviceDelete')->name('service_Delete');
        Route::get('/service-edit/{id}','serviceEdit')->name('service_Edit');
        Route::post('/service-update/{id}','serviceUpdate')->name('service_Update');
    });
// [service_controller----------------------------]

// [patient_controller----------------------------]
    Route::controller(PatientController::class)->group(function(){
        Route::get('/add-patient','add_Patient')->name('add_Patient');
        Route::get('/view-patient','view_Patient')->name('view_Patient');
        Route::post('/create-patient','create_Patient')->name('create_Patient');
    });
// [patient_controller----------------------------]

// [patient_history_controller----------------------------]
    Route::controller(PatientHistoryController::class)->group(function(){
        Route::post('/patient-save-history', 'savePatientHistory')->name('savePatientHistory'); 
        Route::get('/patient-service-history','patientServiceHistory')->name('patient_service_history');
        Route::get('/patient-details/{id}','getPatientDetails')->name('get_patient_details');
        Route::get('/invoice/{invoiceId}','showInvoice')->name('show_invoice');
    });
// [patient_history_controller----------------------------]

// // [Invoice------------------------------------]
//     Route::controller(InvoiceController::class)->group(function(){
//         Route::post('/create-invoice','createInvoice')->name('create_invoice');
//         Route::get('/show-invoice/{invoice_id}','showInvoice')->name('invoice_show');
//     });
// // [Invoice------------------------------------]


