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

use ArrayIterator;

/**
 * Class RegexRouteMap
 * @package app
 */
class RegexRouteMap implements
    RegexRouteMapInterface,
    InstanceFactoryMethodInterface
{
    use FilesystemAwareTrait;
    use EachFileClassImplementsTrait;
    use VarExportPhpTrait;

    /**
     * Directory path to application route class files.
     */
    const ROUTES_DIR_PATH = 'system/src/routes';

    /**
     * File path to generated regex route map data.
     */
    const FILE_PATH = 'system/data/generated/regex-route-map.php';

    /**
     * @param CreateInstanceEventInterface $event
     * @return RegexRouteMap
     */
    public static function create(CreateInstanceEventInterface $event): RegexRouteMap
    {
        $container = $event->getContainer();
        $filesystem = $container->get(LocalFilesystemInterface::class);
        return new static($filesystem);
    }

    /**
     * @param FilesystemInterface $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->setFilesystem($filesystem);
    }

    /**
     * @return iterable
     */
    public function getIterator(): iterable
    {
        $this->isGenerated() or $this->generate();
        return $this->isGenerated() ? new ArrayIterator(require $this::FILE_PATH) : new ArrayIterator;
    }

    /**
     * @return bool
     */
    public function isGenerated(): bool
    {
        $filesystem = $this->getFilesystem();
        return $filesystem->has($this::FILE_PATH);
    }

    /**
     * @return void
     */
    public function generate(): void
    {
        $filesystem = $this->getFilesystem();
        if (!$filesystem->isDirectory($this::ROUTES_DIR_PATH)) {
            return;
        }

        $regexRouteMap = [];
        $this->eachFileClassImplements(
            $this::ROUTES_DIR_PATH,
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
