<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacilityInfo extends Model
{
    protected $guarded = [];

    protected $table = 'facility_info';

    public function getPerDiemAttribute($per_diem)
    {
        return number_format($per_diem / 100, 2, '.', ',');
    }

}
