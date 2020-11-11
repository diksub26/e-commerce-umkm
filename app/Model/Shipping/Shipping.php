<?php

namespace App\Model\Shipping;

use App\Traits\ActionButtonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use SoftDeletes, ActionButtonTrait;

    protected $fillable = [
        'umkm_id',
        'name'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at',
        'deleted_at'
    ];

    protected $routeEdit = [
        'name' => 'masterdata.shipping.edit',
        'paramName' => 'shipping'
    ];
    
    public function ongkir()
    {
        return $this->hasMany('App\Model\Shipping\Ongkir', 'id', 'shipping_id');
    }

    public static function listSelectHtml()
    {
        $data = self::select('id', 'name')->get();
        $list = '';
        foreach ($data as $val) {
            $list .= '<option value="'. $val->id.'">'. $val->name.'</option>';
        }

        return $list;
    }
}
