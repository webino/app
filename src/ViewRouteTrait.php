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

        /** @var ViewRenderEventInterface $event */
        $event = $app->make(ViewRenderEventInterface::class, $route);

        // set view route
        if ($this instanceof ViewRouteInterface) {
            $event->setRoute($this);

            // route title
            $view->setTitle($this::TITLE);

            /** @var HtmlTemplatesInterface $filesystem */
            $templates = $app->get(HtmlTemplatesInterface::class);

            // layout template
            $html = $templates->read($this::LAYOUT);
            $event->setLayout($html);

            // content template
            $html = $templates->read($this::TEMPLATE);
            $event->setContent($html);
        }

        return new HtmlResponse($view->render($event));
    }
}
