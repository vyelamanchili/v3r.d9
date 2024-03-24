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

trait ShareTrait
{
    /**
     * Sets if the service must be shared or not.
     *
     * @param bool $shared Whether the service must be shared or not
     *
     * @return $this
     */
<<<<<<< Updated upstream
    final public function share($shared = true)
=======
    final public function share(bool $shared = true): static
>>>>>>> Stashed changes
    {
        $this->definition->setShared($shared);

        return $this;
    }
}
