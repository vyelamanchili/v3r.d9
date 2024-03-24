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

/**
 * Interface all loaders must implement.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface LoaderInterface
{
    /**
     * Gets the source code of a template, given its name.
     *
<<<<<<< Updated upstream
     * @param string $name The name of the template to load
     *
     * @return string The template source code
     *
=======
>>>>>>> Stashed changes
     * @throws LoaderError When $name is not found
     *
     * @deprecated since 1.27 (to be removed in 2.0), implement Twig\Loader\SourceContextLoaderInterface
     */
<<<<<<< Updated upstream
    public function getSource($name);
=======
    public function getSourceContext(string $name): Source;
>>>>>>> Stashed changes

    /**
     * Gets the cache key to use for the cache for a given template name.
     *
     * @throws LoaderError When $name is not found
     */
    public function getCacheKey(string $name): string;

    /**
     * @param int $time Timestamp of the last modification time of the cached template
     *
     * @throws LoaderError When $name is not found
     */
<<<<<<< Updated upstream
    public function isFresh($name, $time);
=======
    public function isFresh(string $name, int $time): bool;

    /**
     * @return bool
     */
    public function exists(string $name);
>>>>>>> Stashed changes
}
