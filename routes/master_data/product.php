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
});