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

    public function province()
    {
        return $this->hasOne('App\Model\Indonesia\Province', 'id', 'province_id');
    }

    public function city()
    {
        return $this->hasOne('App\Model\Indonesia\City', 'id', 'city_id');
    }

    public function district()
    {
        return $this->hasOne('App\Model\Indonesia\District', 'id', 'district_id');
    }

    public function village()
    {
        return $this->hasOne('App\Model\Indonesia\Village', 'id', 'village_id');
    }

    public function getFullAddressAttribute()
    {
        return ucfirst($this->address).' '. ucwords(strtolower($this->province->name)).
            ' '. ucwords(strtolower($this->city->name)) . ' '. ucwords(strtolower($this->district->name)).
            ' '. ucwords(strtolower($this->village->name)).' Kode Pos '. $this->postal_code;
    }
}
