<?php

namespace App\Http\Controllers\MasterData\Shipping;

use Illuminate\Http\Request;
use App\Model\Shipping\Shipping;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\ShippingDataTables;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDataTables $dataTable)
    {
        return $dataTable->render('masterdata.shipping.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masterdata.shipping.create');
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
            'name' => 'required|max:100'
        ]);

        if(!auth()->user()->umkm){
            return redirect()->back()
            ->withInput()
            ->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat menyimpan data, silahkan logout dan login kembali."));
        };

        try {
            $category = Shipping::create([
                'umkm_id' => auth()->user()->umkm->id,
                'name' => $request->name,
            ]);

            return redirect()->route('masterdata.shipping.index')
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
     * @param  \App\Model\Shipping\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        if($shipping->umkm_id != auth()->user()->umkm->id){
            return abort(404);
        };

        return view('masterdata.shipping.edit')
            ->withShipping($shipping);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Shipping\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        if($shipping->umkm_id != auth()->user()->umkm->id){
            return abort(404);
        };

        $request->validate([
            'name' => 'required|max:100'
        ]);

        try {
            $shipping->name = $request->name;
            $shipping->save();

            return redirect()->route('masterdata.shipping.index')
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'shipping'   => 'required|exists:shippings,id',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'Error',
                'message' => 'Data Produk yang dipilih tidak valid'
            ], 500);
        }

        try {
            $data = Shipping::find($request->shipping);
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
