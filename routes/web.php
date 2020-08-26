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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
    Route::post('register/umkm-account', 'Auth\RegisterController@umkmAccount')->name('umkmAccount');    
    Route::post('register/umkm-data', 'Auth\RegisterController@umkmData')->name('umkmData');    
    Route::post('register/store-logo', 'Auth\RegisterController@saveUmkmPicture')->name('saveUmkmPicture');    
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    include('master_data/index.php');
});

Route::group(['prefix' => 'indonesia'], function () {
    Route::get('/province', 'Core\IndonesiaController@getProvinces')->name('getProvinces');
    Route::get('/city', 'Core\IndonesiaController@getCities')->name('getCities');
    Route::get('/district', 'Core\IndonesiaController@getDistricts')->name('getDistricts');
    Route::get('/village', 'Core\IndonesiaController@getVillages')->name('getVillages');
});
