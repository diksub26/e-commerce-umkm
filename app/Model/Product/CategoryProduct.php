<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model
{
    use SoftDeletes;

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
       'name',
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
}
