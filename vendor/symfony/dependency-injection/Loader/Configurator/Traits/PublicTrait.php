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
 * @method $this public()
 * @method $this private()
 */
trait PublicTrait
{
    /**
     * @return $this
     */
<<<<<<< Updated upstream
    final protected function setPublic()
=======
    final public function public(): static
>>>>>>> Stashed changes
    {
        $this->definition->setPublic(true);

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< Updated upstream
    final protected function setPrivate()
=======
    final public function private(): static
>>>>>>> Stashed changes
    {
        $this->definition->setPublic(false);

        return $this;
    }
}
