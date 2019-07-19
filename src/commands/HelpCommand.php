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
 * Class HelpCommand
 * @package app
 */
class HelpCommand extends AbstractConsoleCommand
{
    public const NAME = ['-h', '--help'];

    /**
     * @param ConsoleEventInterface $event
     * @return string|void
     * @throws \Exception
     */
    public function onCommand(ConsoleEventInterface $event)
    {
        // TODO help command

        $app = $event->getApp();
        /** @var SummaryCommand $defaultCommand */
        $summary = $app->make(SummaryCommand::class);
        return $summary->onCommand($event);
    }
}
