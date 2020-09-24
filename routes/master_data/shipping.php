<?php

Route::group(['prefix' => 'shipping',
    'as' => 'shipping.',
    'middleware' => ['permission:master-pengiriman-manage']
], function () {
    Route::get('/', 'MasterData\Shipping\ShippingController@index')->name('index');
    Route::get('/create', 'MasterData\Shipping\ShippingController@create')
        ->name('create')
        ->middleware('permission:master-pengiriman-create');
    Route::post('/store', 'MasterData\Shipping\ShippingController@store')
        ->name('store')
        ->middleware('permission:master-pengiriman-create');
    Route::get('/{shipping}/edit', 'MasterData\Shipping\ShippingController@edit')
        ->name('edit')
        ->middleware('permission:master-pengiriman-update');
    Route::patch('/{shipping}/update', 'MasterData\Shipping\ShippingController@update')
        ->name('update')
        ->middleware('permission:master-pengiriman-update');
    Route::delete('/destroy', 'MasterData\Shipping\ShippingController@destroy')
        ->name('destroy')
        ->middleware('permission:master-pengiriman-delete');
});