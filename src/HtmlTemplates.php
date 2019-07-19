<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino/app
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

/**
 * Class HtmlTemplates
 * @todo Templates overloading
 * @package app
 */
class HtmlTemplates implements
    InstanceFactoryMethodInterface,
    HtmlTemplatesInterface
{
    use FilesystemAwareTrait;

    /**
     * @param CreateInstanceEventInterface $event
     * @return HtmlTemplates
     */
    public static function create(CreateInstanceEventInterface $event): HtmlTemplates
    {
        $container = $event->getContainer();
        /** @var LocalFilesystemInterface $filesystem */
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
     * Returns template contents.
     *
     * @param string $path HTML template path.
     * @return string
     */
    public function read(string $path): string
    {
        $filesystem = $this->getFilesystem();
        return $filesystem->read($path);
    }
}
