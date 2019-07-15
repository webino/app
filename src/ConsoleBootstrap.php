<?php

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
        return $command->onCommand($event);
    }
}
