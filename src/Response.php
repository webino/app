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
 * Class Response
 * @package app
 */
class Response implements InstanceFactoryMethodInterface
{
    /**
     * @param CreateInstanceEventInterface $event
     * @return ResponseInterface|null
     */
    public static function create(CreateInstanceEventInterface $event): ?ResponseInterface
    {
        $params = $event->getParameters();
        $result = $params[0] ?? null;

        switch (true) {
            case is_array($result):
                return new JsonResponse($result);

            case is_string($result):
                return new TextResponse($result);

            case $result instanceof ResponseInterface:
                return $result;
        }

        return null;
    }
}
