<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Simplex\ContentLengthListener;
use App\Simplex\Framework;
use App\Simplex\GoogleListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);

$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();
//$dispatcher->addListener('response', [new ContentLengthListener(), 'onResponse'], -255);
$dispatcher->addListener('response', [new GoogleListener(), 'onResponse']);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Framework($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);
var_dump($response);
$response->send();
