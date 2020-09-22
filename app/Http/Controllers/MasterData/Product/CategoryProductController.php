<?php

namespace App\Http\Controllers\MasterData\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Product\CategoryProduct;
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
        $parent = CategoryProduct::select('id', 'name')
            ->where('is_parent', true)
            ->get();

        return view('masterdata.category-product.create')
            ->withParent($parent);
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
            'name' => 'required|max:50',
            'is_parent' => 'nullable|boolean',
        ]);

        if($request->is_parent != true){
            $request->validate([
                'parent_id' => 'required|exists:category_products,id',
            ]);
        }
        
        if(!auth()->user()->umkm){
            return redirect()->back()->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat menyimpan data, silahkan logout dan login kembali."));
        };

        try {
            DB::beginTransaction();
            $category = CategoryProduct::create([
                'umkm_id' => auth()->user()->umkm->id,
                'name' => $request->name,
                'is_parent' => ($request->is_parent ? $request->is_parent : false),
                'parent_id' => ($request->parent_id ? $request->parent_id : null),
            ]);
            DB::commit();

            return redirect()->route('masterdata.categoryProduct.index')
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
                ->with('msg', $resp);           
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product\CategoryProduct  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProduct $category)
    {
        if($category->umkm_id != auth()->user()->umkm->id){
            return abort(404);
        };

        $parent = CategoryProduct::select('id', 'name')
            ->where('is_parent', true)
            ->get();
        return view('masterdata.category-product.edit')
            ->withCategoryProduct($category)
            ->withParent($parent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product\CategoryProduct  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'   => 'required|exists:category_products,id',
            'name' => 'required|max:50',
        ]);
        
        if(!auth()->user()->umkm){
            return redirect()->back()->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat menyimpan data, silahkan logout dan login kembali."));
        };

        try {
            DB::beginTransaction();
            $category = CategoryProduct::find($request->id);

            if(!$category){
                return redirect()->back()->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Data Tidak Ditemukan."));
            }
            
            if($category->umkm_id != auth()->user()->umkm->id){
                return redirect()->back()->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Data Tidak Ditemukan."));
            };

            $category->name = $request->name;
            if($category->is_parent != true){
                $request->validate([
                    'parent_id' => 'required|exists:category_products,id',
                ]);
                $category->parent_id = $request->parent_id;
            }

            $category->save();
            DB::commit();

            return redirect()->route('masterdata.categoryProduct.index')
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
                ->with('msg', $resp);           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product\CategoryProduct  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'category'   => 'required|exists:category_products,id',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'Error',
                'msg' => 'Data Ketegori yang dipilih tidak valid'
            ], 500);
        }

        try {
            $data = CategoryProduct::find($request->category);
            if($data->umkm_id != auth()->user()->umkm->id){
                return response()->json([
                    'status' => 'Error',
                    'msg' => 'Anda Tidak memilik akses untuk menghapus data ini, Kontak Administrator.'
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
                'msg' => 'Anda Tidak memilik akses untuk menghapus data ini, Kontak Administrator.'
            ];
            
            if(env("APP_DEBUG") == true){
                $resp['msg'] = $th->getMessage();
            }
            return response()->json($resp, 500);
        }
    }
}
