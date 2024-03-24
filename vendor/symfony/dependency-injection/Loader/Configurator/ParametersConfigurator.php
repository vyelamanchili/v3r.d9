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

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class ParametersConfigurator extends AbstractConfigurator
{
    const FACTORY = 'parameters';

    private ContainerBuilder $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
    }

    /**
<<<<<<< Updated upstream
     * Creates a parameter.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    final public function set($name, $value)
=======
     * @return $this
     */
    final public function set(string $name, mixed $value): static
>>>>>>> Stashed changes
    {
        $this->container->setParameter($name, static::processValue($value, true));

        return $this;
    }

    /**
<<<<<<< Updated upstream
     * Creates a parameter.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    final public function __invoke($name, $value)
=======
     * @return $this
     */
    final public function __invoke(string $name, mixed $value): static
>>>>>>> Stashed changes
    {
        return $this->set($name, $value);
    }
}
