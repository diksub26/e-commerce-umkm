<?php

Route::group(['prefix' => 'product',
    'as' => 'product.',
], function () {
    Route::get('/', 'MasterData\Product\ProductController@index')->name('index')->middleware('permission:product-manage');
    Route::get('/create', 'MasterData\Product\ProductController@create')->name('create');
});

Route::group(['prefix' => 'category-product',
    'as' => 'categoryProduct.',
], function () {
    Route::get('/', 'MasterData\Product\CategoryProductController@index')->name('index')->middleware('permission:category-product-manage');
    Route::get('/create', 'MasterData\Product\CategoryProductController@create')->name('create');
    Route::post('/store', 'MasterData\Product\CategoryProductController@store')->name('store');
    Route::get('{category}/edit', 'MasterData\Product\CategoryProductController@edit')->name('edit');
    Route::patch('/store', 'MasterData\Product\CategoryProductController@update')->name('update');
    Route::delete('/destroy', 'MasterData\Product\CategoryProductController@destroy')->name('destroy');
});