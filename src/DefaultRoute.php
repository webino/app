<?php

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
