<?php

namespace Webino;

/**
 * Class ExampleCommand
 * @package app
 * @subpackage examples
 */
class ExampleCommand extends AbstractConsoleCommand
{
    // TODO

    const COMMAND = 'example:command -v|--verbose';

    public const NAME = 'example';

    public const DESCRIPTION = 'Example console command.';

    public const CATEGORY = 'examples';

    public function onCommand(ConsoleEventInterface $event)
    {
//        if ($command['v']) {
//            // TODO
//            echo 'Verbose output...';
//        }

        return 'Console example';
    }
}
