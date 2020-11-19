<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/master/provinsi/getprovinsidata', 'ProvinsiController@getProvinsiData')->name('getprovinsidata');
Route::get('/lahan/getprovinsidata', 'LahanController@getProvinsiData');
Route::get('/master/kabupaten/getkabupatendata', 'KabupatenController@getKabupatenData')->name('getkabupatendata');
Route::get('/master/kecamatan/getkecamatandata', 'KecamatanController@getKecamatanData')->name('getkecamatandata');
Route::get('/master/desa/getdesadata', 'DesaController@getDesaData')->name('getdesadata');
Route::get('/lahan/getkabupatendata', 'LahanController@getKabupatenData');
Route::get('/lahan/getkecamatandata', 'LahanController@getKecamatanData');
Route::get('/lahan/getdesadata', 'LahanController@getDesaData');

Route::post('/lahan/savelahan', 'LahanController@store')->name('savelahan');
Route::get('/lahan/getlahandata', 'LahanController@getlahandata')->name('getlahandata');
Route::get('/lahan/getdetaillahandata', 'LahanController@getdetaillahandata')->name('getdetaillahandata');
Route::post('/lahan/confirm_lahan', 'LahanController@confirm_lahan')->name('confirm_lahan');
Route::post('/lahan/delete_lahan', 'LahanController@delete_lahan')->name('delete_lahan');
Route::get('/data_user/getdatauser', 'UserController@getDataUser')->name('getdatauser');
Route::post('/user/saveuser', 'UserController@saveuser')->name('saveuser');