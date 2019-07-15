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

use ArrayObject;

/**
 * Class ConsoleSpec
 * @package app
 */
class ConsoleSpec extends ArrayObject implements InstanceFactoryMethodInterface
{
    /**
     * @var array
     */
    private $arguments = [];

    /**
     * @var array
     */
    private $commandMap = [];

    /**
     * @param CreateInstanceEventInterface $event
     * @return ConsoleSpec
     */
    public static function create(CreateInstanceEventInterface $event): ConsoleSpec
    {
        $container = $event->getContainer();
        /** @var ConsoleCommandMap $commandMap */
        $commands = iterator_to_array($container->get(ConsoleCommandMap::class));

        $map = [];
        $spec = [];
        $opts = [];

        foreach ($commands as $commandClass => $command) {
            list($commandNames, $commandCategory, $commandDescription) = $command;
            isset($spec[$commandCategory]) or $spec[$commandCategory] = [];

            foreach ($commandNames as $commandName) {
                if ($commandName) {
                    $map[$commandName] = $commandClass;

                    if (isset($commandName[1]) && '-' == $commandName[1]) {
                        $opt = $opts[$commandClass] ?? new ConsoleOption($commandClass);
                        $opt->setLongPrefix(substr($commandName, 2));
                        $opt->setNoValue();
                        $opts[$commandClass] = $opt;

                    } elseif ('-' == $commandName[0]) {
                        $opt = $opts[$commandClass] ?? new ConsoleOption($commandClass);
                        $opt->setPrefix(substr($commandName, 1));
                        $opt->setNoValue();
                        $opts[$commandClass] = $opt;

                    } else {
                        $spec[$commandCategory][$commandName] = $commandDescription;
                    }
                }
            }
        }

        return new static($spec, $opts, $map);
    }

    /**
     * @param array $data
     * @param array $arguments
     * @param array $commandMap
     */
    public function __construct(array $data, array $arguments, array $commandMap)
    {
        parent::__construct($data);
        $this->arguments = $arguments;
        $this->commandMap = $commandMap;
    }

    /**
     * Returns console arguments.
     *
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * Returns console command class.
     *
     * @param string $commandName
     * @return string
     */
    public function getCommandClass(string $commandName): string
    {
        if ($commandName) {
            $commandClass = $this->commandMap[$commandName] ?? '';
            return $commandClass;
        }
        return '';
    }
}
