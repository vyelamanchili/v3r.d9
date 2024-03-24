<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator\Traits;

trait LazyTrait
{
    /**
     * Sets the lazy flag of this service.
     *
     * @param bool $lazy
     *
     * @return $this
     */
<<<<<<< Updated upstream
    final public function lazy($lazy = true)
=======
    final public function lazy(bool|string $lazy = true): static
>>>>>>> Stashed changes
    {
        $this->definition->setLazy($lazy);

        return $this;
    }
}
