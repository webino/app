<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @outputmatchfile App.routes.expected
 * @interpreter php-cgi
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Webino\Core;

Tester\Environment::setup();


$core = new Core;

$app = $core->bootstrap();

$app->onHttp(function () {
    return 'OK';
});

$app->dispatch();
