<?php

use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\CompletedTreatmentDataController;
use App\Http\Controllers\CompletedTreatmentPlanController;
use App\Http\Controllers\Dashbaord\DashboardController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\DoctorNotedBookController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\PatientHistory\PatientHistoryController;
use App\Http\Controllers\PatientSummary\PatientSummaryController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\PaymentOrthoController;
// use App\Http\Controllers\Profile\ProfileController as ProfileProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Report\ReportPatientsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Reports\ReportsController;
use App\Http\Controllers\Reports\ReportServiceController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\TempServiceDataController;
use App\Http\Controllers\uploadMultiImage\uploadMultiImageController;
use App\Models\CompletedTreatmentPlan;
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
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    require __DIR__.'/auth.php';
// [Admin---------------------------------]


// [dashboard_controller----------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(DashboardController::class)->group(function(){
            Route::get('/', 'dashboard')->name('dashboard');
        });
    });
// [dashboard_controller----------------------------]

// [payment_controller----------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(PaymentController::class)->group(function(){
            Route::get('/payment','view_Payment')->name('view_Payment');
            Route::post('/create-patient','create_Patient')->name('create_Patient');
        });
    });
// [payment_controller----------------------------]

// [service_controller----------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(ServiceController::class)->group(function(){
            Route::get('/create-service','add_Service')->name('add_Service');
            Route::post('/add-service','create_Service')->name('create_Service');
            Route::get('/list-service','view_Service')->name('view_Service');
            Route::get('/edit-service/{id}','edit_Service')->name('edit_Service');

            Route::delete('/service-delete/{id}','serviceDelete')->name('service_Delete');
            Route::get('/service-edit/{id}','serviceEdit')->name('service_Edit');
            Route::post('/service-update/{id}','serviceUpdate')->name('service_Update');
        });
    });
// [service_controller----------------------------]

// [patient_controller----------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(PatientController::class)->group(function(){
            Route::get('/add-patient','add_Patient')->name('add_Patient');
            Route::get('/list-patient','view_Patient')->name('list_Patient');
            Route::post('/create-patient','create_Patient')->name('create_Patient');
            Route::post('/update-patient/{id}','update')->name('patient.update');
            Route::get('/get-patient-history/{id}','getPatientHistory');
            Route::get('/view-patient-detail/{id}','viewPatientDetail')->name('view_patient_detail');
            Route::get('/list-appointment-patient','appointment_patient')->name('appointment_patient');
        });
    });
// [patient_controller----------------------------]

// [patient_history_controller----------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(PatientHistoryController::class)->group(function(){
            Route::post('/patient-save-history', 'savePatientHistory')->name('savePatientHistory'); 
            Route::get('/patient-service-history','patientServiceHistory')->name('patient_service_history');
            Route::get('/patient-ortho-service-history','patientOrthoServiceHistory')->name('patient_ortho_service_history');
            Route::get('/patient-details/{id}','getPatientDetails')->name('get_patient_details');
            Route::get('/invoice/{invoiceId}','showInvoice')->name('show_invoice');
            Route::get('/get-patient-noted','getPatientNoted')->name('patient_noted');
            Route::get('/get-patient-all-history/{invoice_id}','editHistoryPatient')->name('history_patient.edit');
            Route::post('/edit-patient-all-history/{invoice_id}', 'updateHistoryPatient')->name('history_patient.update');
        });
    });
// [patient_history_controller----------------------------]

// [Invoice------------------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(ReportsController::class)->group(function(){
            Route::get('/main/api_generate_default','Report')->name('view_report');
        });
    });
// [Invoice------------------------------------]

// [Notification-------------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(AppointmentController::class)->group(function(){
            Route::get('/update-appointments','showForm')->name('appointments.form');
            Route::put('/create-appointments/{id}','update')->name('appointments.update');
        });
        Route::controller(NotificationController::class)->group(function(){
            Route::get('/notifications','index')->name('notifications.index');
        });
    });
    Route::controller(NotificationController::class)->group(function(){
        Route::get('/send-notification-telegram','sendAppointmentNotifications');
    });
// [Notification-------------------------------]

// [Doctor------------------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(DoctorController::class)->group(function(){
            Route::get('/create-doctor','index')->name('doctor.index');
            Route::post('/add-doctor','create')->name('doctor.create');
            Route::get('/list-doctor','list')->name('doctor.list');
            Route::post('/update-doctor/{id}','update')->name('doctor.update');
            Route::delete('/delete-doctor/{id}','destroy')->name('doctor.destroy');
        });
    });
// [Doctor------------------------------------]

// [Cashier--------------------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(CashierController::class)->group(function(){
            Route::get('/create-cashier','index')->name('cashier.index');
            Route::post('/add-cashier','create')->name('cashier.create');
            Route::get('/list-cashier','list')->name('cashier.list');
            Route::post('/update-cashier/{id}','update')->name('cashier.update');
        });
    });
// [Cashier--------------------------------------]

// [uploadMultiImage-----------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(uploadMultiImageController::class)->group(function(){
            Route::get('/upload-image','index')->name('uploadMultiImage.index');
            Route::post('/create-image','store')->name('uploadMultiImage.store');
            Route::get('/get-images/{invoiceId}', 'getImages')->name('uploadMultiImage.view');
            Route::post('/delete-image','deleteImage')->name('uploadMultiImage.destroy');
        });
    });
// [uploadMultiImage-----------------------------]

// [report-----------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(ReportPatientsController::class)->group(function(){
            Route::get('/report-patients','index')->name('reports.index');
            Route::get('/export-patient-history','exportPatientHistory')->name('export.patient.all_history');
            Route::get('/search-patient-history','searchPatientHistory')->name('search.patient.all_history');
        });
    });
// [report-----------------------------]

// [Calendar-----------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(CalendarController::class)->group(function(){
            Route::get('/calendar','index')->name('calendar.index');
            Route::post('/calendar/store', 'store')->name('calendar.store');
            Route::get('/calendar/show/{id}', 'show')->name('calendar.show');
            Route::put('/calendar/update/{id}', 'update')->name('calendar.update');
            Route::delete('/calendar/destroy{id}', 'destroy')->name('calendar.destroy');
        });
    });
// [Calendar-----------------------------]

// [patient_history_controller----------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(PaymentOrthoController::class)->group(function(){
            Route::get('/payment-ortho','index')->name('payment.ortho.index');
        });
    });
// [patient_history_controller----------------------------]

// [doctor_notebook_controller----------------------------]
   Route::middleware('auth')->group(function () {
        Route::controller(DoctorNotedBookController::class)->group(function(){
            Route::get('/get-doctor-notebook/{id}','index')->name('doctor.notebook.index');
            Route::post('/store-doctor-notebook','store')->name('doctor.notebook.store');
            Route::delete('/delete-doctor-notebook/{id}', 'destroy')->name('doctor.notebook.destroy');
            Route::get('/doctor-notebook/{id}', 'edit')->name('doctor.notebook.edit');
            Route::put('/update-doctor-notebook/{id}', 'update')->name('doctor.notebook.update');
        });
   });
// [doctor_notebook_controller----------------------------]

// [temp_service_data---------------------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(TempServiceDataController::class)->group(function(){
           Route::post('/store-temp-services','store');
           Route::get('/get-services/{id}','getServices');
           Route::post('/post-treatment/{id}','saveTreatment');
           Route::get('/get-treatment/{id}','getTreatment');
        });
    });
// [temp_service_data---------------------------------------]


// [completed_treatment_plan---------------------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(CompletedTreatmentPlanController::class)->group(function(){
           Route::post('/completed-treatment-plan','store');
           Route::get('/view_invoice','view_invoice')->name('view_invoice');
        });
    });
// [completed_treatment_plan---------------------------------------]

// [completed_save_print_treatment---------------------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(CompletedTreatmentDataController::class)->group(function(){
           Route::post('/completed-treatment','store');
           Route::get('/view_invoice_treatment','view_invoice')->name('view_invoice_treatment');
        });
    });
// [completed_save_print_treatment---------------------------------------]

// [update_amount_unpaid---------------------------------------]
    Route::middleware('auth')->group(function () {
        Route::controller(CompletedTreatmentPlanController::class)->group(function(){
           Route::post('/update-amount','updateAmount');
        });
    });
// [update_amount_unpaid---------------------------------------]
