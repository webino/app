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
 * Class ConsoleBootstrap
 * @package app
 */
class ConsoleBootstrap implements ConsoleBootstrapInterface
{
    /**
     * @param ConsoleEventInterface $event
     * @return string
     */
    public function __invoke(ConsoleEventInterface $event): string
    {
        $app = $event->getApp();

        // default command
        /** @var AbstractConsoleCommand $command */
        $command = $app->make(DefaultCommand::class);
        return (string)$command->onCommand($event);
    }
}
