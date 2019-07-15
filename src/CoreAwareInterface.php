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
 * Interface CoreAwareInterface
 * @package app
 */
interface CoreAwareInterface
{
    /**
     * Returns core.
     *
     * @return CoreInterface
     * @throws NotCoreException
     */
    public function getCore(): CoreInterface;
}
