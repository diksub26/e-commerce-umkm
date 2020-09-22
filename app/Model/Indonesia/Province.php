<?php

namespace App\Model\Indonesia;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'indonesia_provinces';
    
    protected $fillable = [
        'name',
        'meta',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
