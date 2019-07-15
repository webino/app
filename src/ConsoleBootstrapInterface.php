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
 * Interface ConsoleBootstrapInterface
 * @package app
 */
interface ConsoleBootstrapInterface
{
    /**
     * @param ConsoleEventInterface $event
     * @return string
     */
    public function __invoke(ConsoleEventInterface $event): string;
}
