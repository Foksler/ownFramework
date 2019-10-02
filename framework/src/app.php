<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
//$routes->add('hello', new Route('/hello/{name}', [
//    'name' => 'World',
//    '_controller' => 'render_template',
//]));

$routes->add('bye', new Route('/bye', [
    '_controller' => 'render_template',
]));

$routes->add('hello', new Route('/hello/{name}', [
    //'name' => 'World',
    '_controller' => function ($request) {
        return render_template($request);
    }
]));
//var_dump($request);
return $routes;
