<?php

namespace Webino;

/**
 * Trait CoreAwareTrait
 * @package app
 */
trait CoreAwareTrait
{
    /**
     * Returns core.
     *
     * @return CoreInterface
     * @throws NotAppException
     */
    public function getCore(): CoreInterface
    {
        $target = $this->getTarget();
        if ($target instanceof CoreInterface) {
            return $target;
        }

        throw new NotCoreException;
    }
}
