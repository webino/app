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
        $cli->out('Webino™ v' . Version::RELEASE);
    }
}
