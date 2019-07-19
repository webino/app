<?php

namespace Webino;

/**
 * Class ContentComponent
 * @package app
 * @sub-package examples
 */
class ContentComponent extends AbstractViewComponent
{
    public const NAME = 'content';

    /**
     * @param ViewRenderEventInterface $event
     */
    public function onRender(ViewRenderEventInterface $event)
    {
        $node = $event->getNode();
        $newNode = $node->createNode('div');

        $html = $event->getContent();
        $newNode->appendHtml($html);
        $newNode->replace($node);
    }
}
