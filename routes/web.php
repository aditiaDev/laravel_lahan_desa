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
//     return view('contents.home');
// });

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/data-tables', function () {
        return view('contents.data-tables');
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/master/provinsi', 'ProvinsiController@index')->name('provinsi')->middleware('CekRole:admin');
    Route::get('/master/kabupaten', 'KabupatenController@index')->name('kabupaten')->middleware('CekRole:admin');
    Route::get('/master/kecamatan', 'KecamatanController@index')->name('kecamatan')->middleware('CekRole:admin');
    Route::get('/master/desa', 'DesaController@index')->name('desa')->middleware('CekRole:admin');
    Route::get('/data_user', 'UserController@index')->name('data_user')->middleware('CekRole:admin');
    // Route::get('/master/provinsi/getprovinsidata', 'ProvinsiController@getProvinsiData')->name('getprovinsidata');
    Route::get('/lahan/inputlahan', 'LahanController@index')->name('inputlahan');
    Route::get('/lahan/datalahan', 'LahanController@datalahan')->name('datalahan');

    Route::get('/lahan/export_excel', 'LahanController@export_excel')->name('lahan_export');
    // Route::get('/lahan/getprovinsidata', 'LahanController@getProvinsiData');
});

// Route::get('/data-tables', function () {
//     return view('contents.data-tables');
// });

Auth::routes();


