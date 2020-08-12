<?php

Route::group(['prefix' => 'shipping',
    'as' => 'shipping.',
], function () {
    Route::get('/', 'MasterData\Shipping\ShippingController@index')->name('index');
    Route::get('/create', 'MasterData\Shipping\ShippingController@create')->name('create');
});