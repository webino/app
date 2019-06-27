<?php

namespace Webino;

/**
 * Class ExampleRoute
 * @package app
 * @subpackage examples
 */
class ExampleRoute extends AbstractRoute implements RegexRouteInterface
{
    const MATCH = '~^example$~';

    public function onRoute(AbstractRoute $route)
    {
        return 'Example';
    }
}
