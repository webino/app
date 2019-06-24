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
 * Class HttpEvent
 * @package app
 */
class HttpEvent extends DispatchEvent implements HttpEventInterface
{
    /**
     * @param CreateInstanceEventInterface $event
     * @return HttpEvent
     */
    public static function create(CreateInstanceEventInterface $event): HttpEvent
    {
        return new self(...$event->getParameters());
    }

    /**
     * Returns HTTP request.
     *
     * @return HttpRequestInterface
     * @throws NotConsoleRequestException
     */
    public function getHttpRequest(): HttpRequestInterface
    {
        $request = parent::getRequest();
        if ($request instanceof HttpRequestInterface) {
            return $request;
        }

        throw new NotConsoleRequestException;
    }
}
