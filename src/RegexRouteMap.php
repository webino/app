<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpIncludeInspection
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

/**
 * Class RegexRouteMap
 * @package app
 */
class RegexRouteMap extends AbstractGeneratedMap
{
    /**
     * Directory path to application console commands class files.
     */
    const CLASS_DIR_PATH = 'system/src/routes';

    /**
     * File path to generated console command map data.
     */
    const FILE_PATH = 'system/data/generated/regex-route-map.php';

    /**
     * @return void
     */
    public function generate(): void
    {
        $filesystem = $this->getFilesystem();
        if (!$filesystem->isDirectory($this::CLASS_DIR_PATH)) {
            return;
        }

        $regexRouteMap = [];
        $this->eachFileClassImplements(
            $this::CLASS_DIR_PATH,
            '~Route.php$~',
            __NAMESPACE__,
            RegexRouteInterface::class,
            function (string $class) use (&$regexRouteMap) {
                $match = constant($class . '::MATCH');
                $regexRouteMap[$match] = $class;
            }
        );

        $export = $this->varExportPhp($regexRouteMap);
        $filesystem->write($this::FILE_PATH, $export, true);
    }
}
