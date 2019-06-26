<?php

namespace Webino;

/**
 * Trait AppAwareTrait
 * @package app
 */
trait AppAwareTrait
{
    /**
     * Returns application.
     *
     * @return AppInterface
     * @throws NotAppException
     */
    public function getApp(): AppInterface
    {
        $target = $this->getTarget();
        if ($target instanceof AppInterface) {
            return $target;
        }

        throw new NotAppException;
    }
}
