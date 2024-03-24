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

use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @method InstanceofConfigurator instanceof(string $fqcn)
 */
class DefaultsConfigurator extends AbstractServiceConfigurator
{
    const FACTORY = 'defaults';

    use Traits\AutoconfigureTrait;
    use Traits\AutowireTrait;
    use Traits\BindTrait;
    use Traits\PublicTrait;

<<<<<<< Updated upstream
=======
    public const FACTORY = 'defaults';

    private ?string $path;

    public function __construct(ServicesConfigurator $parent, Definition $definition, ?string $path = null)
    {
        parent::__construct($parent, $definition, null, []);

        $this->path = $path;
    }

>>>>>>> Stashed changes
    /**
     * Adds a tag for this definition.
     *
     * @param string $name       The tag name
     * @param array  $attributes An array of attributes
     *
     * @return $this
     *
     * @throws InvalidArgumentException when an invalid tag name or attribute is provided
     */
<<<<<<< Updated upstream
    final public function tag($name, array $attributes = [])
=======
    final public function tag(string $name, array $attributes = []): static
>>>>>>> Stashed changes
    {
        if (!\is_string($name) || '' === $name) {
            throw new InvalidArgumentException('The tag name in "_defaults" must be a non-empty string.');
        }

<<<<<<< Updated upstream
        foreach ($attributes as $attribute => $value) {
            if (!is_scalar($value) && null !== $value) {
                throw new InvalidArgumentException(sprintf('Tag "%s", attribute "%s" in "_defaults" must be of a scalar-type.', $name, $attribute));
            }
        }
=======
        $this->validateAttributes($name, $attributes);
>>>>>>> Stashed changes

        $this->definition->addTag($name, $attributes);

        return $this;
    }

    /**
     * Defines an instanceof-conditional to be applied to following service definitions.
     *
     * @param string $fqcn
     *
     * @return InstanceofConfigurator
     */
    final protected function setInstanceof($fqcn)
    {
        return $this->parent->instanceof($fqcn);
    }

    private function validateAttributes(string $tag, array $attributes, array $path = []): void
    {
        foreach ($attributes as $name => $value) {
            if (\is_array($value)) {
                $this->validateAttributes($tag, $value, [...$path, $name]);
            } elseif (!\is_scalar($value ?? '')) {
                $name = implode('.', [...$path, $name]);
                throw new InvalidArgumentException(sprintf('Tag "%s", attribute "%s" in "_defaults" must be of a scalar-type or an array of scalar-type.', $tag, $name));
            }
        }
    }
}
