<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Sandbox;

/**
 * Exception thrown when a not allowed tag is used in a template.
 *
 * @author Martin Hasoň <martin.hason@gmail.com>
 */
final class SecurityNotAllowedTagError extends SecurityError
{
    private $tagName;

<<<<<<< Updated upstream
    public function __construct($message, $tagName, $lineno = -1, $filename = null, \Exception $previous = null)
    {
        parent::__construct($message, $lineno, $filename, $previous);
=======
    public function __construct(string $message, string $tagName)
    {
        parent::__construct($message);
>>>>>>> Stashed changes
        $this->tagName = $tagName;
    }

    public function getTagName(): string
    {
        return $this->tagName;
    }
}
