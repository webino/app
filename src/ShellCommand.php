<?php

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
