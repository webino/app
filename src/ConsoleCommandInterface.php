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
