<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUndefinedClassInspection
 * @interpreter php-cgi
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

require __DIR__ . '/../../vendor/autoload.php';
chdir(__DIR__ . '/..');


class TestComponent extends AbstractViewComponent
{
    public const XPATH = '//component';

    public function onRender(ViewRenderEventInterface $event)
    {
        $node = $event->getNode();
        $newNode = $node->ownerDocument->createElement('div');
        //$newNode->nodeValue = 'Hello';

        $newSubNode = $node->ownerDocument->createElement(TestSubComponent::NAME);
        $newNode->appendChild($newSubNode);

        $node->parentNode->replaceChild($newNode, $node);
    }
}

class TestSubComponent extends AbstractViewComponent
{
    public const NAME = 'sub-component';

    public const XPATH = '//sub-component';

    public function onRender(ViewRenderEventInterface $event)
    {
        $node = $event->getNode();
        $newNode = $node->ownerDocument->createElement('button');
        $newNode->nodeValue = 'Click Me!';
        $node->parentNode->replaceChild($newNode, $node);
    }
}



$core = new Core;

$app = $core->bootstrap();

$app->dispatch();
