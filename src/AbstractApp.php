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
 * Class AbstractApp
 * @package app
 */
abstract class AbstractApp implements AbstractAppInterface
{
    use EventEmitterTrait;
    use InstanceContainerTrait;

    public function __construct()
    {
        $this->setupInstanceContainer();
    }

    /**
     * Set dispatch event handler.
     *
     * @param callable|null $callback Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function onDispatch($callback = null, int $priority = 0): void
    {
        $this->on(DispatchEvent::class, $callback, $priority);
    }

    /**
     * Set HTTP dispatch event handler.
     *
     * @param callable|null $callback Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function onHttp($callback = null, int $priority = 0): void
    {
        $this->on(HttpEvent::class, $callback, $priority);
    }

    /**
     * Set console dispatch event handler.
     *
     * @param callable|null $callback Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function onConsole($callback = null, int $priority = 0): void
    {
        $this->on(ConsoleEvent::class, $callback, $priority);
    }
}
