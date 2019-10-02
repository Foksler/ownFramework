<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Matcher\CompiledUrlMatcher;
use Symfony\Component\Routing\Matcher\Dumper\CompiledUrlMatcherDumper;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);

//$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$compiledRoutes = (new CompiledUrlMatcherDumper($routes))->getCompiledRoutes();
$matcher = new CompiledUrlMatcher($compiledRoutes, $context);

function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
}

try {
    var_dump($request->attributes->all());
//    $_route = $matcher->match($request->getPathInfo())['_route'];
//    var_dump($_route);die;
//    ob_start();
//    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
//    $response = new Response(ob_get_clean());
    $request->attributes->add($matcher->match($request->getPathInfo()));
    var_dump($request->attributes->all());

    $response = call_user_func($request->attributes->get('_controller'), $request);
//    var_dump($request);
} catch (Routing\Exception\ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Exception $exception) {
    $response = new Response('An error occurred', 500);
}

$response->send();
