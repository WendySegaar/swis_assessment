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

    /**
     * SchoolHoliday has many regions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regions()
    {
        return $this->hasMany(Region::class, 'school_holiday_id', 'school_holiday_id');
    }

}
