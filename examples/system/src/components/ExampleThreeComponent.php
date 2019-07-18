<?php

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
