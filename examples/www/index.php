<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUndefinedClassInspection
 * @interpreter php-cgi
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use League\CLImate\Argument\Argument;

require __DIR__ . '/../../vendor/autoload.php';
chdir(__DIR__ . '/..');


class ConsoleSpec implements InstanceFactoryMethodInterface
{
    public static function create(CreateInstanceEventInterface $event)
    {
        // TODO: Implement create() method.
    }
}

abstract class AbstractConsoleCommand
{
    public const NAME = '';

    public const DESCRIPTION = '';

    public const CATEGORY = '';

    abstract public function onCommand(ConsoleEvent $event);
}

class DefaultCommand extends AbstractConsoleCommand
{
    /**
     * @param ConsoleEvent $event
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function onCommand(ConsoleEvent $event)
    {
        $cli = $event->getConsole();
        $cli->br()->boldUnderline('<yellow>Webino Console</yellow>')->br();

        $arg = new ConsoleOption('version');
        $arg->setPrefix('v');
        $arg->setLongPrefix('version');
        $arg->setDescription('Display version info.');
        $arg->setNoValue();

        $cli->arguments->add($arg->toArray());


        $arg = new ConsoleOption('help');
        $arg->setPrefix('h');
        $arg->setLongPrefix('help');
        $arg->setDescription('Display help.');
        $arg->setNoValue();

        $cli->arguments->add($arg->toArray());

        $usageArgs = [];
        /** @var \League\CLImate\Argument\Argument $arg */
        foreach ($cli->arguments->all() as $arg) {
            $usageArgs[] = '[-' . $arg->prefix() . '|--' . $arg->longPrefix() . ']';
        }
        $usageArgs = join(' ', $usageArgs);

        $cli->out('<yellow>Usage:</yellow> php index.php ' . $usageArgs . ' <command> [<options>]')->br();

        $cli->out('<yellow>Available commands:</yellow>');

        $padding = $cli->padding(16)->char(' ');

        /** @var ConsoleSpec $spec */
        $spec = $app->get(ConsoleSpec::class);

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

class HelpCommand extends AbstractConsoleCommand
{
    public const NAME = ['-h', '--help'];

    public const DESCRIPTION = 'Display help.';

    public const CATEGORY = 'utilities';

    public function onCommand(ConsoleEvent $event)
    {
        return 'Help command';
    }
}

class GenerateCommand extends AbstractConsoleCommand
{
    const COMMAND = [
        'generate',
        '[type = all : Generator type]',
    ];

    public const NAME = 'generate';

    public const DESCRIPTION = 'Generate system files.';

    public const CATEGORY = 'utilities';

    public function onCommand(ConsoleEvent $event)
    {
        //pd($command['type']);

        return 'Generate command';
    }
}

class ExampleCommand extends AbstractConsoleCommand
{
    const COMMAND = 'example:command -v|--verbose';

    public const NAME = 'example';

    public const DESCRIPTION = 'Example console command.';

    public const CATEGORY = 'examples';

    public function onCommand(ConsoleEvent $event)
    {
//        if ($command['v']) {
//            // TODO
//            echo 'Verbose output...';
//        }

        return 'Console example';
    }
}

class ConsoleCommand extends AbstractConsoleCommand
{
    public const NAME = 'console';

    public const DESCRIPTION = 'Interactive console.';

    public const CATEGORY = 'utilities';

    private function runShell(ConsoleEvent $event): \Psy\Shell
    {
        $app = $event->getApp();
        /** @var \Psy\Shell $shell */
        $shell = $app->get(\Psy\Shell::class);
        $shell->setScopeVariables(['app' => $app]);
        $shell->run();
        return $shell;
    }

    public function onCommand(ConsoleEvent $event)
    {
        extract($this->runShell($event)->getScopeVariables());
        return '';
    }
}


$core = new Core;

$app = $core->bootstrap();

$app->onConsole(function (ConsoleEvent $event) {

    $app = $event->getApp();



    $cli = $event->getConsole();

    // TODO
    $argv = [];

    $commands = [
        ExampleCommand::class,
        GenerateCommand::class,
        ConsoleCommand::class,
        HelpCommand::class,
        HelpCommand::class,
    ];

    $commandMap = [];
    $spec = [];
    foreach ($commands as $commandClass) {
        $commandNames = (array)constant("$commandClass::NAME");
        $commandCategory = constant("$commandClass::CATEGORY") ?? 'default';
        $commandDescription = constant("$commandClass::DESCRIPTION");

        isset($spec[$commandCategory]) or $spec[$commandCategory] = [];

        foreach ($commandNames as $commandName) {
            $commandMap[$commandName] = $commandClass;

            '-' == $commandName[0]
            or $spec[$commandCategory][$commandName] = $commandDescription;
        }
    }

    $commandName = $_SERVER['argv'][1] ?? null;
    if ($commandName) {
        $commandClass = $commandMap[$commandName] ?? null;
        if ($commandClass) {

            /** @var AbstractConsoleCommand $command */
            $command = $app->make($commandClass);

            return $command->onCommand($event);
        }
    }

    // HELP
    // TODO
    // TODO display help;
//    return 'Help...';

    // TODO invalid command error
    //return 'Invalid command';

    // default command
    /** @var AbstractConsoleCommand $command */
    $command = $app->make(DefaultCommand::class);
    return $command->onCommand($event);






    // TODO
    /** @var RegexRouteMap $regexRouteMap */
    //$regexRouteMap = $app->get(RegexRouteMap::class);
    //$regexRouteMap->generate();
});

$app->dispatch();
