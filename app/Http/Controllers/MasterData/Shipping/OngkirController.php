<?php

namespace App\Http\Controllers\MasterData\Shipping;

use Illuminate\Http\Request;
use App\Model\Shipping\Ongkir;
use App\Model\Shipping\Shipping;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\Shipping\OngkirDataTables;

class OngkirController extends Controller
{
    public function index(OngkirDataTables $dataTable)
    {
        return $dataTable->render('masterdata.ongkir.index');
    }

    public function create()
    {
        $shipping = Shipping::listSelectHtml();
        return view('masterdata.ongkir.create', compact('shipping'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_id' => 'exists:shippings,id',
            'province_id' => 'exists:indonesia_provinces,id',
            'city_id' => 'exists:indonesia_cities,id',
            'ongkir' => 'numeric',
        ]);

        // cek shipping
        $shipping = Shipping::select('id')
                    ->where('umkm_id', auth()->user()->umkm->id)
                    ->where('id', $request->shipping_id)
                    ->first();
        
        if($shipping){
            return redirect()->back()
            ->withInput()
            ->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat menyimpan data, Data Master Pengiriman Tidak Ditemukan."));
        }

        // cek available ongkir
        $ongkir = Ongkir::select('id')
                ->where('shipping_id', $request->shipping_id)
                ->where('province_id', $request->province_id)
                ->where('city_id', $request->city_id)
                ->first();

        if($ongkir){
            return redirect()->back()
            ->withInput()
            ->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat menyimpan data, Data Ongkir Sudah Tersedia Untuk Wilayah Ini."));
        }

        try {
            DB::beginTransaction();
            Ongkir::create([
                'shipping_id' => $request->shipping_id,
                'province_id' =>  $request->province_id,
                'city_id' =>  $request->city_id,
                'ongkir' =>  $request->ongkir,
            ]);
            DB::commit();
            return redirect()->route('masterdata.ongkir.index')
                            ->with('msg', array(
                                "type" => "success",
                                "msg" => "<h4><i class='fa fa-check'></i> Success</h4> Data Berhasil disimpan."
                            ));
        } catch (\Throwable $th) {
            DB::rollback();
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

    public function edit(Ongkir $ongkir)
    {
        if($ongkir->shipping->umkm_id != auth()->user()->umkm->id){
            return abort(404);
        }

        $shipping = Shipping::listSelectHtml();
        return view('masterdata.ongkir.edit', compact('shipping', 'ongkir'));
    }

    public function update(Request $request, Ongkir $ongkir)
    {
        if($ongkir->shipping->umkm_id != auth()->user()->umkm->id){
            return abort(404);
        }

        $request->validate([
            'shipping_id' => 'exists:shippings,id',
            'province_id' => 'exists:indonesia_provinces,id',
            'city_id' => 'exists:indonesia_cities,id',
            'ongkir' => 'numeric',
        ]);

        // cek shipping
        $shipping = Shipping::select('id')
                    ->where('umkm_id', auth()->user()->umkm)
                    ->where('id', $request->shipping_id)
                    ->first();
        
        if($shipping){
            return redirect()->back()
            ->withInput()
            ->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat menyimpan data, Data Master Pengiriman Tidak Ditemukan."));
        }

        // cek available ongkir
        $ongkirAvail = Ongkir::select('id')
                ->where('shipping_id', $request->shipping_id)
                ->where('province_id', $request->province_id)
                ->where('city_id', $request->city_id)
                ->first();

        if($ongkirAvail->id != $ongkir->id){
            return redirect()->back()
            ->withInput()
            ->with('msg', array("type" => "danger", "msg" => "<h4><i class='fa fa-ban'></i> Error</h4> Ada Kesalahan saat menyimpan data, Data Ongkir Sudah Tersedia Untuk Wilayah Ini."));
        }

        try {
            DB::beginTransaction();
            $ongkir->shipping_id = $request->shipping_id;
            $ongkir->province_id =  $request->province_id;
            $ongkir->city_id =  $request->city_id;
            $ongkir->ongkir =  $request->ongkir;

            $ongkir->save();
            DB::commit();

            return redirect()->route('masterdata.ongkir.index')
                            ->with('msg', array(
                                "type" => "success",
                                "msg" => "<h4><i class='fa fa-check'></i> Success</h4> Data Berhasil dipebarui."
                            ));
        } catch (\Throwable $th) {
            DB::rollback();
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

    public function destroy(Ongkir $ongkir)
    {
        //
    }
}
