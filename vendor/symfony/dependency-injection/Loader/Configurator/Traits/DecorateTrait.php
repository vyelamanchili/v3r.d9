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

use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

trait DecorateTrait
{
    /**
     * Sets the service that this service is decorating.
     *
<<<<<<< Updated upstream
     * @param string|null $id        The decorated service id, use null to remove decoration
     * @param string|null $renamedId The new decorated service id
     * @param int         $priority  The priority of decoration
=======
     * @param string|null $id The decorated service id, use null to remove decoration
>>>>>>> Stashed changes
     *
     * @return $this
     *
     * @throws InvalidArgumentException in case the decorated service id and the new decorated service id are equals
     */
<<<<<<< Updated upstream
    final public function decorate($id, $renamedId = null, $priority = 0)
=======
    final public function decorate(?string $id, ?string $renamedId = null, int $priority = 0, int $invalidBehavior = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE): static
>>>>>>> Stashed changes
    {
        $this->definition->setDecoratedService($id, $renamedId, $priority);

        return $this;
    }
}
