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
<<<<<<< Updated upstream
=======
use Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator;
use Symfony\Component\ExpressionLanguage\Expression;
>>>>>>> Stashed changes

trait FactoryTrait
{
    /**
     * Sets a factory.
     *
<<<<<<< Updated upstream
     * @param string|array $factory A PHP callable reference
     *
     * @return $this
     */
    final public function factory($factory)
=======
     * @return $this
     */
    final public function factory(string|array|ReferenceConfigurator|Expression $factory): static
>>>>>>> Stashed changes
    {
        if (\is_string($factory) && 1 === substr_count($factory, ':')) {
            $factoryParts = explode(':', $factory);

<<<<<<< Updated upstream
            throw new InvalidArgumentException(sprintf('Invalid factory "%s": the `service:method` notation is not available when using PHP-based DI configuration. Use "[ref(\'%s\'), \'%s\']" instead.', $factory, $factoryParts[0], $factoryParts[1]));
=======
            throw new InvalidArgumentException(sprintf('Invalid factory "%s": the "service:method" notation is not available when using PHP-based DI configuration. Use "[service(\'%s\'), \'%s\']" instead.', $factory, $factoryParts[0], $factoryParts[1]));
        }

        if ($factory instanceof Expression) {
            $factory = '@='.$factory;
>>>>>>> Stashed changes
        }

        $this->definition->setFactory(static::processValue($factory, true));

        return $this;
    }
}
