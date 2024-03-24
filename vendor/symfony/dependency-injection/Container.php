<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection;

use Symfony\Component\DependencyInjection\Exception\EnvNotFoundException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ParameterCircularReferenceException;
<<<<<<< Updated upstream
=======
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
>>>>>>> Stashed changes
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\ParameterBag\EnvPlaceholderParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Container is a dependency injection container.
 *
 * It gives access to object instances (services).
 * Services and parameters are simple key/pair stores.
 * The container can have four possible behaviors when a service
 * does not exist (or is not initialized for the last case):
 *
 *  * EXCEPTION_ON_INVALID_REFERENCE: Throws an exception at compilation time (the default)
 *  * NULL_ON_INVALID_REFERENCE:      Returns null
 *  * IGNORE_ON_INVALID_REFERENCE:    Ignores the wrapping command asking for the reference
 *                                    (for instance, ignore a setter if the service does not exist)
 *  * IGNORE_ON_UNINITIALIZED_REFERENCE: Ignores/returns null for uninitialized services or invalid references
 *  * RUNTIME_EXCEPTION_ON_INVALID_REFERENCE: Throws an exception at runtime
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class Container implements ContainerInterface, ResetInterface
{
    protected $parameterBag;
    protected $services = [];
    protected $fileMap = [];
    protected $methodMap = [];
    protected $aliases = [];
    protected $loading = [];
    protected $resolving = [];
    protected $syntheticIds = [];

<<<<<<< Updated upstream
    /**
     * @internal
     */
    protected $privates = [];

    /**
     * @internal
     */
    protected $normalizedIds = [];

    private $underscoreMap = ['_' => '', '.' => '_', '\\' => '_'];
    private $envCache = [];
    private $compiled = false;
    private $getEnv;
=======
    private array $envCache = [];
    private bool $compiled = false;
    private \Closure $getEnv;
>>>>>>> Stashed changes

    private static \Closure $make;

    public function __construct(?ParameterBagInterface $parameterBag = null)
    {
        $this->parameterBag = $parameterBag ?: new EnvPlaceholderParameterBag();
    }

    /**
     * Compiles the container.
     *
     * This method does two things:
     *
     *  * Parameter values are resolved;
     *  * The parameter bag is frozen.
     *
     * @return void
     */
    public function compile()
    {
        $this->parameterBag->resolve();

        $this->parameterBag = new FrozenParameterBag(
            $this->parameterBag->all(),
            $this->parameterBag instanceof ParameterBag ? $this->parameterBag->allDeprecated() : []
        );

        $this->compiled = true;
    }

    /**
     * Returns true if the container is compiled.
     */
    public function isCompiled(): bool
    {
        return $this->compiled;
    }

    /**
     * Returns true if the container parameter bag are frozen.
     *
     * @deprecated since version 3.3, to be removed in 4.0.
     *
     * @return bool true if the container parameter bag are frozen, false otherwise
     */
    public function isFrozen()
    {
        @trigger_error(sprintf('The %s() method is deprecated since Symfony 3.3 and will be removed in 4.0. Use the isCompiled() method instead.', __METHOD__), E_USER_DEPRECATED);

        return $this->parameterBag instanceof FrozenParameterBag;
    }

    /**
     * Gets the service container parameter bag.
     */
    public function getParameterBag(): ParameterBagInterface
    {
        return $this->parameterBag;
    }

    /**
     * Gets a parameter.
     *
<<<<<<< Updated upstream
     * @param string $name The parameter name
     *
     * @return mixed The parameter value
=======
     * @return array|bool|string|int|float|\UnitEnum|null
>>>>>>> Stashed changes
     *
     * @throws ParameterNotFoundException if the parameter is not defined
     */
    public function getParameter(string $name)
    {
        return $this->parameterBag->get($name);
    }

    public function hasParameter(string $name): bool
    {
        return $this->parameterBag->has($name);
    }

    /**
<<<<<<< Updated upstream
     * Sets a parameter.
     *
     * @param string $name  The parameter name
     * @param mixed  $value The parameter value
=======
     * @return void
>>>>>>> Stashed changes
     */
    public function setParameter(string $name, array|bool|string|int|float|\UnitEnum|null $value)
    {
        $this->parameterBag->set($name, $value);
    }

    /**
     * Sets a service.
     *
     * Setting a synthetic service to null resets it: has() returns false and get()
     * behaves in the same way as if the service was never created.
     *
     * @return void
     */
    public function set(string $id, ?object $service)
    {
        // Runs the internal initializer; used by the dumped container to include always-needed files
        if (isset($this->privates['service_container']) && $this->privates['service_container'] instanceof \Closure) {
            $initialize = $this->privates['service_container'];
            unset($this->privates['service_container']);
            $initialize($this);
        }

        $id = $this->normalizeId($id);

        if ('service_container' === $id) {
            throw new InvalidArgumentException('You cannot set service "service_container".');
        }

        if (isset($this->privates[$id]) || !(isset($this->fileMap[$id]) || isset($this->methodMap[$id]))) {
            if (!isset($this->privates[$id]) && !isset($this->getRemovedIds()[$id])) {
                // no-op
            } elseif (null === $service) {
                @trigger_error(sprintf('The "%s" service is private, unsetting it is deprecated since Symfony 3.2 and will fail in 4.0.', $id), E_USER_DEPRECATED);
                unset($this->privates[$id]);
            } else {
                @trigger_error(sprintf('The "%s" service is private, replacing it is deprecated since Symfony 3.2 and will fail in 4.0.', $id), E_USER_DEPRECATED);
            }
        } elseif (isset($this->services[$id])) {
            if (null === $service) {
                @trigger_error(sprintf('The "%s" service is already initialized, unsetting it is deprecated since Symfony 3.3 and will fail in 4.0.', $id), E_USER_DEPRECATED);
            } else {
                @trigger_error(sprintf('The "%s" service is already initialized, replacing it is deprecated since Symfony 3.3 and will fail in 4.0.', $id), E_USER_DEPRECATED);
            }
        }

        if (isset($this->aliases[$id])) {
            unset($this->aliases[$id]);
        }

        if (null === $service) {
            unset($this->services[$id]);

            return;
        }

        $this->services[$id] = $service;
    }

    public function has(string $id): bool
    {
        for ($i = 2;;) {
            if (isset($this->privates[$id])) {
                @trigger_error(sprintf('The "%s" service is private, checking for its existence is deprecated since Symfony 3.2 and will fail in 4.0.', $id), E_USER_DEPRECATED);
            }
            if (isset($this->aliases[$id])) {
                $id = $this->aliases[$id];
            }
            if (isset($this->services[$id])) {
                return true;
            }
            if ('service_container' === $id) {
                return true;
            }

            if (isset($this->fileMap[$id]) || isset($this->methodMap[$id])) {
                return true;
            }

            if (--$i && $id !== $normalizedId = $this->normalizeId($id)) {
                $id = $normalizedId;
                continue;
            }

            // We only check the convention-based factory in a compiled container (i.e. a child class other than a ContainerBuilder,
            // and only when the dumper has not generated the method map (otherwise the method map is considered to be fully populated by the dumper)
            if (!$this->methodMap && !$this instanceof ContainerBuilder && __CLASS__ !== static::class && method_exists($this, 'get'.strtr($id, $this->underscoreMap).'Service')) {
                @trigger_error('Generating a dumped container without populating the method map is deprecated since Symfony 3.2 and will be unsupported in 4.0. Update your dumper to generate the method map.', E_USER_DEPRECATED);

                return true;
            }

            return false;
        }
    }

    /**
     * Gets a service.
     *
<<<<<<< Updated upstream
     * If a service is defined both through a set() method and
     * with a get{$id}Service() method, the former has always precedence.
     *
     * @param string $id              The service identifier
     * @param int    $invalidBehavior The behavior when the service does not exist
     *
     * @return object|null The associated service
     *
=======
>>>>>>> Stashed changes
     * @throws ServiceCircularReferenceException When a circular reference is detected
     * @throws ServiceNotFoundException          When the service is not defined
     *
     * @see Reference
     */
    public function get(string $id, int $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE): ?object
    {
<<<<<<< Updated upstream
        // Attempt to retrieve the service by checking first aliases then
        // available services. Service IDs are case insensitive, however since
        // this method can be called thousands of times during a request, avoid
        // calling $this->normalizeId($id) unless necessary.
        for ($i = 2;;) {
            if (isset($this->privates[$id])) {
                @trigger_error(sprintf('The "%s" service is private, getting it from the container is deprecated since Symfony 3.2 and will fail in 4.0. You should either make the service public, or stop using the container directly and use dependency injection instead.', $id), E_USER_DEPRECATED);
            }
            if (isset($this->aliases[$id])) {
                $id = $this->aliases[$id];
            }

            // Re-use shared service instance if it exists.
            if (isset($this->services[$id])) {
                return $this->services[$id];
            }
            if ('service_container' === $id) {
                return $this;
            }

            if (isset($this->loading[$id])) {
                throw new ServiceCircularReferenceException($id, array_merge(array_keys($this->loading), [$id]));
            }

            $this->loading[$id] = true;

            try {
                if (isset($this->fileMap[$id])) {
                    return /* self::IGNORE_ON_UNINITIALIZED_REFERENCE */ 4 === $invalidBehavior ? null : $this->load($this->fileMap[$id]);
                } elseif (isset($this->methodMap[$id])) {
                    return /* self::IGNORE_ON_UNINITIALIZED_REFERENCE */ 4 === $invalidBehavior ? null : $this->{$this->methodMap[$id]}();
                } elseif (--$i && $id !== $normalizedId = $this->normalizeId($id)) {
                    unset($this->loading[$id]);
                    $id = $normalizedId;
                    continue;
                } elseif (!$this->methodMap && !$this instanceof ContainerBuilder && __CLASS__ !== static::class && method_exists($this, $method = 'get'.strtr($id, $this->underscoreMap).'Service')) {
                    // We only check the convention-based factory in a compiled container (i.e. a child class other than a ContainerBuilder,
                    // and only when the dumper has not generated the method map (otherwise the method map is considered to be fully populated by the dumper)
                    @trigger_error('Generating a dumped container without populating the method map is deprecated since Symfony 3.2 and will be unsupported in 4.0. Update your dumper to generate the method map.', E_USER_DEPRECATED);

                    return /* self::IGNORE_ON_UNINITIALIZED_REFERENCE */ 4 === $invalidBehavior ? null : $this->{$method}();
                }

                break;
            } catch (\Exception $e) {
                unset($this->services[$id]);

                throw $e;
            } finally {
                unset($this->loading[$id]);
            }
=======
        return $this->services[$id]
            ?? $this->services[$id = $this->aliases[$id] ?? $id]
            ?? ('service_container' === $id ? $this : ($this->factories[$id] ?? self::$make ??= self::make(...))($this, $id, $invalidBehavior));
    }

    /**
     * Creates a service.
     *
     * As a separate method to allow "get()" to use the really fast `??` operator.
     */
    private static function make(self $container, string $id, int $invalidBehavior): ?object
    {
        if (isset($container->loading[$id])) {
            throw new ServiceCircularReferenceException($id, array_merge(array_keys($container->loading), [$id]));
        }

        $container->loading[$id] = true;

        try {
            if (isset($container->fileMap[$id])) {
                return /* self::IGNORE_ON_UNINITIALIZED_REFERENCE */ 4 === $invalidBehavior ? null : $container->load($container->fileMap[$id]);
            } elseif (isset($container->methodMap[$id])) {
                return /* self::IGNORE_ON_UNINITIALIZED_REFERENCE */ 4 === $invalidBehavior ? null : $container->{$container->methodMap[$id]}($container);
            }
        } catch (\Exception $e) {
            unset($container->services[$id]);

            throw $e;
        } finally {
            unset($container->loading[$id]);
>>>>>>> Stashed changes
        }

        if (self::EXCEPTION_ON_INVALID_REFERENCE === $invalidBehavior) {
            if (!$id) {
                throw new ServiceNotFoundException($id);
            }
            if (isset($container->syntheticIds[$id])) {
                throw new ServiceNotFoundException($id, null, null, [], sprintf('The "%s" service is synthetic, it needs to be set at boot time before it can be used.', $id));
            }
            if (isset($container->getRemovedIds()[$id])) {
                throw new ServiceNotFoundException($id, null, null, [], sprintf('The "%s" service or alias has been removed or inlined when the container was compiled. You should either make it public, or stop using the container directly and use dependency injection instead.', $id));
            }

            $alternatives = [];
<<<<<<< Updated upstream
            foreach ($this->getServiceIds() as $knownId) {
=======
            foreach ($container->getServiceIds() as $knownId) {
                if ('' === $knownId || '.' === $knownId[0]) {
                    continue;
                }
>>>>>>> Stashed changes
                $lev = levenshtein($id, $knownId);
                if ($lev <= \strlen($id) / 3 || false !== strpos($knownId, $id)) {
                    $alternatives[] = $knownId;
                }
            }

            throw new ServiceNotFoundException($id, null, null, $alternatives);
        }
    }

    /**
     * Returns true if the given service has actually been initialized.
     */
    public function initialized(string $id): bool
    {
        $id = $this->normalizeId($id);

        if (isset($this->privates[$id])) {
            @trigger_error(sprintf('Checking for the initialization of the "%s" private service is deprecated since Symfony 3.4 and won\'t be supported anymore in Symfony 4.0.', $id), E_USER_DEPRECATED);
        }

        if (isset($this->aliases[$id])) {
            $id = $this->aliases[$id];
        }

        if ('service_container' === $id) {
            return false;
        }

        return isset($this->services[$id]);
    }

    /**
     * @return void
     */
    public function reset()
    {
<<<<<<< Updated upstream
        $this->services = [];
=======
        $services = $this->services + $this->privates;
        $this->services = $this->factories = $this->privates = [];

        foreach ($services as $service) {
            try {
                if ($service instanceof ResetInterface) {
                    $service->reset();
                }
            } catch (\Throwable) {
                continue;
            }
        }
>>>>>>> Stashed changes
    }

    /**
     * Gets all service ids.
     *
     * @return string[]
     */
    public function getServiceIds(): array
    {
        $ids = [];

        if (!$this->methodMap && !$this instanceof ContainerBuilder && __CLASS__ !== static::class) {
            // We only check the convention-based factory in a compiled container (i.e. a child class other than a ContainerBuilder,
            // and only when the dumper has not generated the method map (otherwise the method map is considered to be fully populated by the dumper)
            @trigger_error('Generating a dumped container without populating the method map is deprecated since Symfony 3.2 and will be unsupported in 4.0. Update your dumper to generate the method map.', E_USER_DEPRECATED);

            foreach (get_class_methods($this) as $method) {
                if (preg_match('/^get(.+)Service$/', $method, $match)) {
                    $ids[] = self::underscore($match[1]);
                }
            }
        }
        $ids[] = 'service_container';

        return array_map('strval', array_unique(array_merge($ids, array_keys($this->methodMap), array_keys($this->fileMap), array_keys($this->aliases), array_keys($this->services))));
    }

    /**
     * Gets service ids that existed at compile time.
     */
    public function getRemovedIds(): array
    {
        return [];
    }

    /**
     * Camelizes a string.
     */
    public static function camelize(string $id): string
    {
        return strtr(ucwords(strtr($id, ['_' => ' ', '.' => '_ ', '\\' => '_ '])), [' ' => '']);
    }

    /**
     * A string to underscore.
     */
    public static function underscore(string $id): string
    {
        return strtolower(preg_replace(['/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'], ['\\1_\\2', '\\1_\\2'], str_replace('_', '.', $id)));
    }

    /**
     * Creates a service by requiring its factory file.
     *
     * @return mixed
     */
    protected function load(string $file)
    {
        return require $file;
    }

    /**
     * Fetches a variable from the environment.
     *
     * @throws EnvNotFoundException When the environment variable is not found and has no default value
     */
    protected function getEnv(string $name): mixed
    {
        if (isset($this->resolving[$envName = "env($name)"])) {
            throw new ParameterCircularReferenceException(array_keys($this->resolving));
        }
        if (isset($this->envCache[$name]) || \array_key_exists($name, $this->envCache)) {
            return $this->envCache[$name];
        }
        if (!$this->has($id = 'container.env_var_processors_locator')) {
            $this->set($id, new ServiceLocator([]));
        }
<<<<<<< Updated upstream
        if (!$this->getEnv) {
            $this->getEnv = new \ReflectionMethod($this, __FUNCTION__);
            $this->getEnv->setAccessible(true);
            $this->getEnv = $this->getEnv->getClosure($this);
        }
=======
        $this->getEnv ??= $this->getEnv(...);
>>>>>>> Stashed changes
        $processors = $this->get($id);

        if (false !== $i = strpos($name, ':')) {
            $prefix = substr($name, 0, $i);
            $localName = substr($name, 1 + $i);
        } else {
            $prefix = 'string';
            $localName = $name;
        }

        $processor = $processors->has($prefix) ? $processors->get($prefix) : new EnvVarProcessor($this);
        if (false === $i) {
            $prefix = '';
        }

        $this->resolving[$envName] = true;
        try {
            return $this->envCache[$name] = $processor->getEnv($prefix, $localName, $this->getEnv);
        } finally {
            unset($this->resolving[$envName]);
        }
    }

    /**
<<<<<<< Updated upstream
     * Returns the case sensitive id used at registration time.
     *
     * @param string $id
     *
     * @return string
     *
     * @internal
     */
    public function normalizeId($id)
=======
     * @internal
     */
    final protected function getService(string|false $registry, string $id, ?string $method, string|bool $load): mixed
>>>>>>> Stashed changes
    {
        if (!\is_string($id)) {
            $id = (string) $id;
        }
<<<<<<< Updated upstream
        if (isset($this->normalizedIds[$normalizedId = strtolower($id)])) {
            $normalizedId = $this->normalizedIds[$normalizedId];
            if ($id !== $normalizedId) {
                @trigger_error(sprintf('Service identifiers will be made case sensitive in Symfony 4.0. Using "%s" instead of "%s" is deprecated since Symfony 3.3.', $id, $normalizedId), E_USER_DEPRECATED);
            }
        } else {
            $normalizedId = $this->normalizedIds[$normalizedId] = $id;
        }

        return $normalizedId;
=======
        if (\is_string($load)) {
            throw new RuntimeException($load);
        }
        if (null === $method) {
            return false !== $registry ? $this->{$registry}[$id] ?? null : null;
        }
        if (false !== $registry) {
            return $this->{$registry}[$id] ??= $load ? $this->load($method) : $this->{$method}($this);
        }
        if (!$load) {
            return $this->{$method}($this);
        }

        return ($factory = $this->factories[$id] ?? $this->factories['service_container'][$id] ?? null) ? $factory($this) : $this->load($method);
>>>>>>> Stashed changes
    }

    private function __clone()
    {
    }
}
