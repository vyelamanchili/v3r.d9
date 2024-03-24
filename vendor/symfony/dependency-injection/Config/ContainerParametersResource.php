<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Config;

use Symfony\Component\Config\Resource\ResourceInterface;

/**
 * Tracks container parameters.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
<<<<<<< Updated upstream
=======
 *
 * @final
>>>>>>> Stashed changes
 */
class ContainerParametersResource implements ResourceInterface, \Serializable
{
    private array $parameters;

    /**
     * @param array $parameters The container parameters to track
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

<<<<<<< Updated upstream
    /**
     * {@inheritdoc}
     */
    public function __toString()
=======
    public function __toString(): string
>>>>>>> Stashed changes
    {
        return 'container_parameters_'.hash('xxh128', serialize($this->parameters));
    }

<<<<<<< Updated upstream
    /**
     * @internal
     */
    public function serialize()
    {
        return serialize($this->parameters);
    }

    /**
     * @internal
     */
    public function unserialize($serialized)
    {
        $this->parameters = unserialize($serialized);
    }

    /**
     * @return array Tracked parameters
     */
    public function getParameters()
=======
    public function getParameters(): array
>>>>>>> Stashed changes
    {
        return $this->parameters;
    }
}
