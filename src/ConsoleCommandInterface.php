<?php

namespace Webino;

/**
 * Interface ConsoleCommandInterface
 * @package app
 */
interface ConsoleCommandInterface
{
    public const NAME = '';

    public const DESCRIPTION = '';

    public const CATEGORY = '';

    /**
     * @param ConsoleEventInterface $event
     * @return mixed
     */
    public function onCommand(ConsoleEventInterface $event);
}
