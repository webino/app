<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUndefinedClassInspection
 * @interpreter php-cgi
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use PHP_CodeSniffer\Generators\Text;

require __DIR__ . '/../../vendor/autoload.php';

class HttpRoute extends Event
{
    use AppAwareTrait;
    use RequestAwareTrait;
    use ResponseAwareTrait;

    public static function create(CreateInstanceEventInterface $event)
    {
        $route = static::createRoute($event);
        $app = $route->getApp();
        $app->on(static::class, [$route, 'onRoute']);
        return $route;
    }

    public static function createRoute(CreateInstanceEventInterface $event): HttpRoute
    {
        $params = $event->getParameters();
        return new static($params[0] ?? null);
    }

    public function onRoute(HttpRoute $route)
    {

    }
}

class DefaultRoute extends HttpRoute implements InstanceFactoryMethodInterface
{
    public function onRoute(HttpRoute $route)
    {
//        $route->setResponse(new TextResponse('Hello'));

        return 'Pokus';

//        return ['x' => 'y'];
    }
}

class HomeRoute extends HttpRoute
{
    const PATTERN = '~^$~';
}


class ExampleRoute extends HttpRoute
{
    const PATTERN = '~^example$~';
}

$core = new Core;
$app = $core->bootstrap();


$app->onHttp(function (HttpEvent $event) {

    $app = $event->getApp();

    $request = $event->getHttpRequest();
    $routePath = $request->getRoutePath();

    $routeMap = [
        HomeRoute::PATTERN => HomeRoute::class,
        ExampleRoute::PATTERN => ExampleRoute::class,
    ];

    $handler = function ($result, HttpEvent $event, HttpRoute $route) {
        switch (true) {

            case is_array($result):
                $event->setResponse(new JsonResponse($result));
                break;

            case is_string($result):
                $event->setResponse(new TextResponse($result));
                break;

            case $result instanceof ResponseInterface:
                $event->setResponse($result);
                break;

            default:
                $event->setResponse($route->getResponse());
        }

        return $result;
    };

    foreach ($routeMap as $regex => $route) {
        $matches = [];
        if (preg_match($regex, $routePath, $matches)) {
            $route = $app->make($route, $event, $matches);
            $app->emit($route, function ($result) use ($event, $route, $handler) {
                return $handler($result, $event, $route);
            });
            return;
        }
    }

    $route = $app->make(DefaultRoute::class, $event);
    $app->emit($route, function ($result) use ($event, $route, $handler) {
        return $handler($result, $event, $route);
    });
});

$app->onConsole(function (ConsoleEvent $event) {

    return 'Hello Console!';

});


$app->on(DefaultRoute::class, function (DefaultRoute $route) {
//    die('KO');
});

$app->on(HomeRoute::class, function (HomeRoute $route) {
    return 'HOME';
});

$app->on(ExampleRoute::class, function (ExampleRoute $route) {
    return 'Example';
});

$app->dispatch();
