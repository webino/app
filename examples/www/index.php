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


$core = new Core;
$app = $core->bootstrap();


$app->onHttp(function (HttpEvent $event) {

    echo 'Hello Web!';

    // TODO
    return 'Hello Web!';

});

$app->onConsole(function (ConsoleEvent $event) {

    echo 'Hello Console!';

    // TODO
    return 'Hello Console!';

});


$app->dispatch();
