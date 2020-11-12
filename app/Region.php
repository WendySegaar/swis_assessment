<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Region extends Model
{
    protected $primaryKey = 'region_id';

    protected $fillable = [
        'region',
        'start_date',
        'end_date',
        'school_holiday_id'
    ];

    /**
     * Region belong to SchoolHoliday
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school_holiday()
    {
        return $this->belongsTo(SchoolHoliday::class, 'school_holiday_id', 'school_holiday_id');
    }


    public function getFormattedDateAttribute()
    {
        $start_date = Carbon::parse($this->start_date)->locale('nl')->translatedFormat('d F Y');
        $end_date = Carbon::parse($this->end_date)->locale('nl')->translatedFormat('d F Y');
        return "{$start_date} - {$end_date}";
    }
}
