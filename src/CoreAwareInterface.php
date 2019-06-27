<?php

namespace Webino;

/**
 * Interface CoreAwareInterface
 * @package app
 */
interface CoreAwareInterface
{
    /**
     * Returns core.
     *
     * @return CoreInterface
     * @throws NotCoreException
     */
    public function getCore(): CoreInterface;
}
