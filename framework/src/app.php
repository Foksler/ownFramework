<?php

use App\Calendar\Controller\LeapYearController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('bye', new Route('/bye', [
    '_controller' => 'render_template',
]));

$routes->add('leap_year', new Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => 'App\Calendar\Controller\LeapYearController::index',
]));

return $routes;
