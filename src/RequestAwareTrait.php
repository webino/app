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
 * Trait RequestAwareTrait
 * @package app
 */
trait RequestAwareTrait
{
    /**
     * Returns PHP environment execution request.
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this['request'];
    }

    /**
     * Set PHP environment execution request.
     *
     * @param RequestInterface $request
     */
    protected function setRequest(RequestInterface $request): void
    {
        $this['request'] = $request;
    }
}
