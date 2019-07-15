<?php

namespace Webino;

/**
 * Class HelpCommand
 * @package app
 */
class HelpCommand extends AbstractConsoleCommand
{
    // TODO

    public const NAME = ['-h', '--help'];

    public const DESCRIPTION = 'Display help.';

    public const CATEGORY = 'utilities';

    public function onCommand(ConsoleEventInterface $event)
    {
        return 'Help command';
    }
}
