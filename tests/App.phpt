<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @outputmatchfile App.expected
 * @interpreter php-cgi
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Webino\BaseCore;

Tester\Environment::setup();


$core = new BaseCore;

$app = $core->bootstrap();

$app->onHttp(function () {
    return 'OK';
});

$app->dispatch();
