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

// frontend
Route::group(['namespace' => '\App\Http\Controllers', 'prefix' => '/'], function () {

    Route::get('/xxx-video/{slug}', 'HomeController@index');
    Route::get('/test', 'TestController@index');
    Route::post('/login', 'HomeController@login')->name('fe.login');

    Route::get('/admin-login', function () {
        return view('backend.login');
    })->name('fe.admin-login');
    Route::post('/admin-login', 'HomeController@admin')->name('fe.admin-login.post');
});


// backend
Route::group(['namespace' => '\App\Http\Controllers', 'prefix' => '/admin', 'middleware' => 'admin'], function () {

    Route::get('/', 'HomeController@getAccount')->name('be.getAccount');
    Route::get('/download', 'HomeController@download')->name('be.download');


});
