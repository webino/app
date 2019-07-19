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
 * Class RouteMap
 * @package app
 */
class RouteMap extends AbstractGeneratedMap
{
    /**
     * Directory path to application route class files.
     */
    const CLASS_DIR_PATH = 'system/src/routes';

    /**
     * File path to generated route map data.
     */
    const FILE_PATH = 'system/data/generated/routes.php';

    /**
     * @return void
     */
    public function generate(): void
    {
        $map = [];
        foreach ($this->getDirs() as $dir) {
            $this->eachFileClassImplements(
                $dir,
                '~/(?!Abstract)[^/]+Route.php$~',
                __NAMESPACE__,
                RouteInterface::class,
                function (string $class) use (&$map) {
                    $match = constant($class . '::ROUTE') ?: null;
                    $match and $map['~^' . trim($match, '/') . '$~'] = $class;
                }
            );
        }

        $export = $this->varExportPhp($map);
        $filesystem = $this->getFilesystem();
        $filesystem->write($this::FILE_PATH, $export, true);
    }
}
