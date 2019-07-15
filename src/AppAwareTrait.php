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
 * Trait AppAwareTrait
 * @package app
 */
trait AppAwareTrait
{
    /**
     * Returns application.
     *
     * @return AppInterface
     * @throws NotAppException
     */
    public function getApp(): AppInterface
    {
        $target = $this->getTarget();
        if ($target instanceof AppInterface) {
            return $target;
        }

        throw new NotAppException;
    }
}
