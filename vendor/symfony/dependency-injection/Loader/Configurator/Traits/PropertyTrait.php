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

trait PropertyTrait
{
    /**
     * Sets a specific property.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
<<<<<<< Updated upstream
    final public function property($name, $value)
=======
    final public function property(string $name, mixed $value): static
>>>>>>> Stashed changes
    {
        $this->definition->setProperty($name, static::processValue($value, true));

        return $this;
    }
}
