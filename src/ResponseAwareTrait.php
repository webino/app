<?php

namespace Webino;

/**
 * Trait ResponseAwareTrait
 * @package app
 */
trait ResponseAwareTrait
{
    /**
     * Returns PHP environment execution response.
     *
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this['response'] ?? new TextResponse;
    }

    /**
     * Set PHP environment execution response.
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response): void
    {
        $this['response'] = $response;
    }
}
