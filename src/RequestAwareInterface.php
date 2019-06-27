<?php

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
