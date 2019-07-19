<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

/**
 * Class AbstractRoute
 * @package app
 */
abstract class AbstractRoute extends Event implements
    InstanceFactoryMethodInterface,
    RouteInterface,
    AppAwareInterface,
    RequestAwareInterface,
    HttpRequestAwareInterface,
    ResponseAwareInterface
{
    use AppAwareEventTrait;
    use RequestAwareEventTrait;
    use HttpRequestAwareEventTrait;
    use ResponseAwareEventTrait;

    /**
     * Route factory method.
     *
     * @param CreateInstanceEventInterface $event
     * @return AbstractRoute
     */
    public static function create(CreateInstanceEventInterface $event): AbstractRoute
    {
        $route = static::createRoute($event);
        $app = $route->getApp();
        $app->on(static::class, [$route, 'onRoute']);
        return $route;
    }

    /**
     * Creates new route.
     *
     * @param CreateInstanceEventInterface $event
     * @return AbstractRoute
     */
    public static function createRoute(CreateInstanceEventInterface $event): AbstractRoute
    {
        $params = $event->getParameters();
        return new static($params[0] ?? $event);
    }

    /**
     * Returns route URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        $request = $this->getHttpRequest();
        $url = ($request ? $request->getBasePath() . '/' : '') . $this::ROUTE;
        return '/' . trim($url, '/');
    }

    /**
     * Route handler.
     *
     * @param AbstractRoute $route
     */
    public function onRoute(AbstractRoute $route)
    {
    }
}
