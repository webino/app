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
class HomeRoute extends AbstractViewRoute
{
    public const ROUTE = '/';

    public const LAYOUT = 'system/src/html/layout.html';

    public const TEMPLATE = 'system/src/html/content/home.html';
}
