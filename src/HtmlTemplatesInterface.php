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
 * Interface HtmlTemplatesInterface
 * @package app
 */
interface HtmlTemplatesInterface
{
    /**
     * Returns template contents.
     *
     * @param string $path HTML template path.
     * @return string
     */
    public function read(string $path): string;
}
