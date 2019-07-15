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
 * Interface RequestAwareInterface
 * @package app
 */
interface RequestAwareInterface
{
    /**
     * Returns PHP environment execution request.
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface;
}
