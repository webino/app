<?php

namespace Webino;

/**
 * Interface ConsoleBootstrapInterface
 * @package app
 */
interface ConsoleBootstrapInterface
{
    /**
     * @param ConsoleEventInterface $event
     * @return string
     */
    public function __invoke(ConsoleEventInterface $event): string;
}
