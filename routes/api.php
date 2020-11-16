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
Route::get('/lahan/getkabupatendata', 'LahanController@getKabupatenData');
Route::get('/lahan/getkecamatandata', 'LahanController@getKecamatanData');

Route::post('/lahan/savelahan', 'LahanController@store')->name('savelahan');