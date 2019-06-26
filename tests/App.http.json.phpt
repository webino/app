<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUnusedParameterInspection
 * @interpreter php-cgi
 * @outputmatchfile App.http.json.expected
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use Tester\Environment;

Environment::setup();


$core = new Core;
$app = $core->bootstrap();


$app->onHttp(function (HttpEvent $event) {
    return ['foo' => ['bar' => 'baz']];
});


$app->dispatch();
