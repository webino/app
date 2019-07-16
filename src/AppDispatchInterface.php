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
 * Interface AppDispatchInterface
 * @package app
 */
interface AppDispatchInterface extends AppInterface
{
    /**
     * Request responding
     *
     * @param RequestInterface|null $request
     * @return void
     */
    public function dispatch(RequestInterface $request = null): void;
}
