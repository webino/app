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

    public function onCommand(ConsoleEventInterface $event);
}
