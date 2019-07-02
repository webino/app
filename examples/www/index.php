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


abstract class AbstractConsoleCommand
{
    abstract public function onCommand(ConsoleEvent $event);
}

class GenerateCommand extends AbstractConsoleCommand
{
    const COMMAND = [
        'generate',
        '[type = all : Generator type]',
    ];

    public function onCommand(ConsoleEvent $event)
    {
        //pd($command['type']);

        return 'Generate command';
    }
}

class ExampleCommand extends AbstractConsoleCommand
{
    const COMMAND = 'example:command -v|--verbose';

    public function onCommand(ConsoleEvent $event)
    {
//        if ($command['v']) {
//            // TODO
//            echo 'Verbose output...';
//        }

        return 'Console example';
    }
}


$core = new Core;

$app = $core->bootstrap();

$app->onConsole(function (ConsoleEvent $event) {

    $app = $event->getApp();



    //$cli = $event->getConsole();

    $cli = new \League\CLImate\CLImate;

    // TODO
    $argv = [];


    $commandMap = [
        'example' => ExampleCommand::class,
        'generate' => GenerateCommand::class,
    ];

    $commandName = $_SERVER['argv'][1] ?? null;
    if (!$commandName) {
        // TODO display help;
        return 'Help...';
    }

    $commandClass = $commandMap[$commandName];
    if (!$commandClass) {
        // TODO invalid command error
        return 'Invalid command';
    }


    /** @var AbstractConsoleCommand $command */
    $command = $app->make($commandClass);

    /*
    $cli->description('Bla bla my cli...');

    $arg = new Argument('pokus');
//    $arg->setPrefix('t');
//    $arg->setLongPrefix('pokus');
    $arg->setDescription('Test operand...');
    $arg->setRequired();
//    $arg->setNoValue();

    $cli->arguments->add($arg);

    $arg = new Argument('test');
    $arg->setPrefix('t');
    $arg->setLongPrefix('test');
    $arg->setDescription('Test argument...');
    $arg->setRequired();
//    $arg->setNoValue();

    $cli->arguments->add($arg);

    $arg = new Argument('test2');
    $arg->setPrefix('t2');
    $arg->setLongPrefix('test2');
    $arg->setDescription('Test argument2...');
    $arg->setNoValue();

    $cli->arguments->add($arg);
    */


    $cli->br()->bold('Webino Console')->br();

    // commands
//    $arg = new Argument('generate');
//    $arg->setDescription('Generate system files.');
//    $cli->arguments->add($arg);


    $spec = [
        'utilities' => [
            'generate' => 'Generate system files.',
            'example' => 'Example console command.',
        ],
        'users' => [
            'user-add' => 'Add new user.',
            'user-list' => 'List existing users.',
        ],
    ];

    $arg = new Argument('version');
    $arg->setPrefix('v');
    $arg->setLongPrefix('version');
    $arg->setDescription('Display version info.');
    $arg->setNoValue();

    $cli->arguments->add($arg);


    $arg = new Argument('help');
    $arg->setPrefix('h');
    $arg->setLongPrefix('help');
    $arg->setDescription('Display help.');
    $arg->setNoValue();

    $cli->arguments->add($arg);

    $usageArgs = [];
    /** @var \League\CLImate\Argument\Argument $arg */
    foreach ($cli->arguments->all() as $arg) {
        $usageArgs[] = '[-' . $arg->prefix() . '|--' . $arg->longPrefix() . ']';
    }
    $usageArgs = join(' ', $usageArgs);

    $cli->out('Usage: ' . $usageArgs . ' <command> [<args>]')->br();

    $cli->out('Commands:');

    $padding = $cli->padding(16)->char(' ');

    foreach ($spec as $group => $subSpec) {

        $cli->underline($group);

        foreach ($subSpec as $label => $description) {
            $cli->inline('   ');
            $padding->label($label)->result($description);
        }
    }

    $cli->br();


    return '';
    //return $command->onCommand($event);






    // TODO
    /** @var RegexRouteMap $regexRouteMap */
    //$regexRouteMap = $app->get(RegexRouteMap::class);
    //$regexRouteMap->generate();
});

$app->dispatch();
