<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUndefinedClassInspection
 * @interpreter php-cgi
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

require __DIR__ . '/../../vendor/autoload.php';
chdir(__DIR__ . '/..');


$core = new Core;

$app = $core->bootstrap();

$app->onConsole(function (ConsoleEvent $event) {

    $app = $event->getApp();
    /** @var RegexRouteMap $regexRouteMap */
    $regexRouteMap = $app->get(RegexRouteMap::class);
    $regexRouteMap->generate();

    return 'Hello Console!';

});

$app->dispatch();
