<?php

namespace Webino;

/**
 * Interface ResponseAwareInterface
 * @package app
 */
interface ResponseAwareInterface
{
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
}
