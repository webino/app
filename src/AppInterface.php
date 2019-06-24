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
 * Interface AppInterface
 * @package app
 */
interface AppInterface extends AbstractAppInterface
{
    /**
     * Request responding
     *
     * @return void
     */
    public function dispatch(): void;
}
