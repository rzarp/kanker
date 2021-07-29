<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');

    Route::get('/profile', 'ProfileController@editProfile')->name('profile');
    Route::put('/profile/action', 'ProfileController@updateProfile')->name('profile.action');

    // user
    Route::resource('user', UserController::class);

    // patient
    Route::resource('patient', PatientController::class);
    Route::get('patient-progress/{patientId}', 'PatientProgressController@index')->name('patient.progress');
    Route::post('patient-progress/{patientId}/create', 'PatientProgressController@create')->name('patient.progress.create');
    Route::delete('patient-progress/delete', 'PatientProgressController@delete')->name('patient.progress.delete');

    // analyze
    Route::get('/analyze', 'AnalyzeController@index')->name('analyze');
});
