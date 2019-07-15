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
 * Class ConsoleEvent
 * @package app
 */
class ConsoleEvent extends DispatchEvent implements ConsoleEventInterface
{
    /**
     * @param CreateInstanceEventInterface $event
     * @return ConsoleEvent
     */
    public static function create(CreateInstanceEventInterface $event): ConsoleEvent
    {
        return new self(...$event->getParameters());
    }

    /**
     * Returns console request.
     *
     * @return ConsoleRequestInterface
     * @throws NotConsoleRequestException
     */
    public function getConsoleRequest(): ConsoleRequestInterface
    {
        $request = parent::getRequest();
        if ($request instanceof ConsoleRequestInterface) {
            return $request;
        }

        throw new NotConsoleRequestException;
    }

    /**
     * @return ConsoleInterface
     */
    public function getConsole(): ConsoleInterface
    {
        return $this->getApp()->get(Console::class);
    }
}
