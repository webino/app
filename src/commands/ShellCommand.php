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

use Psy\Shell;

/**
 * Class ShellCommand
 * @package app
 */
class ShellCommand extends AbstractConsoleCommand
{
    public const NAME = 'shell';

    public const DESCRIPTION = 'Interactive shell.';

    public const CATEGORY = 'utilities';

    /**
     * @param ConsoleEventInterface $event
     * @return Shell
     */
    private function runShell(ConsoleEventInterface $event): Shell
    {
        $app = $event->getApp();
        /** @var Shell $shell */
        $shell = $app->get(Shell::class);
        $shell->setScopeVariables(['app' => $app]);
        $shell->run();
        return $shell;
    }

    /**
     * @param ConsoleEventInterface $event
     * @return string
     */
    public function onCommand(ConsoleEventInterface $event)
    {
        extract($this->runShell($event)->getScopeVariables());
        return '';
    }
}
