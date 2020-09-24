<?php

namespace App\Model\Product;

use App\Traits\ActionButtonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model
{
    use SoftDeletes, ActionButtonTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'umkm_id',
        'parent_id',
        'is_parent',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 
        'updated_at',
        'parent_id',
        'is_parent',
        'deleted_at'
    ];

    protected $routeEdit = [
        'name' => 'masterdata.categoryProduct.edit',
        'paramName' => 'category'
    ];
    
    public function parent()
    {
        return $this->hasOne('App\Model\Product\CategoryProduct', 'id', 'parent_id');
    }

    public function child()
    {
        return $this->hasMany('App\Model\Product\CategoryProduct', 'parent_id', 'id');
    }

    public static function listSelectHtml()
    {
        $data = self::select('id', 'name')->where('is_parent', true)->get();
        $list = '';
        foreach ($data as $parent) {
            if(!$parent->child->isEmpty()){
                $list .= '<optgroup label="'. $parent->name.'">';
                foreach ($parent->child as $child) {
                    $list .= '<option value="'.$child->id.'">'.$child->name.'</option>';
                }
                $list .= '</optgroup>';
            }
        }

        return $list;
    }
   
}
