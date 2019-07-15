<?php

namespace Webino;

/**
 * Class GenerateCommand
 * @package app
 */
class GenerateCommand extends AbstractConsoleCommand
{
    // TODO

    const COMMAND = [
        'generate',
        '[type = all : Generator type]',
    ];

    public const NAME = 'generate';

    public const DESCRIPTION = 'Generate system files.';

    public const CATEGORY = 'utilities';

    public function onCommand(ConsoleEventInterface $event)
    {
        // TODO
        /** @var RegexRouteMap $regexRouteMap */
        //$regexRouteMap = $app->get(RegexRouteMap::class);
        //$regexRouteMap->generate();

        //pd($command['type']);

        return 'Generate command';
    }
}
