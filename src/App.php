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
final class App extends AbstractApp implements AppInterface
{
    /**
     * Request responding
     *
     * @return void
     */
    public function dispatch(): void
    {
        $event = $this->make(DispatchEvent::class, $this);
        $this->emit($event);
    }
}
