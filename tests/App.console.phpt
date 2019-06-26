<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUnusedParameterInspection
 * @interpreter php
 * @outputmatch Hello Webino!
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


$core = new Core;
$app = $core->bootstrap();


$app->onDispatch(function (DispatchEvent $event) {

    Assert::type(ConsoleRequest::class, $event->getRequest());
});

$app->onConsole(function (ConsoleEvent $event) {
    return 'Hello Webino!';
});


$app->dispatch();
