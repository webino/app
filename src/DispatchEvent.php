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
 * Class DispatchEvent
 * @package app
 */
class DispatchEvent extends Event implements
    DispatchEventInterface,
    InstanceFactoryMethodInterface
{
    /**
     * @param CreateInstanceEventInterface $event
     * @return DispatchEvent
     * @throws NotAppException
     */
    public static function create(CreateInstanceEventInterface $event): DispatchEvent
    {
        $container = $event->getContainer();
        $params = $event->getParameters();
        $request = $container->get(RequestInterface::class);
        $dispatchEvent = new self(null, $params[0] ?? null);
        $dispatchEvent->setRequest($request);

        $app = $dispatchEvent->getApp();

        $app->onDispatch(function (DispatchEvent $event) {

            $request = $event->getRequest();
            $app = $event->getApp();
            $nextEvent = null;

            if ($request instanceof HttpRequestInterface) {
                /** @var HttpEventInterface $nextEvent */
                $nextEvent = $app->make(HttpEventInterface::class, $event);

            } elseif ($request instanceof ConsoleRequestInterface) {
                /** @var ConsoleEventInterface $nextEvent */
                $nextEvent = $app->make(ConsoleEventInterface::class, $event);
            }

            $nextEvent and $app->emit($nextEvent, function ($result) use ($event, $nextEvent) {

                switch (true) {

                    case $nextEvent instanceof ConsoleEventInterface:
                        is_string($result) and $event->setResponse(new ConsoleResponse($result));
                        break;

                    case is_array($result):
                        $event->setResponse(new JsonResponse($result));
                        break;

                    case is_string($result):
                        $event->setResponse(new TextResponse($result));
                        break;

                    case $result instanceof ResponseInterface:
                        $event->setResponse($result);
                        break;

                    default:
                        $event->setResponse($nextEvent->getResponse());
                }
            });

        }, DispatchEvent::MAIN);

        // responding
        $app->onDispatch(function (DispatchEvent $event) {
            $event->getResponse()->send();
        }, DispatchEvent::FINISH);

        return $dispatchEvent;
    }

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

    /**
     * Returns application.
     *
     * @return AppInterface
     * @throws NotAppException
     */
    public function getApp(): AppInterface
    {
        $target = $this->getTarget();
        if ($target instanceof AppInterface) {
            return $target;
        }

        throw new NotAppException;
    }
}
