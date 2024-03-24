<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Loader;

use Twig\Error\LoaderError;
use Twig\Source;

/**
 * Loads a template from an array.
 *
 * When using this loader with a cache mechanism, you should know that a new cache
 * key is generated each time a template content "changes" (the cache key being the
 * source code of the template). If you don't want to see your cache grows out of
 * control, you need to take care of clearing the old cache file by yourself.
 *
 * This loader should only be used for unit testing.
 *
 * @final
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< Updated upstream
class ArrayLoader implements LoaderInterface, ExistsLoaderInterface, SourceContextLoaderInterface
=======
final class ArrayLoader implements LoaderInterface
>>>>>>> Stashed changes
{
    protected $templates = [];

    /**
     * @param array $templates An array of templates (keys are the names, and values are the source code)
     */
    public function __construct(array $templates = [])
    {
        $this->templates = $templates;
    }

    public function setTemplate(string $name, string $template): void
    {
        $this->templates[(string) $name] = $template;
    }

    public function getSource($name)
    {
        @trigger_error(sprintf('Calling "getSource" on "%s" is deprecated since 1.27. Use getSourceContext() instead.', \get_class($this)), E_USER_DEPRECATED);

        $name = (string) $name;
        if (!isset($this->templates[$name])) {
            throw new LoaderError(sprintf('Template "%s" is not defined.', $name));
        }

        return $this->templates[$name];
    }

    public function getSourceContext(string $name): Source
    {
        if (!isset($this->templates[$name])) {
            throw new LoaderError(sprintf('Template "%s" is not defined.', $name));
        }

        return new Source($this->templates[$name], $name);
    }

    public function exists(string $name): bool
    {
        return isset($this->templates[(string) $name]);
    }

    public function getCacheKey(string $name): string
    {
        $name = (string) $name;
        if (!isset($this->templates[$name])) {
            throw new LoaderError(sprintf('Template "%s" is not defined.', $name));
        }

        return $name.':'.$this->templates[$name];
    }

    public function isFresh(string $name, int $time): bool
    {
        $name = (string) $name;
        if (!isset($this->templates[$name])) {
            throw new LoaderError(sprintf('Template "%s" is not defined.', $name));
        }

        return true;
    }
}
