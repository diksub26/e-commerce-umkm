<?php

Route::group(['prefix' => 'product',
    'as' => 'product.',
], function () {
    Route::get('/', 'MasterData\Product\ProductController@index')->name('index')->middleware('permission:product-manage');
    Route::get('/create', 'MasterData\Product\ProductController@create')->name('create');
});