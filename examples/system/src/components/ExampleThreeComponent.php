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
 * Class ExampleThreeComponent
 * @package app
 * @sub-package examples
 */
class ExampleThreeComponent extends AbstractViewComponent
{
    public const NAME = 'component-three';

    public function onRender(ViewRenderEventInterface $event)
    {
        $node = $event->getNode();
        $newNode = $node->ownerDocument->createElement('h1');
        $newNode->nodeValue = $node->nodeValue;

        $node->parentNode->replaceChild($newNode, $node);
    }
}
