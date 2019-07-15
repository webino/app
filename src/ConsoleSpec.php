<?php

namespace Webino;

/**
 * Class ConsoleSpec
 * @package app
 */
class ConsoleSpec extends \ArrayObject implements InstanceFactoryMethodInterface
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

        // TODO
        $commands[] = GenerateCommand::class;
        $commands[] = ShellCommand::class;
        $commands[] = HelpCommand::class;

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
