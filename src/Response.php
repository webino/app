<?php

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
