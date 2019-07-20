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
