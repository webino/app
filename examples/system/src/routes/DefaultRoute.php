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
 * @sub-package examples
 */
class DefaultRoute extends HomeRoute
{
    public const TITLE = '404 Not Found';

    public const TEMPLATE = 'system/src/html/content/404.html';
}
