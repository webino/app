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

use Tester\Assert;
use Webino\Core;
use Webino\DispatchEvent;
use Webino\ConsoleRequest;

Tester\Environment::setup();


$core = new Core;
$app = $core->bootstrap();


$app->onDispatch(function (DispatchEvent $event) {

    Assert::type(ConsoleRequest::class, $event->getRequest());
});


$app->dispatch();
