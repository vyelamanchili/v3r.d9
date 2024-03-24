<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\ParameterBag;

use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;

/**
 * ParameterBagInterface.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface ParameterBagInterface
{
    /**
     * Clears all parameters.
     *
     * @return void
     *
     * @throws LogicException if the ParameterBagInterface cannot be cleared
     */
    public function clear();

    /**
     * Adds parameters to the service container parameters.
     *
<<<<<<< Updated upstream
     * @param array $parameters An array of parameters
     *
     * @throws LogicException if the parameter can not be added
=======
     * @return void
     *
     * @throws LogicException if the parameter cannot be added
>>>>>>> Stashed changes
     */
    public function add(array $parameters);

    /**
     * Gets the service container parameters.
     */
    public function all(): array;

    /**
     * Gets a service container parameter.
     *
<<<<<<< Updated upstream
     * @param string $name The parameter name
     *
     * @return mixed The parameter value
     *
=======
>>>>>>> Stashed changes
     * @throws ParameterNotFoundException if the parameter is not defined
     */
    public function get(string $name): array|bool|string|int|float|\UnitEnum|null;

    /**
     * Removes a parameter.
     *
     * @return void
     */
    public function remove(string $name);

    /**
     * Sets a service container parameter.
     *
<<<<<<< Updated upstream
     * @param string $name  The parameter name
     * @param mixed  $value The parameter value
=======
     * @return void
>>>>>>> Stashed changes
     *
     * @throws LogicException if the parameter cannot be set
     */
    public function set(string $name, array|bool|string|int|float|\UnitEnum|null $value);

    /**
     * Returns true if a parameter name is defined.
     */
    public function has(string $name): bool;

    /**
     * Replaces parameter placeholders (%name%) by their values for all parameters.
     *
     * @return void
     */
    public function resolve();

    /**
     * Replaces parameter placeholders (%name%) by their values.
     *
     * @return mixed
     *
     * @throws ParameterNotFoundException if a placeholder references a parameter that does not exist
     */
    public function resolveValue(mixed $value);

    /**
     * Escape parameter placeholders %.
     */
    public function escapeValue(mixed $value): mixed;

    /**
     * Unescape parameter placeholders %.
     */
    public function unescapeValue(mixed $value): mixed;
}
