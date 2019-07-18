<?php

namespace Webino;

/**
 * Class ExampleTwoComponent
 * @package app
 * @sub-package examples
 */
class ExampleTwoComponent extends AbstractViewComponent
{
    public const NAME = 'component-two';

    public function onRender(ViewRenderEventInterface $event)
    {
        $node = $event->getNode();
        $newNode = $node->ownerDocument->createElement('img');
        $src = 'https://webino.sk/assets/webino-theme-webino-sk/img/webino_logo.png';
        $newNode->setAttribute('src', $src);

        $node->parentNode->replaceChild($newNode, $node);
    }
}
