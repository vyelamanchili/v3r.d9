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

/**
 * @method $this abstract(bool $abstract = true)
 */
trait AbstractTrait
{
    /**
     * Whether this definition is abstract, that means it merely serves as a
     * template for other definitions.
     *
     * @param bool $abstract
     *
     * @return $this
     */
<<<<<<< Updated upstream
    final protected function setAbstract($abstract = true)
=======
    final public function abstract(bool $abstract = true): static
>>>>>>> Stashed changes
    {
        $this->definition->setAbstract($abstract);

        return $this;
    }
}
