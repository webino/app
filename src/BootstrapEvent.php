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
 * Class BootstrapEvent
 * @package app
 */
class BootstrapEvent extends Event implements
    BootstrapEventInterface,
    InstanceFactoryMethodInterface,
    CoreAwareInterface
{
    use CoreAwareTrait;

    /**
     * @param CreateInstanceEventInterface $event
     * @return BootstrapEvent
     */
    public static function create(CreateInstanceEventInterface $event): BootstrapEvent
    {
        $params = $event->getParameters();
        $bootstrapEvent = new static(null, $params[0] ?? null);
        $core = $bootstrapEvent->getCore();
        $bootstrapEvent->setup($core);
        return $bootstrapEvent;
    }

    /**
     * @param CoreInterface $core
     */
    protected function setup(CoreInterface $core)
    {
        $core->onHttp($core->get(HttpRouter::class));
    }
}
