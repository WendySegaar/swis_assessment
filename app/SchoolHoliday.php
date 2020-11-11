<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolHoliday extends Model
{
    protected $primaryKey = 'school_holiday_id';

    protected $fillable = [
        'schoolyear',
        'type',
        'compulsory_dates'
    ];
}
