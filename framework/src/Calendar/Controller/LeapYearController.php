<?php

namespace App\Calendar\Controller;

use App\Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\Request;

class LeapYearController
{
    /**
     * @param Request $request
     * @param $year
     * @return string
     */
    public function index(Request $request, $year): string
    {
        $leapYear = new LeapYear();

        if ($leapYear->isLeapYear($year)) {
            return 'Yep, this is a leap year!' . '</br>' . rand();
        } else {
            return 'Nope, this is not a leap year.' . '</br>' . rand();
        }
    }
}
