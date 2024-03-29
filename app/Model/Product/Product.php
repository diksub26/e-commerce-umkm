<?php

namespace App\Model\Product;

use App\Traits\ActionButtonTrait;
use App\Traits\UuidWithUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use UuidWithUserTrait, SoftDeletes, ActionButtonTrait;

    public $incrementing = false;

     /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'umkm_id',
        'category_id',
        'name',
        'price',
        'description',
        'size',
        'weight',
        'unit_weight',
        'pic_1',
        'pic_2',
        'pic_3'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'created_at', 
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at'
    ];

    protected $routeEdit = [
        'name' => 'masterdata.product.edit',
        'paramName' => 'product'
    ];

    public function category()
    {
        return $this->hasOne('App\Model\Product\CategoryProduct', 'id', 'category_id');
    }
}
