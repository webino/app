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
 * Trait CoreAwareTrait
 * @package app
 */
trait CoreAwareTrait
{
    /**
     * Returns core.
     *
     * @return CoreInterface
     * @throws NotAppException
     */
    public function getCore(): CoreInterface
    {
        $target = $this->getTarget();
        if ($target instanceof CoreInterface) {
            return $target;
        }

        throw new NotCoreException;
    }
}
