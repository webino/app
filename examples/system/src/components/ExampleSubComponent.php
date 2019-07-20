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
 * Class ExampleSubComponent
 * @package app
 * @sub-package examples
 */
class ExampleSubComponent extends AbstractViewComponent
{
    public const NAME = 'sub-component';

    public function onRender(ViewRenderEventInterface $event)
    {
        $node = $event->getNode();
        $newNode = $node->ownerDocument->createElement('button');
        $newNode->nodeValue = 'Click Me!';
        $node->parentNode->replaceChild($newNode, $node);
    }
}
