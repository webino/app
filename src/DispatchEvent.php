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

            $nextEvent and $app->emit($nextEvent);

        }, DispatchEvent::MAIN);

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
