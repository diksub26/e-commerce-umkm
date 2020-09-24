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
}
