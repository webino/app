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


class DefaultRoute extends AbstractRoute
{
    public function onRoute(AbstractRoute $route)
    {
        return 'Not Found';
    }
}

class RegexRouteMap implements RegexRouteMapInterface
{
    public function getIterator(): iterable
    {
        $filePath = __DIR__ . '/../data/compiled/regex-route-map.php';
        return new \ArrayIterator(require $filePath);
//        return new \ArrayIterator([
//            HomeRoute::PATTERN => HomeRoute::class,
//            ExampleRoute::PATTERN => ExampleRoute::class,
//        ]);
    }
}

$core = new Core;
$app = $core->bootstrap();

$app->onHttp($app->get(HttpRegexRouter::class));

$app->onConsole(function (ConsoleEvent $event) {


    $regexRouteMap = [];

    $dir = __DIR__  . '/../src/routes';;
    $iterator = new RecursiveDirectoryRegexIterator($dir, '~Route.php$~');
    foreach ($iterator as $routeFile) {
        $routeClass = 'Webino\\' . substr(basename($routeFile), 0, -4);
        $implements = class_implements($routeClass);

        if (!empty($implements[RegexRouteInterface::class])) {
            $pattern = constant($routeClass . '::PATTERN');
            $regexRouteMap[$pattern] = $routeClass;
        }
    }

    $export = '<?php return ' . var_export($regexRouteMap, true) . ';';
    $filePath = __DIR__ . '/../data/compiled/regex-route-map.php';
    file_put_contents($filePath, $export);

    return 'Hello Console!';

});


//$app->on(DefaultRoute::class, function (DefaultRoute $route) {
//    return 'Not Found';
//});
//
//$app->on(HomeRoute::class, function (HomeRoute $route) {
//    return 'HOME';
//});
//
//$app->on(ExampleRoute::class, function (ExampleRoute $route) {
//    return 'Example';
//});

$app->dispatch();
