<?php

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
