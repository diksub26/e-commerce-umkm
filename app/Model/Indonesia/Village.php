<?php

namespace App\Model\Indonesia;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'indonesia_villages';
    
    protected $fillable = [
        'name',
        'meta',
        'district_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
