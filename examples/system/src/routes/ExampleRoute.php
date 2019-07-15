<?php

namespace Webino;

/**
 * Class ExampleRoute
 * @package app
 * @subpackage examples
 */
class ExampleRoute extends AbstractRoute
{
    const ROUTE = 'example';

    public function onRoute(AbstractRoute $route)
    {
        return 'Example';
    }
}
