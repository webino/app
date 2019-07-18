<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUnusedParameterInspection
 * @outputmatchfile App.route.example.expected
 * @interpreter php-cgi
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use Tester\Environment;

Environment::setup();
chdir(__DIR__ . '/../examples');


$container = new InstanceContainer;

/** @var HttpRequest $request */
$request = $container->make(HttpRequest::class, HttpRequest::defaults([
    HttpRequest::URI => 'example'
]));


$core = new BaseCore;
$app = $core->bootstrap();

$app->on(ExampleRoute::class, function (ExampleRoute $route) {
    return 'Example';
});

$app->dispatch($request);
