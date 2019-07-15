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
 * Interface AppAwareInterface
 * @package app
 */
interface AppAwareInterface
{
    /**
     * Returns application.
     *
     * @return AppInterface
     * @throws NotAppException
     */
    public function getApp(): AppInterface;
}
