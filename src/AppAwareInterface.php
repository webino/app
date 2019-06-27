<?php

namespace Webino;

/**
 * Interface AppAwareInterface
 * @package app
 */
interface AppAwareInterface
{
    /**
     * Returns application.
     *
     * @return AppInterface
     * @throws NotAppException
     */
    public function getApp(): AppInterface;
}
