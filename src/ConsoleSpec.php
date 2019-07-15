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

        $commandMap = [];
        $spec = [];
        foreach ($commands as $commandClass) {
            $commandNames = (array)constant("$commandClass::NAME");
            $commandCategory = constant("$commandClass::CATEGORY") ?: 'default';
            $commandDescription = constant("$commandClass::DESCRIPTION");

            isset($spec[$commandCategory]) or $spec[$commandCategory] = [];

            foreach ($commandNames as $commandName) {
                $commandMap[$commandName] = $commandClass;

                '-' == $commandName[0]
                or $spec[$commandCategory][$commandName] = $commandDescription;
            }
        }

        return new static($spec, $commandMap);
    }

    /**
     * @param array $data
     * @param array $commandMap
     */
    public function __construct(array $data, array $commandMap)
    {
        parent::__construct($data);
        $this->commandMap = $commandMap;
    }

    /**
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
