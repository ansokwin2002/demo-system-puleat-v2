<?php

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

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('backend.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// [service_controller----------------------------]
    Route::controller(ServiceController::class)->group(function(){
        Route::get('/add_Service','add_Service')->name('add_Service');
        Route::post('/create_Service','create_Service')->name('create_Service');
        Route::get('/view_Service','view_Service')->name('view_Service');
        Route::get('/edit_Service/{id}','edit_Service')->name('edit_Service');


        Route::delete('/serviceDelete/{id}','serviceDelete')->name('service_Delete');
        Route::get('/serviceEdit/{id}','serviceEdit')->name('service_Edit');
        Route::post('/serviceUpdate/{id}','serviceUpdate')->name('service_Update');
    });
// [service_controller----------------------------]

