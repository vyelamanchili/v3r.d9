<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class ReferenceConfigurator extends AbstractConfigurator
{
    /** @internal */
    protected string $id;

    /** @internal */
    protected int $invalidBehavior = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return $this
     */
<<<<<<< Updated upstream
    final public function ignoreOnInvalid()
=======
    final public function ignoreOnInvalid(): static
>>>>>>> Stashed changes
    {
        $this->invalidBehavior = ContainerInterface::IGNORE_ON_INVALID_REFERENCE;

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< Updated upstream
    final public function nullOnInvalid()
=======
    final public function nullOnInvalid(): static
>>>>>>> Stashed changes
    {
        $this->invalidBehavior = ContainerInterface::NULL_ON_INVALID_REFERENCE;

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< Updated upstream
    final public function ignoreOnUninitialized()
=======
    final public function ignoreOnUninitialized(): static
>>>>>>> Stashed changes
    {
        $this->invalidBehavior = ContainerInterface::IGNORE_ON_UNINITIALIZED_REFERENCE;

        return $this;
    }

<<<<<<< Updated upstream
    public function __toString()
=======
    public function __toString(): string
>>>>>>> Stashed changes
    {
        return $this->id;
    }
}
