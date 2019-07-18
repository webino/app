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
 * Class HomeRoute
 * @package app
 * @subpackage examples
 */
class HomeRoute extends AbstractRoute
{
    const ROUTE = '/';

    /**
     * @param AbstractRoute $route
     * @return string|void
     */
    public function onRoute(AbstractRoute $route)
    {
        $app = $this->getApp();

        $cMap = $app->get(ComponentsMap::class);

        $components = new ViewComponents($cMap);

        /** @var DomView $view */
        $view = $app->make(DomView::class, $components);

        $view->setTitle('Hello Webino');

        $html = file_get_contents('system/src/html/layout.html');

        return new HtmlResponse($view->render($html));
    }
}
