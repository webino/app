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
 * Class RouteComponent
 * @package app
 */
class RouteComponent extends AbstractViewComponent
{
    public const NAME = 'route';

    /**
     * @param ViewRenderEventInterface $event
     */
    public function onRender(ViewRenderEventInterface $event)
    {
        $app = $event->getApp();
        $node = $event->getNode();

        $routeClassName = $node->getAttribute('name');
        if (empty($routeClassName)) {
            $node->parentNode->removeChild($node);
            return;
        }

        $newNode = $node->ownerDocument->createElement('a');
        $newNode->nodeValue = $node->nodeValue;

        $routeClass = '\\' == $routeClassName[0] ? $routeClassName : __NAMESPACE__ . '\\' . $routeClassName;
        $route = $app->make($routeClass, $event);

        $href = $route->getUrl();
        $newNode->setAttribute('href', $href);

        $node->parentNode->replaceChild($newNode, $node);
    }
}
