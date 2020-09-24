<?php

namespace App\Http\Controllers\MasterData\Product;

use Illuminate\Http\Request;
use App\Model\Product\Product;
use App\Http\Controllers\Controller;
use App\Model\Product\CategoryProduct;
use App\DataTables\MasterData\Product\ProductDataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTables $dataTable)
    {
        return $dataTable->render('masterdata.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['categoryList'] = CategoryProduct::listSelectHtml();
        return view('masterdata.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:100",
            "price" => "required|numeric",
            "category" => "required|exists:category_products,id",
            "size" => "max:50",
            "description" => "required|max:250",
            "unit_weight" => "required|numeric",
            "weight" => "required|numeric",
        ]);

        if(!auth()->user()->umkm){
            return redirect()->back()
            ->withInput()
            ->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat menyimpan data, silahkan logout dan login kembali."));
        };

        try {
            $category = Product::create([
                'umkm_id' => auth()->user()->umkm->id,
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category,
                'size' => ($request->size ? $request->size : null),
                'description' => $request->description,
                'unit_weight' => $request->unit_weight,
                'weight' => $request->weight,
            ]);
            return redirect()->route('masterdata.product.index')
                            ->with('msg', array(
                                "type" => "success",
                                "msg" => "<h4><i class='fa fa-check'></i> Success</h4> Data Berhasil disimpan."
                            ));
        } catch (\Throwable $th) {
            $resp =  array(
                "type" => "danger",
                "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat menyimpan data, silahkan coba kembali."
            );

            if(env("APP_DEBUG") == true){
                $resp['msg'] = $th->getMessage();
            }
            return redirect()->back()
                ->withInput()
                ->with('msg', $resp);           
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product->umkm_id != auth()->user()->umkm->id){
            return abort(404);
        };

        $categoryList= CategoryProduct::listSelectHtml();
        return view('masterdata.product.edit')
            ->withProduct($product)
            ->withCategoryList($categoryList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($product->umkm_id != auth()->user()->umkm->id){
            return abort(404);
        };

        $request->validate([
            "name" => "required|max:100",
            "price" => "required|numeric",
            "category" => "required|exists:category_products,id",
            "size" => "max:50",
            "description" => "required|max:250",
            "unit_weight" => "required|numeric",
            "weight" => "required|numeric",
        ]);

        try {
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->category;
            $product->size = $request->size;
            $product->description = $request->description;
            $product->unit_weight = $request->unit_weight;
            $product->weight = $request->weight;

            $product->save();
            return redirect()->route('masterdata.product.index')
                ->with('msg', array(
                    "type" => "success",
                    "msg" => "<h4><i class='fa fa-check'></i> Success</h4> Data Berhasil diperbaharui."
                ));

        } catch (\Throwable $th) {
            $resp =  array(
                "type" => "danger",
                "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat memperbarui data, silahkan coba kembali."
            );

            if(env("APP_DEBUG") == true){
                $resp['msg'] = $th->getMessage();
            }
            return redirect()->back()
                ->withInput()
                ->with('msg', $resp);  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'product'   => 'required|exists:products,id',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => 'Data Produk yang dipilih tidak valid'
            ], 500);
        }

        try {
            $data = Product::find($request->product);
            if($data->umkm_id != auth()->user()->umkm->id){
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Anda Tidak memiliki akses untuk menghapus data ini, Kontak Administrator.'
                ], 500);
            }
            
            $result = $data->delete();
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            $resp = [
                'status' => 'Error',
                'message' => 'Anda Tidak memiliki akses untuk menghapus data ini, Kontak Administrator.'
            ];
            
            if(env("APP_DEBUG") == true){
                $resp['message'] = $th->getMessage();
            }
            return response()->json($resp, 500);
        }
    }
}
