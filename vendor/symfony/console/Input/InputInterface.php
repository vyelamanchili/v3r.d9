<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Input;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;

/**
 * InputInterface is the interface implemented by all input classes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @method string __toString() Returns a stringified representation of the args passed to the command.
 *                             InputArguments MUST be escaped as well as the InputOption values passed to the command.
 */
interface InputInterface
{
    /**
     * Returns the first argument from the raw parameters (not parsed).
     */
    public function getFirstArgument(): ?string;

    /**
     * Returns true if the raw parameters (not parsed) contain a value.
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array $values     The values to look for in the raw parameters (can be an array)
     * @param bool         $onlyParams Only check real parameters, skip those following an end of options (--) signal
     */
    public function hasParameterOption(string|array $values, bool $onlyParams = false): bool;

    /**
     * Returns the value of a raw option (not parsed).
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array $values     The value(s) to look for in the raw parameters (can be an array)
     * @param mixed        $default    The default value to return if no result is found
     * @param bool         $onlyParams Only check real parameters, skip those following an end of options (--) signal
     *
     * @return mixed
     */
    public function getParameterOption(string|array $values, string|bool|int|float|array|null $default = false, bool $onlyParams = false);

    /**
     * Binds the current Input instance with the given arguments and options.
     *
     * @return void
     *
     * @throws RuntimeException
     */
    public function bind(InputDefinition $definition);

    /**
     * Validates the input.
     *
     * @return void
     *
     * @throws RuntimeException When not enough arguments are given
     */
    public function validate();

    /**
     * Returns all the given arguments merged with the default values.
     *
     * @return array
     */
    public function getArguments(): array;

    /**
     * Returns the argument value for a given argument name.
     *
<<<<<<< Updated upstream
     * @param string $name The argument name
     *
     * @return string|string[]|null The argument value
=======
     * @return mixed
>>>>>>> Stashed changes
     *
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function getArgument(string $name);

    /**
     * Sets an argument value by name.
     *
<<<<<<< Updated upstream
     * @param string               $name  The argument name
     * @param string|string[]|null $value The argument value
=======
     * @return void
>>>>>>> Stashed changes
     *
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function setArgument(string $name, mixed $value);

    /**
     * Returns true if an InputArgument object exists by name or position.
<<<<<<< Updated upstream
     *
     * @param string|int $name The InputArgument name or position
     *
     * @return bool true if the InputArgument object exists, false otherwise
=======
>>>>>>> Stashed changes
     */
    public function hasArgument(string $name): bool;

    /**
     * Returns all the given options merged with the default values.
     *
     * @return array
     */
    public function getOptions(): array;

    /**
     * Returns the option value for a given option name.
     *
<<<<<<< Updated upstream
     * @param string $name The option name
     *
     * @return string|string[]|bool|null The option value
=======
     * @return mixed
>>>>>>> Stashed changes
     *
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function getOption(string $name);

    /**
     * Sets an option value by name.
     *
<<<<<<< Updated upstream
     * @param string                    $name  The option name
     * @param string|string[]|bool|null $value The option value
=======
     * @return void
>>>>>>> Stashed changes
     *
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function setOption(string $name, mixed $value);

    /**
     * Returns true if an InputOption object exists by name.
     */
    public function hasOption(string $name): bool;

    /**
     * Is this input means interactive?
     */
    public function isInteractive(): bool;

    /**
     * Sets the input interactivity.
     *
     * @return void
     */
    public function setInteractive(bool $interactive);
}
