<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $primaryKey = 'region_id';

    protected $fillable = [
        'region',
        'start_date',
        'end_date',
        'school_holiday_id'
    ];
}
