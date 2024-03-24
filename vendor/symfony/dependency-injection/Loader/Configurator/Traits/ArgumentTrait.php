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

trait ArgumentTrait
{
    /**
     * Sets the arguments to pass to the service constructor/factory method.
     *
     * @param array $arguments An array of arguments
     *
     * @return $this
     */
<<<<<<< Updated upstream
    final public function args(array $arguments)
=======
    final public function args(array $arguments): static
>>>>>>> Stashed changes
    {
        $this->definition->setArguments(static::processValue($arguments, true));

        return $this;
    }

    /**
     * Sets one argument to pass to the service constructor/factory method.
     *
     * @return $this
     */
<<<<<<< Updated upstream
    final public function arg($key, $value)
=======
    final public function arg(string|int $key, mixed $value): static
>>>>>>> Stashed changes
    {
        $this->definition->setArgument($key, static::processValue($value, true));

        return $this;
    }
}
