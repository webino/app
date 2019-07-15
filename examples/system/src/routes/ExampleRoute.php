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
