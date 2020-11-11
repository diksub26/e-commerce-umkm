<?php

Route::group(['prefix' => 'ongkir',
    'as' => 'ongkir.',
    'middleware' => ['permission:master-ongkir-manage']
], function () {
    Route::get('/', 'MasterData\Shipping\OngkirController@index')->name('index');
    Route::get('/create', 'MasterData\Shipping\OngkirController@create')
        ->name('create')
        ->middleware('permission:master-pengiriman-create');
    Route::post('/store', 'MasterData\Shipping\OngkirController@store')
        ->name('store')
        ->middleware('permission:master-pengiriman-create');
    Route::get('/{ongkir}/edit', 'MasterData\Shipping\OngkirController@edit')
        ->name('edit')
        ->middleware('permission:master-pengiriman-update');
    Route::patch('/{ongkir}/update', 'MasterData\Shipping\OngkirController@update')
        ->name('update')
        ->middleware('permission:master-pengiriman-update');
    Route::delete('/destroy', 'MasterData\Shipping\OngkirController@destroy')
        ->name('destroy')
        ->middleware('permission:master-pengiriman-delete');
});