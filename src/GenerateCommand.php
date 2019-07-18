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
 * Class GenerateCommand
 * @package app
 */
class GenerateCommand extends AbstractConsoleCommand
{
    use EachFileClassImplementsTrait;

    public const NAME = 'generate';

    public const CATEGORY = 'utilities';

    public const DESCRIPTION = 'Generate system files.';

    /**
     * Returns directories path to scan.
     *
     * @return array
     */
    public function getDirs(): array
    {
        return [
            'system/src',
            __DIR__ . '/../src',
            __DIR__ . '/../vendor',
            __DIR__ . '/../../../../../vendor',
        ];
    }

    /**
     * @param ConsoleEventInterface $event
     * @return mixed|void
     */
    public function onCommand(ConsoleEventInterface $event)
    {
        $app = $event->getApp();
        $cli = $event->getConsole();

        $cli->out('Generating:');

        foreach ($this->getDirs() as $dir) {
            $this->eachFileClassImplements(
                $dir,
                '~/(?!Abstract)[^/]+Map.php$~',
                __NAMESPACE__,
                GeneratedMapInterface::class,
                function (string $class) use ($app, $cli) {
                    $cli->out(' • ' . $class);
                    /** @var GeneratedMapInterface $regexRouteMap */
                    $generatedMap = $app->get($class);
                    $generatedMap->generate();
                }
            );
        }

        $cli->out('Done.');
    }
}
