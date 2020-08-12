<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class IndonesiaController extends Controller
{
    public function getProvinces(Request $request)
    {
        try{
            $provinces = \Indonesia::allProvinces();
            $data = array();
            
            foreach($provinces as $val){
                $data[] = array(
                    'id' => $val->id,
                    'text' => $val->name
                );
            }

            return response()->json($data, 200);
        }catch(\Exception $e){
            if(env('APP_DEBUG') == 'true'){
                dd($e);
            }

            $data = array(
                'id' => '',
                'text' => '',
            );
            return response()->json($data, 200);
        }
    }
    public function getCities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(array('id' => '', 'text' => ''), 200);       
        }

        try{
            $cities = \Indonesia::findProvince($request->id, ['cities']);
            $data = array();

            foreach($cities->cities as $key => $val){
                $data[] = array(
                    'id' => $val->id,
                    'text' => $val->name
                );
            }

            return response()->json($data, 200);
        }catch(\Exception $e){
            if(env('APP_DEBUG') == 'true'){
                dd($e);
            }

            $data = array(
                'id' => '',
                'text' => '',
            );
            return response()->json($data, 200);
        }
    }

    public function getDistricts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(array('id' => '', 'text' => ''), 200);       
        }

        try{
            $districts = \Indonesia::findCity($request->id, ['districts']);
            $data = array();

            foreach($districts->districts as $key => $val){
                $data[] = array(
                    'id' => $val->id,
                    'text' => $val->name
                );
            }

            return response()->json($data, 200);
        }catch(\Exception $e){
            if(env('APP_DEBUG') == 'true'){
                dd($e);
            }

            $data = array(
                'id' => '',
                'text' => '',
            );
            return response()->json($data, 200);
        }
    }

    public function getVillages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(array('id' => '', 'text' => ''), 200);       
        }

        try{
            $villages = \Indonesia::findDistrict($request->id, ['villages']);
            $data = array();

            foreach($villages->villages as $key => $val){
                $data[] = array(
                    'id' => $val->id,
                    'text' => $val->name
                );
            }

            return response()->json($data, 200);
        }catch(\Exception $e){
            if(env('APP_DEBUG') == 'true'){
                dd($e);
            }

            $data = array(
                'id' => '',
                'text' => '',
            );
            return response()->json($data, 200);
        }
    }

    public function travel(Request $request)
    {
        $response = array(
            'status' => 'ERROR',
            'msg' => 'Error, Data Tidak Tersedia',
            'data' => '',
        );

        switch ($request) {
            case isset($request->jenis):
                $validator = Validator::make($request->all(), [
                    'city' => 'required',
                    'jenis' => 'required|numeric|max:3'
                ]);
        
                if ($validator->fails()) {
                    return response()->json(array('data' => ['id' => '', 'text' => '']), 200);       
                }
               
                $data = \App\Model\VendorShipping::select('vendor_shippings.id as id', 'vendor_shippings.name as text')
                ->distinct()
                ->join('ms_ongkirs','vendor_shippings.id', '=', 'ms_ongkirs.vendor_shipping_id')
                ->where('ms_ongkirs.destination_city', $request->city)
                ->where('vendor_shippings.jenis_travel', $request->jenis)
                ->whereNull('ms_ongkirs.deleted_at')
                ->get();

                $response = array(
                    'status' => 'SUCCESS',
                    'data' => $data,
                );

            break;
            case isset($request->provincy):
                $validator = Validator::make($request->all(), [
                    'provincy' => 'required|numeric'
                ]);
        
                if ($validator->fails()) {
                    return response()->json(array('data' => ['id' => '', 'text' => '']), 200);       
                }

                $data = \App\Model\MsOngkir::select('indonesia_cities.id as id','indonesia_cities.name as text')
                ->distinct()
                ->join('indonesia_cities', 'ms_ongkirs.destination_city','=','indonesia_cities.id')
                ->join('vendor_shippings', 'ms_ongkirs.vendor_shipping_id','=','vendor_shippings.id')
                ->where('destination_provincy', $request->provincy)
                ->whereNull('ms_ongkirs.deleted_at')
                ->get();

                $response = array(
                    'status' => 'SUCCESS',
                    'data' => $data,
                );

            break;
            case isset($request->city):
                /** pick point */
                if(isset($request->travel) && isset($request->pick_point)){
                    $validator = Validator::make($request->all(), [
                        'city' => 'required',
                        'travel' => 'required|numeric',
                        'pick_point' => 'required'
                    ]);
            
                    if ($validator->fails()) {
                        return response()->json(array('data' => ['id' => '', 'text' => '']), 200);       
                    }
    
                    $data = \App\Model\MsOngkir::select('id as id','destination_poll as text')
                    ->where('vendor_shipping_id', $request->travel)
                    ->where('ms_ongkirs.destination_city', $request->city)
                    ->where('pick_point', $request->pick_point)
                    ->whereNull('ms_ongkirs.deleted_at')
                    ->get();

                    $ongkir = \App\Model\MsOngkir::select('id','price_per_kg','price_per_22_kg')
                    ->where('vendor_shipping_id', $request->travel)
                    ->where('ms_ongkirs.destination_city', $request->city)
                    ->where('pick_point', $request->pick_point)
                    ->whereNull('ms_ongkirs.deleted_at')
                    ->get();

                    $response = array(
                        'status' => 'SUCCESS',
                        'data' => $data,
                        'ongkir' => $ongkir,
                    );

                }else if($request->travel){
                    $validator = Validator::make($request->all(), [
                        'travel' => 'required|numeric',
                        'city' => 'required|numeric'
                    ]);
            
                    if ($validator->fails()) {
                        return response()->json(array('data' => ['id' => '', 'text' => '']), 200);       
                    }
    
                    $data_db = \App\Model\MsOngkir::select('ms_ongkirs.pick_point as text')
                    ->distinct()
                    ->where('vendor_shipping_id', $request->travel)
                    ->where('ms_ongkirs.destination_city', $request->city)
                    ->whereNull('ms_ongkirs.deleted_at')
                    ->get();

                    $data = array();
                    foreach ($data_db as $value) {
                        $data[] = array(
                            'id' => $value->text,
                            'text' => $value->text
                        );
                    };

                    $response = array(
                        'status' => 'SUCCESS',
                        'data' => $data,
                    );
                }else{
                    $validator = Validator::make($request->all(), [
                        'city' => 'required|numeric'
                    ]);
            
                    if ($validator->fails()) {
                        return response()->json(array('data' => ['id' => '', 'text' => '']), 200);       
                    }
    
                    $data = \App\Model\VendorShipping::select('vendor_shippings.jenis_travel as jenis')
                    ->distinct()
                    ->join('ms_ongkirs', 'vendor_shippings.id','=','ms_ongkirs.vendor_shipping_id')
                    ->where('ms_ongkirs.destination_city', $request->city)
                    ->get();
    
                    if($data){
                        $data_mapping = array();
    
                        foreach($data as $val){
                            $jenis_travel = 'Bus Travel';
                            if($val->jenis != '1'){
                                $jenis_travel = 'Cargo Kereta';
                            };
    
                            $data_mapping[] = array(
                                'id' => $val->jenis,
                                'text' => $jenis_travel
                            );
                        }
    
                        $response = array(
                            'status' => 'SUCCESS',
                            'data' => $data_mapping,
                        );
                    }
                }
            break;
        }

        return response()->json($response, 200);

    }
}
