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
 * Class ExampleComponent
 * @package app
 * @sub-package examples
 */
class ExampleComponent extends AbstractViewComponent
{
    public const NAME = 'component';

    public function onRender(ViewRenderEventInterface $event)
    {
        //die(get_class($event->getApp()));

        $node = $event->getNode();
        $newNode = $node->ownerDocument->createElement('div');
        //$newNode->nodeValue = 'Hello';

        $newSubNode = $node->ownerDocument->createElement(ExampleSubComponent::NAME);
        $newNode->appendChild($newSubNode);

        $node->parentNode->replaceChild($newNode, $node);
    }
}
