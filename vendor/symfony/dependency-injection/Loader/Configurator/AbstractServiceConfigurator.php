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

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

abstract class AbstractServiceConfigurator extends AbstractConfigurator
{
    protected $parent;
    protected $id;
    private array $defaultTags = [];

<<<<<<< Updated upstream
    public function __construct(ServicesConfigurator $parent, Definition $definition, $id = null, array $defaultTags = [])
=======
    public function __construct(ServicesConfigurator $parent, Definition $definition, ?string $id = null, array $defaultTags = [])
>>>>>>> Stashed changes
    {
        $this->parent = $parent;
        $this->definition = $definition;
        $this->id = $id;
        $this->defaultTags = $defaultTags;
    }

    public function __destruct()
    {
        // default tags should be added last
        foreach ($this->defaultTags as $name => $attributes) {
            foreach ($attributes as $attributes) {
                $this->definition->addTag($name, $attributes);
            }
        }
        $this->defaultTags = [];
    }

    /**
     * Registers a service.
     *
     * @param string      $id
     * @param string|null $class
     *
     * @return ServiceConfigurator
     */
<<<<<<< Updated upstream
    final public function set($id, $class = null)
=======
    final public function set(?string $id, ?string $class = null): ServiceConfigurator
>>>>>>> Stashed changes
    {
        $this->__destruct();

        return $this->parent->set($id, $class);
    }

    /**
     * Creates an alias.
     *
     * @param string $id
     * @param string $referencedId
     *
     * @return AliasConfigurator
     */
    final public function alias($id, $referencedId)
    {
        $this->__destruct();

        return $this->parent->alias($id, $referencedId);
    }

    /**
     * Registers a PSR-4 namespace using a glob pattern.
     *
     * @param string $namespace
     * @param string $resource
     *
     * @return PrototypeConfigurator
     */
    final public function load($namespace, $resource)
    {
        $this->__destruct();

        return $this->parent->load($namespace, $resource);
    }

    /**
     * Gets an already defined service definition.
     *
     * @param string $id
     *
     * @return ServiceConfigurator
     *
     * @throws ServiceNotFoundException if the service definition does not exist
     */
    final public function get($id)
    {
        $this->__destruct();

        return $this->parent->get($id);
    }

    /**
     * Removes an already defined service definition or alias.
     */
    final public function remove(string $id): ServicesConfigurator
    {
        $this->__destruct();

        return $this->parent->remove($id);
    }

    /**
     * Registers a stack of decorator services.
     *
     * @param InlineServiceConfigurator[]|ReferenceConfigurator[] $services
     */
    final public function stack(string $id, array $services): AliasConfigurator
    {
        $this->__destruct();

        return $this->parent->stack($id, $services);
    }

    /**
     * Registers a service.
     *
     * @param string      $id
     * @param string|null $class
     *
     * @return ServiceConfigurator
     */
<<<<<<< Updated upstream
    final public function __invoke($id, $class = null)
=======
    final public function __invoke(string $id, ?string $class = null): ServiceConfigurator
>>>>>>> Stashed changes
    {
        $this->__destruct();

        return $this->parent->set($id, $class);
    }
}
