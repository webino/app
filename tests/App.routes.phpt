<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @outputmatch BootstrapOK
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Webino\Core;
use Webino\HttpRequest;

Tester\Environment::setup();


$core = new Core;

$core->onBootstrap(function () {

    echo 'Bootstrap';
});


$app = $core->bootstrap();


$app->onDispatch(function () {

    echo 'OK';
});

$app->dispatch();
