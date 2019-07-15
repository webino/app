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
 * Class ExampleTestRoute
 * @package app
 * @subpackage examples
 */
class ExampleTestRoute extends ExampleRoute
{
    const ROUTE = parent::ROUTE . '/test';

    /**
     * @param AbstractRoute $route
     * @return string|void
     */
    public function onRoute(AbstractRoute $route)
    {
        return 'Example Test';
    }
}
