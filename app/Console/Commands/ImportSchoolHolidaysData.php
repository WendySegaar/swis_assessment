<?php

namespace App\Console\Commands;

use App\Content;
use App\SchoolHoliday;
use App\Region;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ImportSchoolHolidaysData extends Command
{
    /**
     * The url with schoolholidays data
     */
    const DATA_URL = 'https://opendata.rijksoverheid.nl/v1/sources/rijksoverheid/infotypes/schoolholidays/schoolyear/2020-2021?output=json';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importSHData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command import schoolholiday data into database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Import schoolholiday data into database
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $request = $client->createRequest('GET', self::DATA_URL, ['verify' => false]);
        $response = $client->send($request);


        if ($response->getStatusCode() == 200) {

            $result = $response->json();
            $content = $result['content'][0];

            $title = trim($content['title']);
            $notice = trim(str_replace('&sup1;', '', $result['notice']));
            $authorities = trim($result['authorities'][0]);
            $rightsholders = trim($result['rightsholders'][0]);

            $this->saveContent($title, $notice, $result['license'], $authorities, $rightsholders, $result['location']);

            foreach ($content['vacations'] as $vacation) {
                $type = trim($vacation['type']);
                $schoolyear = trim($content['schoolyear']);

                $compulsory_dates = $this->convertToTinyInt($vacation['compulsorydates']);

                $school_holiday = $this->saveSchoolHoliday($schoolyear, $type, $compulsory_dates);

                foreach ($vacation['regions'] as $region) {

                    $start_date = Carbon::parse($region['startdate'])->format('Y-m-d H:i:s');
                    $end_date = Carbon::parse($region['enddate'])->format('Y-m-d H:i:s');
                    $this->saveRegion($region['region'], $school_holiday->school_holiday_id, $start_date, $end_date);
                }
            }
        } else {
            return false;
        }
    }

    /**
     * Save content to database
     *
     * @param $title
     * @param $notice
     * @param $license
     * @param $authorities
     * @param $rightsholders
     * @param $location
     */
    public function saveContent($title, $notice, $license, $authorities, $rightsholders, $location)
    {
        Content::updateOrCreate(
            ['title' => $title],
            [
                'notice' => $notice,
                'license' => $license,
                'authorities' => $authorities,
                'rightsholders' => $rightsholders,
                'location' => $location
            ]
        );
    }

    /**
     * Save schoolholidays to database
     *
     * @param $schoolyear
     * @param $type
     * @param $compulsory_dates
     *
     * @return mixed
     */
    public function saveSchoolHoliday($schoolyear, $type, $compulsory_dates)
    {
        $school_holiday = SchoolHoliday::updateOrCreate(
            [
                'schoolyear' => $schoolyear,
                'type' => $type
            ],
            ['compulsory_dates' => $compulsory_dates ]
        );

        return $school_holiday;
    }

    /**
     * Save regions to database
     *
     * @param $region
     * @param $school_holiday_id
     * @param $start_date
     * @param $end_date
     */
    public function saveRegion($region, $school_holiday_id, $start_date, $end_date)
    {
        Region::updateOrCreate(
            [
                'region' => $region,
                'school_holiday_id' => $school_holiday_id
            ],
            [
                'start_date' => $start_date,
                'end_date' => $end_date
            ]
        );
    }

    /**
     * Convert string to tiny int
     *
     * @param $boolean
     * @return int
     */
    public function convertToTinyInt($boolean)
    {
        if ($boolean === 'true') {
            return 1;
        } else {
            return 0;
        }
    }
}
