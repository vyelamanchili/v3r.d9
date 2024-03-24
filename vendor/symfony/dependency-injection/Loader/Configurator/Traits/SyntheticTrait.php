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

trait SyntheticTrait
{
    /**
     * Sets whether this definition is synthetic, that is not constructed by the
     * container, but dynamically injected.
     *
     * @param bool $synthetic
     *
     * @return $this
     */
<<<<<<< Updated upstream
    final public function synthetic($synthetic = true)
=======
    final public function synthetic(bool $synthetic = true): static
>>>>>>> Stashed changes
    {
        $this->definition->setSynthetic($synthetic);

        return $this;
    }
}
