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
 * Interface DispatchEventInterface
 * @package app
 */
interface DispatchEventInterface extends EventInterface
{
    /**
     * Returns PHP environment execution request.
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface;

    /**
     * Returns PHP environment execution response.
     *
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface;

    /**
     * Set PHP environment execution response.
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response): void;

    /**
     * Returns application.
     *
     * @return AppInterface
     */
    public function getApp(): AppInterface;
}
