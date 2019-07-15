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
 * Class ConsoleCommandMap
 * @package app
 */
class ConsoleCommandMap extends AbstractGeneratedMap
{
    /**
     * Directory path to application console commands class files.
     */
    const CLASS_DIR_PATH = 'system/src/commands';

    /**
     * File path to generated console command map data.
     */
    const FILE_PATH = 'system/data/generated/console-command-map.php';

    /**
     * @return void
     */
    public function generate(): void
    {
        $filesystem = $this->getFilesystem();
        if (!$filesystem->isDirectory($this::CLASS_DIR_PATH)) {
            return;
        }

        $map = [];
        $this->eachFileClassImplements(
            $this::CLASS_DIR_PATH,
            '~Command.php$~',
            __NAMESPACE__,
            ConsoleCommandInterface::class,
            function (string $class) use (&$map) {
                $name = constant($class . '::NAME');
                $map[$name] = $class;
            }
        );

        $export = $this->varExportPhp($map);
        $filesystem->write($this::FILE_PATH, $export, true);
    }
}
