<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Exception;

/**
 * Represents an incorrect command name typed in the console.
 *
 * @author Jérôme Tamarelle <jerome@tamarelle.net>
 */
class CommandNotFoundException extends \InvalidArgumentException implements ExceptionInterface
{
    private array $alternatives;

    /**
     * @param string     $message      Exception message to throw
     * @param array      $alternatives List of similar defined names
     * @param int        $code         Exception code
     * @param \Exception $previous     Previous exception used for the exception chaining
     */
<<<<<<< Updated upstream
    public function __construct($message, array $alternatives = [], $code = 0, \Exception $previous = null)
=======
    public function __construct(string $message, array $alternatives = [], int $code = 0, ?\Throwable $previous = null)
>>>>>>> Stashed changes
    {
        parent::__construct($message, $code, $previous);

        $this->alternatives = $alternatives;
    }

    /**
<<<<<<< Updated upstream
     * @return array A list of similar defined names
=======
     * @return string[]
>>>>>>> Stashed changes
     */
    public function getAlternatives(): array
    {
        return $this->alternatives;
    }
}
