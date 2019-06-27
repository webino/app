<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUnusedParameterInspection
 * @outputmatchfile App.route.home.expected
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
chdir(__DIR__ . '/../examples/www');


$container = new InstanceContainer;

/** @var HttpRequest $request */
$request = $container->make(HttpRequest::class, HttpRequest::defaults([
    HttpRequest::URI => ''
]));


$core = new Core;
$app = $core->bootstrap();

$app->on(HomeRoute::class, function (HomeRoute $route) {
    return 'Home';
});

$app->dispatch($request);
