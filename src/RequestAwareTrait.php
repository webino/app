<?php

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
