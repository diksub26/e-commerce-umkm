<?php

Route::group(['prefix' => 'product',
    'as' => 'product.',
    'middleware' => ['permission:product-manage']
], function () {
    Route::get('/', 'MasterData\Product\ProductController@index')->name('index');
    Route::get('/create', 'MasterData\Product\ProductController@create')
        ->name('create')
        ->middleware('permission:product-create');
    Route::get('/{product}/edit', 'MasterData\Product\ProductController@edit')
        ->name('edit')
        ->middleware('permission:product-update');
    Route::post('/store', 'MasterData\Product\ProductController@store')
        ->name('store')
        ->middleware('permission:product-create');
    Route::patch('/{product}/store', 'MasterData\Product\ProductController@update')
        ->name('update')
        ->middleware('permission:product-update');
    Route::delete('/destroy', 'MasterData\Product\ProductController@destroy')
        ->name('destroy')
        ->middleware('permission:product-delete');
});

Route::group(['prefix' => 'category-product',
    'as' => 'categoryProduct.',
    'middleware' => ['permission:category-product-manage']
], function () {
    Route::get('/', 'MasterData\Product\CategoryProductController@index')
        ->name('index');
    Route::get('/create', 'MasterData\Product\CategoryProductController@create')
        ->name('create')
        ->middleware('permission:category-product-create');
    Route::post('/store', 'MasterData\Product\CategoryProductController@store')
        ->name('store')
        ->middleware('permission:category-product-create');
    Route::get('{category}/edit', 'MasterData\Product\CategoryProductController@edit')
        ->name('edit')
        ->middleware('permission:category-product-update');
    Route::patch('/store', 'MasterData\Product\CategoryProductController@update')
        ->name('update')
        ->middleware('permission:category-product-update');
    Route::delete('/destroy', 'MasterData\Product\CategoryProductController@destroy')
        ->name('destroy')
        ->middleware('permission:category-product-delete');
});