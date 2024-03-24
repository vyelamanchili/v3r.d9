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

use Twig\Node\Node;

/**
 * Represents a template filter.
 *
<<<<<<< Updated upstream
 * @final
 *
=======
>>>>>>> Stashed changes
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class TwigFilter
{
<<<<<<< Updated upstream
    protected $name;
    protected $callable;
    protected $options;
    protected $arguments = [];

    public function __construct($name, $callable, array $options = [])
=======
    private $name;
    private $callable;
    private $options;
    private $arguments = [];

    /**
     * @param callable|array{class-string, string}|null $callable A callable implementing the filter. If null, you need to overwrite the "node_class" option to customize compilation.
     */
    public function __construct(string $name, $callable = null, array $options = [])
>>>>>>> Stashed changes
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->options = array_merge([
            'needs_environment' => false,
            'needs_context' => false,
            'is_variadic' => false,
            'is_safe' => null,
            'is_safe_callback' => null,
            'pre_escape' => null,
            'preserves_safety' => null,
            'node_class' => '\Twig\Node\Expression\FilterExpression',
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
     * Returns the callable to execute for this filter.
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

    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function needsEnvironment(): bool
    {
        return $this->options['needs_environment'];
    }

    public function needsContext(): bool
    {
        return $this->options['needs_context'];
    }

    public function getSafe(Node $filterArgs): ?array
    {
        if (null !== $this->options['is_safe']) {
            return $this->options['is_safe'];
        }

        if (null !== $this->options['is_safe_callback']) {
            return \call_user_func($this->options['is_safe_callback'], $filterArgs);
        }

        return null;
    }

    public function getPreservesSafety(): ?array
    {
        return $this->options['preserves_safety'];
    }

    public function getPreEscape(): ?string
    {
        return $this->options['pre_escape'];
    }

    public function isVariadic(): bool
    {
        return $this->options['is_variadic'];
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
}
<<<<<<< Updated upstream

class_alias('Twig\TwigFilter', 'Twig_SimpleFilter');

// Ensure that the aliased name is loaded to keep BC for classes implementing the typehint with the old aliased name.
class_exists('Twig\Node\Node');
=======
>>>>>>> Stashed changes
