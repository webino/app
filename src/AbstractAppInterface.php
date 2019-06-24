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
 * Interface AbstractAppInterface
 * @package app
 */
interface AbstractAppInterface extends
    EventEmitterInterface,
    InstanceContainerInterface
{
    /**
     * Set dispatch event handler.
     *
     * @param callable|null $callback Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function onDispatch($callback = null, int $priority = 0): void;

    /**
     * Set HTTP dispatch event handler.
     *
     * @param callable|null $callback Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function onHttp($callback = null, int $priority = 0): void;

    /**
     * Set console dispatch event handler.
     *
     * @param callable|null $callback Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function onConsole($callback = null, int $priority = 0): void;
}
