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
 * Class App
 * @package app
 */
final class App extends AbstractApp implements AppDispatchInterface
{
    /**
     * Request responding
     *
     * @param RequestInterface|null $request
     * @return void
     */
    public function dispatch(RequestInterface $request = null): void
    {
        /** @var DispatchEvent $event */
        $event = $this->make(DispatchEvent::class, $this, $request);
        $this->emit($event);
    }
}
