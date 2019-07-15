<?php

namespace Webino;

/**
 * Class VersionCommand
 * @package app
 */
class VersionCommand extends AbstractConsoleCommand
{
    public const NAME = ['-v', '--version'];

    /**
     * @param ConsoleEventInterface $event
     * @return void
     */
    public function onCommand(ConsoleEventInterface $event)
    {
        $cli = $event->getConsole();
        $cli->out('Webino™ v0.0.1');
    }
}
