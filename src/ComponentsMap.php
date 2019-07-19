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
 * Class ComponentsMap
 * @package app
 */
class ComponentsMap extends AbstractGeneratedMap
{
    /**
     * Directory path to application route class files.
     */
    const CLASS_DIR_PATH = 'system/src/components';

    /**
     * File path to generated route map data.
     */
    const FILE_PATH = 'system/data/generated/components.php';

    /**
     * @return void
     */
    public function generate(): void
    {
        $map = [];
        foreach ($this->getDirs() as $dir) {
            $this->eachFileClassImplements(
                $dir,
                '~/(?!Abstract)[^/]+Component.php$~',
                __NAMESPACE__,
                ViewComponentInterface::class,
                function (string $class) use (&$map) {
                    $name = constant($class . '::NAME') ?: null;
                    $name and $map[$name] = $class;
                }
            );
        }

        $export = $this->varExportPhp($map);
        $filesystem = $this->getFilesystem();
        $filesystem->write($this::FILE_PATH, $export, true);
    }
}
