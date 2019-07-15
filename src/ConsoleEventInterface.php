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
 * Interface ConsoleEventInterface
 * @package app
 */
interface ConsoleEventInterface extends DispatchEventInterface
{
    /**
     * Returns console request.
     *
     * @return ConsoleRequestInterface
     * @throws \Exception
     */
    public function getConsoleRequest(): ConsoleRequestInterface;

    /**
     * Returns console.
     *
     * @return ConsoleInterface
     */
    public function getConsole(): ConsoleInterface;

    /**
     * Returns command arguments.
     *
     * @return array
     */
    public function getArguments(): array;
}
