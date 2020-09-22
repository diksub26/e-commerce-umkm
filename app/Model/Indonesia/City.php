<?php

namespace App\Model\Indonesia;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'indonesia_cities';
    
    protected $fillable = [
        'name',
        'meta',
        'province_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
