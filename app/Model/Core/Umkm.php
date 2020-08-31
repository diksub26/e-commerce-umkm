<?php

namespace App\Model\Core;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use UuidTraits;
    protected $table = 'umkm';
    public $incrementing = false;
    
    protected $fillable = [
        'user_id',
        'name',
        'no_telp',
        'description',
        'address',
        'postal_code',
        'province_id',
        'city_id',
        'district_id',
        'village_id', 
        'rekening_number',
        'umkm_pic',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'rekening_number',
        'umkm_pic', 
    ];
}
