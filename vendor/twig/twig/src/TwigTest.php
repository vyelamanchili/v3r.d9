<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig;

/**
 * Represents a template test.
 *
<<<<<<< Updated upstream
 * @final
 *
=======
>>>>>>> Stashed changes
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class TwigTest
{
    protected $name;
    protected $callable;
    protected $options;

    private $arguments = [];

<<<<<<< Updated upstream
    public function __construct($name, $callable, array $options = [])
=======
    /**
     * @param callable|array{class-string, string}|null $callable A callable implementing the test. If null, you need to overwrite the "node_class" option to customize compilation.
     */
    public function __construct(string $name, $callable = null, array $options = [])
>>>>>>> Stashed changes
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->options = array_merge([
            'is_variadic' => false,
            'node_class' => '\Twig\Node\Expression\TestExpression',
            'deprecated' => false,
            'alternative' => null,
        ], $options);
    }

    public function getName(): string
    {
        return $this->name;
    }

<<<<<<< Updated upstream
=======
    /**
     * Returns the callable to execute for this test.
     *
     * @return callable|array{class-string, string}|null
     */
>>>>>>> Stashed changes
    public function getCallable()
    {
        return $this->callable;
    }

    public function getNodeClass(): string
    {
        return $this->options['node_class'];
    }

<<<<<<< Updated upstream
    public function isVariadic()
=======
    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function isVariadic(): bool
>>>>>>> Stashed changes
    {
        return (bool) $this->options['is_variadic'];
    }

    public function isDeprecated(): bool
    {
        return (bool) $this->options['deprecated'];
    }

    public function getDeprecatedVersion(): string
    {
        return \is_bool($this->options['deprecated']) ? '' : $this->options['deprecated'];
    }

    public function getAlternative(): ?string
    {
        return $this->options['alternative'];
    }

    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }
<<<<<<< Updated upstream

    public function getArguments()
    {
        return $this->arguments;
    }
}

class_alias('Twig\TwigTest', 'Twig_SimpleTest');
=======
}
>>>>>>> Stashed changes
