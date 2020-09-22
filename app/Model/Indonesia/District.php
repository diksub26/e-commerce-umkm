<?php

namespace App\Model\Indonesia;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'indonesia_districts';
    
    protected $fillable = [
        'name',
        'meta',
        'city_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
