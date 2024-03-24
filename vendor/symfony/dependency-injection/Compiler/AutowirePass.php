<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Compiler;

use Symfony\Component\Config\Resource\ClassExistenceResource;
<<<<<<< Updated upstream
use Symfony\Component\DependencyInjection\Config\AutowireServiceResource;
=======
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\AutowireCallable;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Symfony\Component\DependencyInjection\Attribute\MapDecorated;
use Symfony\Component\DependencyInjection\Attribute\Target;
>>>>>>> Stashed changes
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\AutowiringFailedException;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\TypedReference;
use Symfony\Component\VarExporter\ProxyHelper;

/**
 * Inspects existing service definitions and wires the autowired ones using the type hints of their classes.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 * @author Nicolas Grekas <p@tchwork.com>
 */
class AutowirePass extends AbstractRecursivePass
{
<<<<<<< Updated upstream
    private $definedTypes = [];
    private $types;
    private $ambiguousServiceTypes;
    private $autowired = [];
    private $lastFailure;
    private $throwOnAutowiringException;
    private $autowiringExceptions = [];
    private $strictMode;

    /**
     * @param bool $throwOnAutowireException Errors can be retrieved via Definition::getErrors()
     */
    public function __construct($throwOnAutowireException = true)
    {
        $this->throwOnAutowiringException = $throwOnAutowireException;
    }

    /**
     * @deprecated since version 3.4, to be removed in 4.0.
     *
     * @return AutowiringFailedException[]
     */
    public function getAutowiringExceptions()
    {
        @trigger_error('Calling AutowirePass::getAutowiringExceptions() is deprecated since Symfony 3.4 and will be removed in 4.0. Use Definition::getErrors() instead.', E_USER_DEPRECATED);

        return $this->autowiringExceptions;
=======
    protected bool $skipScalars = true;

    private array $types;
    private array $ambiguousServiceTypes;
    private array $autowiringAliases;
    private ?string $lastFailure = null;
    private bool $throwOnAutowiringException;
    private ?string $decoratedClass = null;
    private ?string $decoratedId = null;
    private ?array $methodCalls = null;
    private object $defaultArgument;
    private ?\Closure $getPreviousValue = null;
    private ?int $decoratedMethodIndex = null;
    private ?int $decoratedMethodArgumentIndex = null;
    private ?self $typesClone = null;

    public function __construct(bool $throwOnAutowireException = true)
    {
        $this->throwOnAutowiringException = $throwOnAutowireException;
        $this->defaultArgument = new class() {
            public $value;
            public $names;
            public $bag;

            public function withValue(\ReflectionParameter $parameter): self
            {
                $clone = clone $this;
                $clone->value = $this->bag->escapeValue($parameter->getDefaultValue());

                return $clone;
            }
        };
>>>>>>> Stashed changes
    }

    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
<<<<<<< Updated upstream
        // clear out any possibly stored exceptions from before
        $this->autowiringExceptions = [];
        $this->strictMode = $container->hasParameter('container.autowiring.strict_mode') && $container->getParameter('container.autowiring.strict_mode');
=======
        $this->defaultArgument->bag = $container->getParameterBag();
>>>>>>> Stashed changes

        try {
            parent::process($container);
        } finally {
<<<<<<< Updated upstream
            $this->definedTypes = [];
            $this->types = null;
            $this->ambiguousServiceTypes = null;
            $this->autowired = [];
        }
    }

    /**
     * Creates a resource to help know if this service has changed.
     *
     * @return AutowireServiceResource
     *
     * @deprecated since version 3.3, to be removed in 4.0. Use ContainerBuilder::getReflectionClass() instead.
     */
    public static function createResourceForClass(\ReflectionClass $reflectionClass)
    {
        @trigger_error('The '.__METHOD__.'() method is deprecated since Symfony 3.3 and will be removed in 4.0. Use ContainerBuilder::getReflectionClass() instead.', E_USER_DEPRECATED);

        $metadata = [];

        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            if (!$reflectionMethod->isStatic()) {
                $metadata[$reflectionMethod->name] = self::getResourceMetadataForMethod($reflectionMethod);
            }
        }

        return new AutowireServiceResource($reflectionClass->name, $reflectionClass->getFileName(), $metadata);
    }

    /**
     * {@inheritdoc}
     */
    protected function processValue($value, $isRoot = false)
=======
            $this->decoratedClass = null;
            $this->decoratedId = null;
            $this->methodCalls = null;
            $this->defaultArgument->bag = null;
            $this->defaultArgument->names = null;
            $this->getPreviousValue = null;
            $this->decoratedMethodIndex = null;
            $this->decoratedMethodArgumentIndex = null;
            $this->typesClone = null;
        }
    }

    protected function processValue(mixed $value, bool $isRoot = false): mixed
>>>>>>> Stashed changes
    {
        if ($value instanceof Autowire) {
            return $this->processValue($this->container->getParameterBag()->resolveValue($value->value));
        }

        if ($value instanceof AutowireDecorated || $value instanceof MapDecorated) {
            $definition = $this->container->getDefinition($this->currentId);

            return new Reference($definition->innerServiceId ?? $this->currentId.'.inner', $definition->decorationOnInvalid ?? ContainerInterface::NULL_ON_INVALID_REFERENCE);
        }

        try {
            return $this->doProcessValue($value, $isRoot);
        } catch (AutowiringFailedException $e) {
            if ($this->throwOnAutowiringException) {
                throw $e;
            }

            $this->autowiringExceptions[] = $e;
            $this->container->getDefinition($this->currentId)->addError($e->getMessage());

            return parent::processValue($value, $isRoot);
        }
    }

<<<<<<< Updated upstream
    private function doProcessValue($value, $isRoot = false)
    {
        if ($value instanceof TypedReference) {
            if ($ref = $this->getAutowiredReference($value, $value->getRequiringClass() ? sprintf('for "%s" in "%s"', $value->getType(), $value->getRequiringClass()) : '')) {
=======
    private function doProcessValue(mixed $value, bool $isRoot = false): mixed
    {
        if ($value instanceof TypedReference) {
            foreach ($value->getAttributes() as $attribute) {
                if ($attribute === $v = $this->processValue($attribute)) {
                    continue;
                }
                if (!$attribute instanceof Autowire || !$v instanceof Reference) {
                    return $v;
                }

                $invalidBehavior = ContainerBuilder::EXCEPTION_ON_INVALID_REFERENCE !== $v->getInvalidBehavior() ? $v->getInvalidBehavior() : $value->getInvalidBehavior();
                $value = $v instanceof TypedReference
                    ? new TypedReference($v, $v->getType(), $invalidBehavior, $v->getName() ?? $value->getName(), array_merge($v->getAttributes(), $value->getAttributes()))
                    : new TypedReference($v, $value->getType(), $invalidBehavior, $value->getName(), $value->getAttributes());
                break;
            }
            if ($ref = $this->getAutowiredReference($value, true)) {
>>>>>>> Stashed changes
                return $ref;
            }
            $this->container->log($this, $this->createTypeNotFoundMessage($value, 'it'));
        }
        $value = parent::processValue($value, $isRoot);

        if (!$value instanceof Definition || !$value->isAutowired() || $value->isAbstract() || !$value->getClass()) {
            return $value;
        }
        if (!$reflectionClass = $this->container->getReflectionClass($value->getClass(), false)) {
            $this->container->log($this, sprintf('Skipping service "%s": Class or interface "%s" cannot be loaded.', $this->currentId, $value->getClass()));

            return $value;
        }

        $methodCalls = $value->getMethodCalls();

        try {
            $constructor = $this->getConstructor($value, false);
        } catch (RuntimeException $e) {
            throw new AutowiringFailedException($this->currentId, $e->getMessage(), 0, $e);
        }

        if ($constructor) {
            array_unshift($methodCalls, [$constructor, $value->getArguments()]);
        }

<<<<<<< Updated upstream
        $methodCalls = $this->autowireCalls($reflectionClass, $methodCalls);
=======
        $checkAttributes = !$value->hasTag('container.ignore_attributes');
        $this->methodCalls = $this->autowireCalls($reflectionClass, $isRoot, $checkAttributes);
>>>>>>> Stashed changes

        if ($constructor) {
            list(, $arguments) = array_shift($methodCalls);

            if ($arguments !== $value->getArguments()) {
                $value->setArguments($arguments);
            }
        }

        if ($methodCalls !== $value->getMethodCalls()) {
            $value->setMethodCalls($methodCalls);
        }

        return $value;
    }

<<<<<<< Updated upstream
    /**
     * @return array
     */
    private function autowireCalls(\ReflectionClass $reflectionClass, array $methodCalls)
=======
    private function autowireCalls(\ReflectionClass $reflectionClass, bool $isRoot, bool $checkAttributes): array
>>>>>>> Stashed changes
    {
        foreach ($methodCalls as $i => $call) {
            list($method, $arguments) = $call;

            if ($method instanceof \ReflectionFunctionAbstract) {
                $reflectionMethod = $method;
            } else {
                $definition = new Definition($reflectionClass->name);
                try {
                    $reflectionMethod = $this->getReflectionMethod($definition, $method);
                } catch (RuntimeException $e) {
                    if ($definition->getFactory()) {
                        continue;
                    }
                    throw $e;
                }
            }

<<<<<<< Updated upstream
            $arguments = $this->autowireMethod($reflectionMethod, $arguments);

            if ($arguments !== $call[1]) {
                $methodCalls[$i][1] = $arguments;
=======
            $arguments = $this->autowireMethod($reflectionMethod, $arguments, $checkAttributes, $i);

            if ($arguments !== $call[1]) {
                $this->methodCalls[$i][1] = $arguments;
                $patchedIndexes[] = $i;
            }
        }

        // use named arguments to skip complex default values
        foreach ($patchedIndexes as $i) {
            $namedArguments = null;
            $arguments = $this->methodCalls[$i][1];

            foreach ($arguments as $j => $value) {
                if ($namedArguments && !$value instanceof $this->defaultArgument) {
                    unset($arguments[$j]);
                    $arguments[$namedArguments[$j]] = $value;
                }
                if (!$value instanceof $this->defaultArgument) {
                    continue;
                }

                if (\is_array($value->value) ? $value->value : \is_object($value->value)) {
                    unset($arguments[$j]);
                    $namedArguments = $value->names;
                }

                if ($namedArguments) {
                    unset($arguments[$j]);
                } else {
                    $arguments[$j] = $value->value;
                }
>>>>>>> Stashed changes
            }
        }

        return $methodCalls;
    }

    /**
     * Autowires the constructor or a method.
     *
     * @throws AutowiringFailedException
     */
<<<<<<< Updated upstream
    private function autowireMethod(\ReflectionFunctionAbstract $reflectionMethod, array $arguments)
=======
    private function autowireMethod(\ReflectionFunctionAbstract $reflectionMethod, array $arguments, bool $checkAttributes, int $methodIndex): array
>>>>>>> Stashed changes
    {
        $class = $reflectionMethod instanceof \ReflectionMethod ? $reflectionMethod->class : $this->currentId;
        $method = $reflectionMethod->name;
        $parameters = $reflectionMethod->getParameters();
        if (method_exists('ReflectionMethod', 'isVariadic') && $reflectionMethod->isVariadic()) {
            array_pop($parameters);
        }

        foreach ($parameters as $index => $parameter) {
<<<<<<< Updated upstream
=======
            $this->defaultArgument->names[$index] = $parameter->name;

            if (\array_key_exists($parameter->name, $arguments)) {
                $arguments[$index] = $arguments[$parameter->name];
                unset($arguments[$parameter->name]);
            }
>>>>>>> Stashed changes
            if (\array_key_exists($index, $arguments) && '' !== $arguments[$index]) {
                continue;
            }

            $type = ProxyHelper::exportType($parameter, true);
            $target = null;
            $name = Target::parseName($parameter, $target);
            $target = $target ? [$target] : [];

            $getValue = function () use ($type, $parameter, $class, $method, $name, $target) {
                if (!$value = $this->getAutowiredReference($ref = new TypedReference($type, $type, ContainerBuilder::EXCEPTION_ON_INVALID_REFERENCE, $name, $target), false)) {
                    $failureMessage = $this->createTypeNotFoundMessageCallback($ref, sprintf('argument "$%s" of method "%s()"', $parameter->name, $class !== $this->currentId ? $class.'::'.$method : $method));

                    if ($parameter->isDefaultValueAvailable()) {
                        $value = $this->defaultArgument->withValue($parameter);
                    } elseif (!$parameter->allowsNull()) {
                        throw new AutowiringFailedException($this->currentId, $failureMessage);
                    }
                }

                return $value;
            };

            if ($checkAttributes) {
                foreach ($parameter->getAttributes(Autowire::class, \ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                    $attribute = $attribute->newInstance();
                    $invalidBehavior = $parameter->allowsNull() ? ContainerInterface::NULL_ON_INVALID_REFERENCE : ContainerBuilder::EXCEPTION_ON_INVALID_REFERENCE;

                    try {
                        $value = $this->processValue(new TypedReference($type ?: '?', $type ?: 'mixed', $invalidBehavior, $name, [$attribute, ...$target]));
                    } catch (ParameterNotFoundException $e) {
                        if (!$parameter->isDefaultValueAvailable()) {
                            throw new AutowiringFailedException($this->currentId, $e->getMessage(), 0, $e);
                        }
                        $arguments[$index] = clone $this->defaultArgument;
                        $arguments[$index]->value = $parameter->getDefaultValue();

                        continue 2;
                    }

                    if ($attribute instanceof AutowireCallable) {
                        $value = $attribute->buildDefinition($value, $type, $parameter);
                    } elseif ($lazy = $attribute->lazy) {
                        $definition = (new Definition($type))
                            ->setFactory('current')
                            ->setArguments([[$value ??= $getValue()]])
                            ->setLazy(true);

                        if (!\is_array($lazy)) {
                            if (str_contains($type, '|')) {
                                throw new AutowiringFailedException($this->currentId, sprintf('Cannot use #[Autowire] with option "lazy: true" on union types for service "%s"; set the option to the interface(s) that should be proxied instead.', $this->currentId));
                            }
                            $lazy = str_contains($type, '&') ? explode('&', $type) : [];
                        }

                        if ($lazy) {
                            if (!class_exists($type) && !interface_exists($type, false)) {
                                $definition->setClass('object');
                            }
                            foreach ($lazy as $v) {
                                $definition->addTag('proxy', ['interface' => $v]);
                            }
                        }

                        if ($definition->getClass() !== (string) $value || $definition->getTag('proxy')) {
                            $value .= '.'.$this->container->hash([$definition->getClass(), $definition->getTag('proxy')]);
                        }
                        $this->container->setDefinition($value = '.lazy.'.$value, $definition);
                        $value = new Reference($value);
                    }
                    $arguments[$index] = $value;

                    continue 2;
                }

                foreach ($parameter->getAttributes(AutowireDecorated::class) as $attribute) {
                    $arguments[$index] = $this->processValue($attribute->newInstance());

                    continue 2;
                }

                foreach ($parameter->getAttributes(MapDecorated::class) as $attribute) {
                    $arguments[$index] = $this->processValue($attribute->newInstance());

                    continue 2;
                }
            }

            if (!$type) {
                if (isset($arguments[$index])) {
                    continue;
                }

                // no default value? Then fail
                if (!$parameter->isDefaultValueAvailable()) {
                    // For core classes, isDefaultValueAvailable() can
                    // be false when isOptional() returns true. If the
                    // argument *is* optional, allow it to be missing
                    if ($parameter->isOptional()) {
                        continue;
                    }
<<<<<<< Updated upstream
                    $type = ProxyHelper::getTypeHint($reflectionMethod, $parameter, false);
                    $type = $type ? sprintf('is type-hinted "%s"', $type) : 'has no type-hint';
=======
                    $type = ProxyHelper::exportType($parameter);
                    $type = $type ? sprintf('is type-hinted "%s"', preg_replace('/(^|[(|&])\\\\|^\?\\\\?/', '\1', $type)) : 'has no type-hint';
>>>>>>> Stashed changes

                    throw new AutowiringFailedException($this->currentId, sprintf('Cannot autowire service "%s": argument "$%s" of method "%s()" %s, you should configure its value explicitly.', $this->currentId, $parameter->name, $class !== $this->currentId ? $class.'::'.$method : $method, $type));
                }

                // specifically pass the default value
<<<<<<< Updated upstream
                $arguments[$index] = $parameter->getDefaultValue();
=======
                $arguments[$index] = $this->defaultArgument->withValue($parameter);
>>>>>>> Stashed changes

                continue;
            }

<<<<<<< Updated upstream
            if (!$value = $this->getAutowiredReference($ref = new TypedReference($type, $type, !$parameter->isOptional() ? $class : ''), 'for '.sprintf('argument "$%s" of method "%s()"', $parameter->name, $class.'::'.$method))) {
                $failureMessage = $this->createTypeNotFoundMessage($ref, sprintf('argument "$%s" of method "%s()"', $parameter->name, $class !== $this->currentId ? $class.'::'.$method : $method));
=======
            if ($this->decoratedClass && is_a($this->decoratedClass, $type, true)) {
                if ($this->getPreviousValue) {
                    // The inner service is injected only if there is only 1 argument matching the type of the decorated class
                    // across all arguments of all autowired methods.
                    // If a second matching argument is found, the default behavior is restored.

                    $getPreviousValue = $this->getPreviousValue;
                    $this->methodCalls[$this->decoratedMethodIndex][1][$this->decoratedMethodArgumentIndex] = $getPreviousValue();
                    $this->decoratedClass = null; // Prevent further checks
                } else {
                    $arguments[$index] = new TypedReference($this->decoratedId, $this->decoratedClass);
                    $this->getPreviousValue = $getValue;
                    $this->decoratedMethodIndex = $methodIndex;
                    $this->decoratedMethodArgumentIndex = $index;
>>>>>>> Stashed changes

                if ($parameter->isDefaultValueAvailable()) {
                    $value = $parameter->getDefaultValue();
                } elseif (!$parameter->allowsNull()) {
                    throw new AutowiringFailedException($this->currentId, $failureMessage);
                }
                $this->container->log($this, $failureMessage);
            }

            $arguments[$index] = $value;
        }

        if ($parameters && !isset($arguments[++$index])) {
            while (0 <= --$index) {
                $parameter = $parameters[$index];
                if (!$parameter->isDefaultValueAvailable() || $parameter->getDefaultValue() !== $arguments[$index]) {
                    break;
                }
                unset($arguments[$index]);
            }
        }

        // it's possible index 1 was set, then index 0, then 2, etc
        // make sure that we re-order so they're injected as expected
        ksort($arguments, \SORT_NATURAL);

        return $arguments;
    }

    /**
     * @return TypedReference|null A reference to the service matching the given type, if any
     */
<<<<<<< Updated upstream
    private function getAutowiredReference(TypedReference $reference, $deprecationMessage)
=======
    private function getAutowiredReference(TypedReference $reference, bool $filterType): ?TypedReference
>>>>>>> Stashed changes
    {
        $this->lastFailure = null;
        $type = $reference->getType();

        if ($type !== $this->container->normalizeId($reference) || ($this->container->has($type) && !$this->container->findDefinition($type)->isAbstract())) {
            return $reference;
        }

<<<<<<< Updated upstream
        if (null === $this->types) {
            $this->populateAvailableTypes($this->strictMode);
        }

        if (isset($this->definedTypes[$type])) {
            return new TypedReference($this->types[$type], $type);
        }

        if (!$this->strictMode && isset($this->types[$type])) {
            $message = 'Autowiring services based on the types they implement is deprecated since Symfony 3.3 and won\'t be supported in version 4.0.';
            if ($aliasSuggestion = $this->getAliasesSuggestionForType($type = $reference->getType(), $deprecationMessage)) {
                $message .= ' '.$aliasSuggestion;
            } else {
                $message .= sprintf(' You should %s the "%s" service to "%s" instead.', isset($this->types[$this->types[$type]]) ? 'alias' : 'rename (or alias)', $this->types[$type], $type);
            }

            @trigger_error($message, E_USER_DEPRECATED);

            return new TypedReference($this->types[$type], $type);
=======
        if ($filterType && false !== $m = strpbrk($type, '&|')) {
            $types = array_diff(explode($m[0], $type), ['int', 'string', 'array', 'bool', 'float', 'iterable', 'object', 'callable', 'null']);

            sort($types);

            $type = implode($m[0], $types);
        }

        $name = $target = (array_filter($reference->getAttributes(), static fn ($a) => $a instanceof Target)[0] ?? null)?->name;

        if (null !== $name ??= $reference->getName()) {
            if ($this->container->has($alias = $type.' $'.$name) && !$this->container->findDefinition($alias)->isAbstract()) {
                return new TypedReference($alias, $type, $reference->getInvalidBehavior());
            }

            if (null !== ($alias = $this->getCombinedAlias($type, $name)) && !$this->container->findDefinition($alias)->isAbstract()) {
                return new TypedReference($alias, $type, $reference->getInvalidBehavior());
            }

            $parsedName = (new Target($name))->getParsedName();

            if ($this->container->has($alias = $type.' $'.$parsedName) && !$this->container->findDefinition($alias)->isAbstract()) {
                return new TypedReference($alias, $type, $reference->getInvalidBehavior());
            }

            if (null !== ($alias = $this->getCombinedAlias($type, $parsedName)) && !$this->container->findDefinition($alias)->isAbstract()) {
                return new TypedReference($alias, $type, $reference->getInvalidBehavior());
            }

            if (($this->container->has($n = $name) && !$this->container->findDefinition($n)->isAbstract())
                || ($this->container->has($n = $parsedName) && !$this->container->findDefinition($n)->isAbstract())
            ) {
                foreach ($this->container->getAliases() as $id => $alias) {
                    if ($n === (string) $alias && str_starts_with($id, $type.' $')) {
                        return new TypedReference($n, $type, $reference->getInvalidBehavior());
                    }
                }
            }

            if (null !== $target) {
                return null;
            }
>>>>>>> Stashed changes
        }

        if (!$reference->canBeAutoregistered() || isset($this->types[$type]) || isset($this->ambiguousServiceTypes[$type])) {
            return null;
        }

        if (isset($this->autowired[$type])) {
            return $this->autowired[$type] ? new TypedReference($this->autowired[$type], $type) : null;
        }

        if (!$this->strictMode) {
            return $this->createAutowiredDefinition($type);
        }

        if (null !== ($alias = $this->getCombinedAlias($type)) && !$this->container->findDefinition($alias)->isAbstract()) {
            return new TypedReference($alias, $type, $reference->getInvalidBehavior());
        }

        return null;
    }

    /**
     * Populates the list of available types.
     */
<<<<<<< Updated upstream
    private function populateAvailableTypes($onlyAutowiringTypes = false)
    {
        $this->types = [];
        if (!$onlyAutowiringTypes) {
            $this->ambiguousServiceTypes = [];
        }
=======
    private function populateAvailableTypes(ContainerBuilder $container): void
    {
        $this->types = [];
        $this->ambiguousServiceTypes = [];
        $this->autowiringAliases = [];
>>>>>>> Stashed changes

        foreach ($this->container->getDefinitions() as $id => $definition) {
            $this->populateAvailableType($id, $definition, $onlyAutowiringTypes);
        }

        $prev = null;
        foreach ($container->getAliases() as $id => $alias) {
            $this->populateAutowiringAlias($id, $prev);
            $prev = $id;
        }
    }

    /**
     * Populates the list of available types for a given definition.
     *
     * @param string $id
     */
<<<<<<< Updated upstream
    private function populateAvailableType($id, Definition $definition, $onlyAutowiringTypes)
=======
    private function populateAvailableType(ContainerBuilder $container, string $id, Definition $definition): void
>>>>>>> Stashed changes
    {
        // Never use abstract services
        if ($definition->isAbstract()) {
            return;
        }

        foreach ($definition->getAutowiringTypes(false) as $type) {
            $this->definedTypes[$type] = true;
            $this->types[$type] = $id;
            unset($this->ambiguousServiceTypes[$type]);
        }

        if ($onlyAutowiringTypes) {
            return;
        }

        if (preg_match('/^\d+_[^~]++~[._a-zA-Z\d]{7}$/', $id) || $definition->isDeprecated() || !$reflectionClass = $this->container->getReflectionClass($definition->getClass(), false)) {
            return;
        }

        foreach ($reflectionClass->getInterfaces() as $reflectionInterface) {
            $this->set($reflectionInterface->name, $id);
        }

        do {
            $this->set($reflectionClass->name, $id);
        } while ($reflectionClass = $reflectionClass->getParentClass());

        $this->populateAutowiringAlias($id);
    }

    /**
     * Associates a type and a service id if applicable.
     *
     * @param string $type
     * @param string $id
     */
<<<<<<< Updated upstream
    private function set($type, $id)
=======
    private function set(string $type, string $id): void
>>>>>>> Stashed changes
    {
        if (isset($this->definedTypes[$type])) {
            return;
        }

        // is this already a type/class that is known to match multiple services?
        if (isset($this->ambiguousServiceTypes[$type])) {
            $this->ambiguousServiceTypes[$type][] = $id;

            return;
        }

        // check to make sure the type doesn't match multiple services
        if (!isset($this->types[$type]) || $this->types[$type] === $id) {
            $this->types[$type] = $id;

            return;
        }

        // keep an array of all services matching this type
        if (!isset($this->ambiguousServiceTypes[$type])) {
            $this->ambiguousServiceTypes[$type] = [$this->types[$type]];
            unset($this->types[$type]);
        }
        $this->ambiguousServiceTypes[$type][] = $id;
    }

    /**
     * Registers a definition for the type if possible or throws an exception.
     *
     * @param string $type
     *
     * @return TypedReference|null A reference to the registered definition
     */
    private function createAutowiredDefinition($type)
    {
<<<<<<< Updated upstream
        if (!($typeHint = $this->container->getReflectionClass($type, false)) || !$typeHint->isInstantiable()) {
            return null;
=======
        if (!isset($this->typesClone->container)) {
            $this->typesClone->container = new ContainerBuilder($this->container->getParameterBag());
            $this->typesClone->container->setAliases($this->container->getAliases());
            $this->typesClone->container->setDefinitions($this->container->getDefinitions());
            $this->typesClone->container->setResourceTracking(false);
>>>>>>> Stashed changes
        }

        $currentId = $this->currentId;
        $this->currentId = $type;
        $this->autowired[$type] = $argumentId = sprintf('autowired.%s', $type);
        $argumentDefinition = new Definition($type);
        $argumentDefinition->setPublic(false);
        $argumentDefinition->setAutowired(true);

<<<<<<< Updated upstream
        try {
            $originalThrowSetting = $this->throwOnAutowiringException;
            $this->throwOnAutowiringException = true;
            $this->processValue($argumentDefinition, true);
            $this->container->setDefinition($argumentId, $argumentDefinition);
        } catch (AutowiringFailedException $e) {
            $this->autowired[$type] = false;
            $this->lastFailure = $e->getMessage();
            $this->container->log($this, $this->lastFailure);

            return null;
        } finally {
            $this->throwOnAutowiringException = $originalThrowSetting;
            $this->currentId = $currentId;
        }

        @trigger_error(sprintf('Relying on service auto-registration for type "%s" is deprecated since Symfony 3.4 and won\'t be supported in 4.0. Create a service named "%s" instead.', $type, $type), E_USER_DEPRECATED);

        $this->container->log($this, sprintf('Type "%s" has been auto-registered for service "%s".', $type, $this->currentId));

        return new TypedReference($argumentId, $type);
=======
        return (fn () => $this->createTypeNotFoundMessage($reference, $label, $currentId))->bindTo($this->typesClone);
>>>>>>> Stashed changes
    }

    private function createTypeNotFoundMessage(TypedReference $reference, $label)
    {
<<<<<<< Updated upstream
        $trackResources = $this->container->isTrackingResources();
        $this->container->setResourceTracking(false);
        try {
            if ($r = $this->container->getReflectionClass($type = $reference->getType(), false)) {
                $alternatives = $this->createTypeAlternatives($reference);
            }
        } finally {
            $this->container->setResourceTracking($trackResources);
        }

        if (!$r) {
=======
        $type = $reference->getType();

        $i = null;
        $namespace = $type;
        do {
            $namespace = substr($namespace, 0, $i);

            if ($this->container->hasDefinition($namespace) && $tag = $this->container->getDefinition($namespace)->getTag('container.excluded')) {
                return sprintf('Cannot autowire service "%s": %s needs an instance of "%s" but this type has been excluded %s.', $currentId, $label, $type, $tag[0]['source'] ?? 'from autowiring');
            }
        } while (false !== $i = strrpos($namespace, '\\'));

        if (!$r = $this->container->getReflectionClass($type, false)) {
>>>>>>> Stashed changes
            // either $type does not exist or a parent class does not exist
            try {
                if (class_exists(ClassExistenceResource::class)) {
                    $resource = new ClassExistenceResource($type, false);
                    // isFresh() will explode ONLY if a parent class/trait does not exist
                    $resource->isFresh(0);
                    $parentMsg = false;
                } else {
                    $parentMsg = "couldn't be loaded. Either it was not found or it is missing a parent class or a trait";
                }
            } catch (\ReflectionException $e) {
                $parentMsg = sprintf('is missing a parent class (%s)', $e->getMessage());
            }

            $message = sprintf('has type "%s" but this class %s.', $type, $parentMsg ?: 'was not found');
        } else {
<<<<<<< Updated upstream
            $message = $this->container->has($type) ? 'this service is abstract' : 'no such service exists';
            $message = sprintf('references %s "%s" but %s.%s', $r->isInterface() ? 'interface' : 'class', $type, $message, $alternatives);
=======
            $alternatives = $this->createTypeAlternatives($this->container, $reference);

            if (null !== $target = (array_filter($reference->getAttributes(), static fn ($a) => $a instanceof Target)[0] ?? null)) {
                $target = null !== $target->name ? "('{$target->name}')" : '';
                $message = sprintf('has "#[Target%s]" but no such target exists.%s', $target, $alternatives);
            } else {
                $message = $this->container->has($type) ? 'this service is abstract' : 'no such service exists';
                $message = sprintf('references %s "%s" but %s.%s', $r->isInterface() ? 'interface' : 'class', $type, $message, $alternatives);
            }
>>>>>>> Stashed changes

            if ($r->isInterface() && !$alternatives) {
                $message .= ' Did you create a class that implements this interface?';
            }
        }

        $message = sprintf('Cannot autowire service "%s": %s %s', $this->currentId, $label, $message);

        if (null !== $this->lastFailure) {
            $message = $this->lastFailure."\n".$message;
            $this->lastFailure = null;
        }

        return $message;
    }

    private function createTypeAlternatives(TypedReference $reference)
    {
        // try suggesting available aliases first
        if ($message = $this->getAliasesSuggestionForType($type = $reference->getType())) {
            return ' '.$message;
        }
<<<<<<< Updated upstream
        if (null === $this->ambiguousServiceTypes) {
            $this->populateAvailableTypes();
        }

        if (isset($this->ambiguousServiceTypes[$type])) {
=======
        if (!isset($this->ambiguousServiceTypes)) {
            $this->populateAvailableTypes($container);
        }

        $servicesAndAliases = $container->getServiceIds();
        $autowiringAliases = $this->autowiringAliases[$type] ?? [];
        unset($autowiringAliases['']);

        if ($autowiringAliases) {
            return sprintf(' Did you mean to target%s "%s" instead?', 1 < \count($autowiringAliases) ? ' one of' : '', implode('", "', $autowiringAliases));
        }

        if (!$container->has($type) && false !== $key = array_search(strtolower($type), array_map('strtolower', $servicesAndAliases))) {
            return sprintf(' Did you mean "%s"?', $servicesAndAliases[$key]);
        } elseif (isset($this->ambiguousServiceTypes[$type])) {
>>>>>>> Stashed changes
            $message = sprintf('one of these existing services: "%s"', implode('", "', $this->ambiguousServiceTypes[$type]));
        } elseif (isset($this->types[$type])) {
            $message = sprintf('the existing "%s" service', $this->types[$type]);
        } elseif ($reference->getRequiringClass() && !$reference->canBeAutoregistered() && !$this->strictMode) {
            return ' It cannot be auto-registered because it is from a different root namespace.';
        } else {
            return '';
        }

        return sprintf(' You should maybe alias this %s to %s.', class_exists($type, false) ? 'class' : 'interface', $message);
    }

    /**
     * @deprecated since version 3.3, to be removed in 4.0.
     */
    private static function getResourceMetadataForMethod(\ReflectionMethod $method)
    {
        $methodArgumentsMetadata = [];
        foreach ($method->getParameters() as $parameter) {
            try {
                if (method_exists($parameter, 'getType')) {
                    $type = $parameter->getType();
                    if ($type && !$type->isBuiltin()) {
                        $class = new \ReflectionClass(method_exists($type, 'getName') ? $type->getName() : (string) $type);
                    } else {
                        $class = null;
                    }
                } else {
                    $class = $parameter->getClass();
                }
            } catch (\ReflectionException $e) {
                // type-hint is against a non-existent class
                $class = false;
            }

            $isVariadic = method_exists($parameter, 'isVariadic') && $parameter->isVariadic();
            $methodArgumentsMetadata[] = [
                'class' => $class,
                'isOptional' => $parameter->isOptional(),
                'defaultValue' => ($parameter->isOptional() && !$isVariadic) ? $parameter->getDefaultValue() : null,
            ];
        }

        return $methodArgumentsMetadata;
    }

    private function getAliasesSuggestionForType($type, $extraContext = null)
    {
        $aliases = [];
        foreach (class_parents($type) + class_implements($type) as $parent) {
            if ($this->container->has($parent) && !$this->container->findDefinition($parent)->isAbstract()) {
                $aliases[] = $parent;
            }
        }

        $extraContext = $extraContext ? ' '.$extraContext : '';
        if (1 < $len = \count($aliases)) {
            $message = sprintf('Try changing the type-hint%s to one of its parents: ', $extraContext);
            for ($i = 0, --$len; $i < $len; ++$i) {
                $message .= sprintf('%s "%s", ', class_exists($aliases[$i], false) ? 'class' : 'interface', $aliases[$i]);
            }
            $message .= sprintf('or %s "%s".', class_exists($aliases[$i], false) ? 'class' : 'interface', $aliases[$i]);

            return $message;
        }

        if ($aliases) {
            return sprintf('Try changing the type-hint%s to "%s" instead.', $extraContext, $aliases[0]);
        }

        return null;
    }

    private function populateAutowiringAlias(string $id, ?string $target = null): void
    {
        if (!preg_match('/(?(DEFINE)(?<V>[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*+))^((?&V)(?:\\\\(?&V))*+)(?: \$((?&V)))?$/', $id, $m)) {
            return;
        }

        $type = $m[2];
        $name = $m[3] ?? '';

        if (class_exists($type, false) || interface_exists($type, false)) {
            if (null !== $target && str_starts_with($target, '.'.$type.' $')
                && (new Target($target = substr($target, \strlen($type) + 3)))->getParsedName() === $name
            ) {
                $name = $target;
            }

            $this->autowiringAliases[$type][$name] = $name;
        }
    }

    private function getCombinedAlias(string $type, ?string $name = null): ?string
    {
        if (str_contains($type, '&')) {
            $types = explode('&', $type);
        } elseif (str_contains($type, '|')) {
            $types = explode('|', $type);
        } else {
            return null;
        }

        $alias = null;
        $suffix = $name ? ' $'.$name : '';

        foreach ($types as $type) {
            if (!$this->container->hasAlias($type.$suffix)) {
                return null;
            }

            if (null === $alias) {
                $alias = (string) $this->container->getAlias($type.$suffix);
            } elseif ((string) $this->container->getAlias($type.$suffix) !== $alias) {
                return null;
            }
        }

        return $alias;
    }
}
