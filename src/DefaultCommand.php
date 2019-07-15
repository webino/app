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
     * @return string
     * @throws \Exception
     */
    public function onCommand(ConsoleEventInterface $event)
    {
        $app = $event->getApp();
        $cli = $event->getConsole();

        $cli->br()->boldUnderline('<yellow>Webino Console</yellow>')->br();

        $arg = new ConsoleOption('version');
        $arg->setPrefix('v');
        $arg->setLongPrefix('version');
        $arg->setDescription('Display version info.');
        $arg->setNoValue();

        $cli->addOption($arg);


        $arg = new ConsoleOption('help');
        $arg->setPrefix('h');
        $arg->setLongPrefix('help');
        $arg->setDescription('Display help.');
        $arg->setNoValue();

        $cli->addOption($arg);

        $usageArgs = [];
        /** @var \League\CLImate\Argument\Argument $arg */
        foreach ($cli->getArguments() as $arg) {
            $usageArgs[] = '[-' . $arg->prefix() . '|--' . $arg->longPrefix() . ']';
        }
        $usageArgs = join(' ', $usageArgs);

        $cli->out('<yellow>Usage:</yellow> php index.php ' . $usageArgs . ' <command> [<options>]')->br();

        $cli->out('<yellow>Available commands:</yellow>');

        $padding = $cli->padding(16)->char(' ');

        /** @var ConsoleSpec $spec */
        $spec = $app->get(ConsoleSpec::class);

        // command dispatch
        $request = $event->getConsoleRequest();
        if ($commandClass = $spec->getCommandClass($request->getCommand())) {
            $app = $event->getApp();
            /** @var AbstractConsoleCommand $command */
            $command = $app->make($commandClass);
            return $command->onCommand($event);
        }

        // summary
        foreach ($spec as $group => $subSpec) {

            $cli->underline($group);

            foreach ($subSpec as $label => $description) {
                $cli->inline('   ');
                $padding->label('<green>' . $label . '</green>')->result($description);
            }
        }

        $cli->br();

        return '';
    }
}
