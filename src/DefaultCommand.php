<?php

namespace Webino;

/**
 * Class DefaultCommand
 * @package app
 */
class DefaultCommand extends AbstractConsoleCommand
{
    /**
     * @param ConsoleEventInterface $event
     * @return string|void
     * @throws \Exception
     */
    public function onCommand(ConsoleEventInterface $event)
    {
        $app = $event->getApp();
        $cli = $event->getConsole();

        /** @var ConsoleSpec $spec */
        $spec = $app->get(ConsoleSpec::class);

        // command dispatch
        $request = $event->getConsoleRequest();
        if ($commandClass = $spec->getCommandClass($request->getCommand())) {
            $app = $event->getApp();
            /** @var AbstractConsoleCommand $command */
            $command = $app->make($commandClass);
            return (string)$command->onCommand($event);
        }

        /** @var SummaryCommand $command */
        $summary = $app->make(SummaryCommand::class);
        return (string)$summary->onCommand($event);
    }
}
