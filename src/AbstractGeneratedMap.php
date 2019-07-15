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
 * Class AbstractGenerated
 * @package app
 */
abstract class AbstractGeneratedMap implements
    GeneratedMapInterface,
    RegexRouteMapInterface,
    InstanceFactoryMethodInterface
{
    use FilesystemAwareTrait;
    use EachFileClassImplementsTrait;
    use VarExportPhpTrait;

    /**
     * Directory path to application class files.
     */
    const CLASS_DIR_PATH = '';

    /**
     * File path to generated map data.
     */
    const FILE_PATH = '';

    /**
     * @param CreateInstanceEventInterface $event
     * @return AbstractGeneratedMap
     */
    public static function create(CreateInstanceEventInterface $event): AbstractGeneratedMap
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
     * Returns directories path to scan.
     *
     * @return array
     */
    public function getDirs(): array
    {
        return [
            $this::CLASS_DIR_PATH,
            __DIR__ . '/../src',
            __DIR__ . '/../vendor',
            __DIR__ . '/../../../../../vendor',
        ];
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
    abstract public function generate(): void;
}
