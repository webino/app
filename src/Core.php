<?php

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
