<?php

namespace App\Model\Shipping;

use App\Traits\ActionButtonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ongkir extends Model
{
    use SoftDeletes, ActionButtonTrait;

    protected $fillable = [
        'shipping_id',
        'province_id',
        'city_id',
        'ongkir'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at',
        'deleted_at'
    ];

    protected $routeEdit = [
        'name' => 'masterdata.ongkir.edit',
        'paramName' => 'ongkir'
    ];

    public function shipping()
    {
        return $this->belongsTo('App\Model\Shipping\Shipping', 'shipping_id', 'id');
    }

    public function province()
    {
        return $this->hasOne('App\Model\Indonesia\Province', 'id', 'province_id');
    }

    public function city()
    {
        return $this->hasOne('App\Model\Indonesia\City', 'id', 'city_id');
    }
}
