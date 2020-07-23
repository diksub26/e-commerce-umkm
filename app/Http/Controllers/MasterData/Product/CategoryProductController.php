<?php

namespace App\Http\Controllers\MasterData\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product\CategoryProductModel;
use App\DataTables\MasterData\Product\CategoryProductDataTables;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryProductDataTables $dataTable)
    {
        return $dataTable->render('masterdata.category-product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masterdata.category-product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product\CategoryProductModel  $categoryProductModel
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProductModel $categoryProductModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product\CategoryProductModel  $categoryProductModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProductModel $categoryProductModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product\CategoryProductModel  $categoryProductModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryProductModel $categoryProductModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product\CategoryProductModel  $categoryProductModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryProductModel $categoryProductModel)
    {
        //
    }
}
