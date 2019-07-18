<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUndefinedClassInspection
 * @interpreter php
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


$app->onConsole(function (ConsoleEvent $event) {

    Assert::type(ConsoleRequest::class, $event->getConsoleRequest());
});


$app->dispatch();
