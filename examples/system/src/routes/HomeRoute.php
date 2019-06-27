<?php

namespace Webino;

/**
 * Class HomeRoute
 * @package app
 * @subpackage examples
 */
class HomeRoute extends AbstractRoute implements RegexRouteInterface
{
    const MATCH = '~^$~';

    public function onRoute(AbstractRoute $route)
    {
        return 'Home';
    }
}
