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
 * Class DefaultRoute
 * @package app
 */
class DefaultRoute extends AbstractRoute
{
    /**
     * @param AbstractRoute $route
     * @return string
     */
    public function onRoute(AbstractRoute $route)
    {
        // TODO page not found event
        return 'Not Found';
    }
}
