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
 * Trait ViewRouteTrait
 * @package app
 */
trait ViewRouteTrait
{
    /**
     * Returns application.
     *
     * @return AppInterface
     * @throws NotAppException
     */
    abstract public function getApp(): AppInterface;

    /**
     * @param AbstractRoute $route
     * @return string|void
     */
    public function onRoute(AbstractRoute $route)
    {
        $app = $this->getApp();

        /** @var ComponentsMap $cMap */
        $cMap = $app->get(ComponentsMap::class);
        $components = new ViewComponents($cMap);

        /** @var DomView $view */
        $view = $app->make(DomView::class, $components);

        // TODO title
        $view->setTitle('Hello Webino');

        /** @var ViewRenderEventInterface $event */
        $event = $app->make(ViewRenderEventInterface::class, $route);

        if ($this instanceof RouteInterface) {
            $event->setRoute($this);
        }

        // layout template
        if ($this instanceof ViewRouteInterface) {
            // TODO templates service
            $html = file_get_contents($this::LAYOUT);
            $event->setLayout($html);

            // TODO templates service
            $html = file_get_contents($this::TEMPLATE);
            $event->setContent($html);
        }

        return new HtmlResponse($view->render($event));
    }
}
