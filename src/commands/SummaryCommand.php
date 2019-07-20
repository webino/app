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

use League\CLImate\Argument\Argument;

/**
 * Class SummaryCommand
 * @package app
 */
class SummaryCommand extends AbstractConsoleCommand
{
    /**
     * @param ConsoleEventInterface $event
     * @return string|void
     * @throws \Exception
     */
    public function onCommand(ConsoleEventInterface $event)
    {
        $cli = $event->getConsole();
        $app = $event->getApp();

        /** @var ConsoleSpec $spec */
        $spec = $app->get(ConsoleSpec::class);

        $cli->br()->boldUnderline('<yellow>Webino Console</yellow>')->br();

        foreach ($spec->getOptions() as $arg) {
            $cli->addOption($arg);
        }

        $usageArgs = [];
        /** @var Argument $arg */
        foreach ($cli->getOptions() as $arg) {
            $usageArgs[] = '[-' . $arg->prefix() . '|--' . $arg->longPrefix() . ']';
        }
        $usageArgs = join(' ', $usageArgs);

        $cli->out('<yellow>Usage:</yellow> php index.php ' . $usageArgs . ' <command> [<options>]')->br();
        $cli->out('<yellow>Available commands:</yellow>');
        $padding = $cli->padding(16)->char(' ');

        foreach ($spec as $group => $subSpec) {
            $groupAdded = false;
            foreach ($subSpec as $label => $description) {
                if ($description) {
                    if (!$groupAdded) {
                        $cli->underline($group);
                        $groupAdded = true;
                    }
                    $cli->inline('   ');
                    $padding->label('<green>' . $label . '</green>')->result($description);
                }
            }
        }

        $cli->br();
    }
}
