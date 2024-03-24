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

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @method InstanceofConfigurator instanceof($fqcn)
 */
class ServicesConfigurator extends AbstractConfigurator
{
    const FACTORY = 'services';

<<<<<<< Updated upstream
    private $defaults;
    private $container;
    private $loader;
    private $instanceof;

    public function __construct(ContainerBuilder $container, PhpFileLoader $loader, array &$instanceof)
=======
    private Definition $defaults;
    private ContainerBuilder $container;
    private PhpFileLoader $loader;
    private array $instanceof;
    private ?string $path;
    private string $anonymousHash;
    private int $anonymousCount;

    public function __construct(ContainerBuilder $container, PhpFileLoader $loader, array &$instanceof, ?string $path = null, int &$anonymousCount = 0)
>>>>>>> Stashed changes
    {
        $this->defaults = new Definition();
        $this->container = $container;
        $this->loader = $loader;
        $this->instanceof = &$instanceof;
        $instanceof = [];
    }

    /**
     * Defines a set of defaults for following service definitions.
     *
     * @return DefaultsConfigurator
     */
    final public function defaults()
    {
        return new DefaultsConfigurator($this, $this->defaults = new Definition());
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
        $this->instanceof[$fqcn] = $definition = new ChildDefinition('');

        return new InstanceofConfigurator($this, $definition, $fqcn);
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
        $defaults = $this->defaults;
        $definition = new Definition();
<<<<<<< Updated upstream
        if (!$defaults->isPublic() || !$defaults->isPrivate()) {
=======

        if (null === $id) {
            if (!$class) {
                throw new \LogicException('Anonymous services must have a class name.');
            }

            $id = sprintf('.%d_%s', ++$this->anonymousCount, preg_replace('/^.*\\\\/', '', $class).'~'.$this->anonymousHash);
        } elseif (!$defaults->isPublic() || !$defaults->isPrivate()) {
>>>>>>> Stashed changes
            $definition->setPublic($defaults->isPublic() && !$defaults->isPrivate());
        }
        $definition->setAutowired($defaults->isAutowired());
        $definition->setAutoconfigured($defaults->isAutoconfigured());
        // deep clone, to avoid multiple process of the same instance in the passes
        $definition->setBindings(unserialize(serialize($defaults->getBindings())));
        $definition->setChanges([]);

<<<<<<< Updated upstream
        $configurator = new ServiceConfigurator($this->container, $this->instanceof, $allowParent, $this, $definition, $id, $defaults->getTags());
=======
        $configurator = new ServiceConfigurator($this->container, $this->instanceof, true, $this, $definition, $id, $defaults->getTags(), $this->path);
>>>>>>> Stashed changes

        return null !== $class ? $configurator->class($class) : $configurator;
    }

    /**
     * Removes an already defined service definition or alias.
     *
     * @return $this
     */
    final public function remove(string $id): static
    {
        $this->container->removeDefinition($id);
        $this->container->removeAlias($id);

        return $this;
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
        $ref = static::processValue($referencedId, true);
        $alias = new Alias((string) $ref);
        if (!$this->defaults->isPublic() || !$this->defaults->isPrivate()) {
            $alias->setPublic($this->defaults->isPublic());
        }
        $this->container->setAlias($id, $alias);

        return new AliasConfigurator($this, $alias);
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
        return new PrototypeConfigurator($this, $this->loader, $this->defaults, $namespace, $resource, true, $this->path);
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
        $definition = $this->container->getDefinition($id);

        return new ServiceConfigurator($this->container, $definition->getInstanceofConditionals(), true, $this, $definition, $id, []);
    }

    /**
     * Registers a stack of decorator services.
     *
     * @param InlineServiceConfigurator[]|ReferenceConfigurator[] $services
     */
    final public function stack(string $id, array $services): AliasConfigurator
    {
        foreach ($services as $i => $service) {
            if ($service instanceof InlineServiceConfigurator) {
                $definition = $service->definition->setInstanceofConditionals($this->instanceof);

                $changes = $definition->getChanges();
                $definition->setAutowired((isset($changes['autowired']) ? $definition : $this->defaults)->isAutowired());
                $definition->setAutoconfigured((isset($changes['autoconfigured']) ? $definition : $this->defaults)->isAutoconfigured());
                $definition->setBindings(array_merge($this->defaults->getBindings(), $definition->getBindings()));
                $definition->setChanges($changes);

                $services[$i] = $definition;
            } elseif (!$service instanceof ReferenceConfigurator) {
                throw new InvalidArgumentException(sprintf('"%s()" expects a list of definitions as returned by "%s()" or "%s()", "%s" given at index "%s" for service "%s".', __METHOD__, InlineServiceConfigurator::FACTORY, ReferenceConfigurator::FACTORY, $service instanceof AbstractConfigurator ? $service::FACTORY.'()' : get_debug_type($service), $i, $id));
            }
        }

        $alias = $this->alias($id, '');
        $alias->definition = $this->set($id)
            ->parent('')
            ->args($services)
            ->tag('container.stack')
            ->definition;

        return $alias;
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
        return $this->set($id, $class);
    }
}
