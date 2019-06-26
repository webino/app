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


$core = new Core;
$app = $core->bootstrap();


$app->onHttp(function (HttpEvent $event) {

//    $event->setResponse(new TextResponse('Hello Webino!'));

    // TODO
    return 'Hello Web!';

//    return [
//        'foo' => [
//            'bar' => 'baz',
//        ],
//    ];

//    return new LocationResponse('http://google.com');

    //return new XmlResponse('<root>helloooooo</root>');

});

$app->onConsole(function (ConsoleEvent $event) {

    return 'Hello Console!';

});


$app->dispatch();
