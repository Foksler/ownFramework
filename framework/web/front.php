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

$compiledRoutes = (new CompiledUrlMatcherDumper($routes))->getCompiledRoutes();
$matcher = new CompiledUrlMatcher($compiledRoutes, $context);

try {
    $_route = $matcher->match($request->getPathInfo())['_route'];
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
    $response = new Response(ob_get_clean());
} catch (Routing\Exception\ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Exception $exception) {
    $response = new Response('An error occurred', 500);
}

$response->send();
