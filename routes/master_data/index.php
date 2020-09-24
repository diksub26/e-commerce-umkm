<?php

Route::group(['prefix' => 'master-data', 'as' => 'masterdata.', 'middleware' => 'permission:master-data-manage'], function () {
    include('product.php');
    include('shipping.php');
});