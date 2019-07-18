<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUnusedParameterInspection
 * @interpreter php-cgi
 * @outputmatchfile App.http.expected
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use Tester\Assert;
use Tester\Environment;

Environment::setup();


$core = new BaseCore;
$app = $core->bootstrap();


$app->onDispatch(function (DispatchEvent $event) {
    Assert::type(HttpRequest::class, $event->getRequest());
});

$app->onHttp(function (HttpEvent $event) {
    return 'Hello Webino!';
});


$app->dispatch();
