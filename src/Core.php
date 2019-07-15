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
 * Class Core
 * @package app
 */
class Core extends AbstractCore
{
    /**
     * @param BootstrapEventInterface|null $bootstrapEvent
     * @return AppInterface
     */
    public function bootstrap(BootstrapEventInterface $bootstrapEvent = null): AppInterface
    {
        $this->onConsole($this->get(ConsoleBootstrapInterface::class));
        return parent::bootstrap($bootstrapEvent);
    }

}
