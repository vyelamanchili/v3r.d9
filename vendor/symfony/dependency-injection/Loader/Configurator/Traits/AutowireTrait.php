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

trait AutowireTrait
{
    /**
     * Enables/disables autowiring.
     *
     * @param bool $autowired
     *
     * @return $this
     */
<<<<<<< Updated upstream
    final public function autowire($autowired = true)
=======
    final public function autowire(bool $autowired = true): static
>>>>>>> Stashed changes
    {
        $this->definition->setAutowired($autowired);

        return $this;
    }
}
