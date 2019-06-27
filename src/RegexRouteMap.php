<?php

namespace Webino;

/**
 * Class RegexRouteMap
 * @package app
 */
class RegexRouteMap implements RegexRouteMapInterface
{
    public function getIterator(): iterable
    {
        $this->isGenerated() or $this->generate();

        // TODO filesystem
        $filePath = '../system/data/generated/regex-route-map.php';
        return file_exists($filePath) ? new \ArrayIterator(require $filePath) : new \ArrayIterator;
    }

    public function isGenerated()
    {
        // TODO filesystem
        $filePath = '../system/data/generated/regex-route-map.php';
        return file_exists($filePath);
    }

    public function generate()
    {
        $regexRouteMap = [];

        // TODO filesystem
        $dir = '../system/src/routes';
        if (!is_dir($dir)) {
            return;
        }

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
        // TODO filesystem
        $filePath = '../system/data/generated/regex-route-map.php';
        file_put_contents($filePath, $export);
    }
}
