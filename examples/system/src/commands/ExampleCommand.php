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
 * Class ExampleCommand
 * @package app
 * @subpackage examples
 */
class ExampleCommand extends AbstractConsoleCommand
{
    // TODO

    public const NAME = 'example';

    public const CATEGORY = 'examples';

    public const DESCRIPTION = 'Example console command.';

    public function onCommand(ConsoleEventInterface $event)
    {
        $cli = $event->getConsole();

//        if ($command['v']) {
//            // TODO
//            echo 'Verbose output...';
//        }

        $cli->out('Console example');
    }
}
