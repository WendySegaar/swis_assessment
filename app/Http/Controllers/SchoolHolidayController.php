<?php

namespace App\Http\Controllers;

use App\SchoolHoliday;
use App\Content;
use App\Region;

class SchoolHolidayController extends Controller
{
    public function index()
    {
        $get_schoolyears = SchoolHoliday::select('schoolyear')->distinct()->pluck('schoolyear');

        $schoolyears = [];
        foreach ($get_schoolyears as $key => $schoolyear) {
            $schoolyears[$key] = [
                'displaySchoolyear' => $schoolyear,
                'schoolyear' => str_replace(' - ', "-", $schoolyear)
            ];
        }

        return view('index', compact('schoolyears'));
    }
    
}
