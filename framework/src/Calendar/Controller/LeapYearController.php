<?php

namespace App\Calendar\Controller;

use App\Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    /**
     * @param Request $request
     * @param $year
     * @return Response
     */
    public function index(Request $request, $year): Response
    {
        $response = new Response();
        $leapYear = new LeapYear();
        if ($leapYear->isLeapYear($year)) {
            $response->setContent('Yep, this is a leap year!' . rand());
        } else {
            $response->setContent('Nope, this is not a leap year.' . rand());
        }

        $response->setTtl(10);

        return $response;
    }

}
