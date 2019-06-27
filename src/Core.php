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
 * Class Core
 * @package app
 */
final class Core extends AbstractApp implements CoreInterface
{
    /**
     * Set bootstrap event handler.
     *
     * @param callable|null $callback Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function onBootstrap($callback = null, int $priority = 0)
    {
        $this->on(BootstrapEvent::class, $callback, $priority);
    }

    /**
     * Application bootstrapping
     *
     * @param BootstrapEventInterface|null $bootstrapEvent
     * @return AppInterface
     */
    public function bootstrap(BootstrapEventInterface $bootstrapEvent = null): AppInterface
    {
        /** @var AppInterface $app */
        $app = $this->make(AppInterface::class);
        $app->setEventDispatcher($this->getEventDispatcher());
        $app->emit($event ?? $app->make(BootstrapEventInterface::class, $this));
        return $app;
    }
}
