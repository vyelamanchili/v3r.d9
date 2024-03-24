<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Argument;

/**
 * @author Guilhem Niot <guilhem.niot@gmail.com>
 */
final class BoundArgument implements ArgumentInterface
{
<<<<<<< Updated upstream
    private static $sequence = 0;

    private $value;
    private $identifier;
    private $used;

    public function __construct($value)
=======
    public const SERVICE_BINDING = 0;
    public const DEFAULTS_BINDING = 1;
    public const INSTANCEOF_BINDING = 2;

    private static int $sequence = 0;

    private mixed $value;
    private ?int $identifier = null;
    private ?bool $used = null;
    private int $type;
    private ?string $file;

    public function __construct(mixed $value, bool $trackUsage = true, int $type = 0, ?string $file = null)
>>>>>>> Stashed changes
    {
        $this->value = $value;
        $this->identifier = ++self::$sequence;
    }

<<<<<<< Updated upstream
    /**
     * {@inheritdoc}
     */
    public function getValues()
=======
    public function getValues(): array
>>>>>>> Stashed changes
    {
        return [$this->value, $this->identifier, $this->used];
    }

    public function setValues(array $values): void
    {
        list($this->value, $this->identifier, $this->used) = $values;
    }
}
