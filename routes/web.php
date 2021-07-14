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

// Route::get('/', function () {
//     return view('welcome');
// });

//admin
// Route::get('/','DashboardController@login')->name('login');
Route::get('/','DashboardController@dashboard')->name('dashboard');

Route::get('/inputdatapasien','DashboardController@inputpasien')->name('input.datapasien');
Route::get('/lihatdatapasien','DashboardController@datapasien')->name('lihat.datapasien');

Route::get('/inputregispasien','DashboardController@inputregispasien')->name('input.regispasien');
Route::get('/lihatregispasien','DashboardController@dataregis')->name('lihat.regispasien');