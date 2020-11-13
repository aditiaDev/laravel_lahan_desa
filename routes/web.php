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

Route::group(['middleware' => ['auth','CekRole:admin,user']], function(){
    Route::get('/data-tables', function () {
        return view('contents.data-tables');
    });
});

// Route::get('/data-tables', function () {
//     return view('contents.data-tables');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
