<?php

namespace Webino;

/**
 * Class HttpRegexRouter
 * @package app
 */
class HttpRegexRouter
{
    public function __invoke(HttpEvent $event) {

        $app = $event->getApp();

        $request = $event->getHttpRequest();
        $routePath = $request->getRoutePath();

        /** @var RouteMapInterface $routeMap */
        $routeMap = $app->get(RegexRouteMapInterface::class);

        $handler = function ($result, HttpEvent $event, AbstractRoute $route) use ($app) {
            $response = $app->make(ResponseInterface::class, $result) ?? $route->getResponse();
            $event->setResponse($response);
            return $result;
        };

        foreach ($routeMap as $regex => $routeClass) {
            $matches = [];
            if (preg_match($regex, $routePath, $matches)) {
                $route = $app->make($routeClass, $event, $matches);
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
    }
}
