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

use Symfony\Component\DependencyInjection\Argument\BoundArgument;
<<<<<<< Updated upstream
=======
use Symfony\Component\DependencyInjection\Argument\ServiceLocatorArgument;
use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\Target;
>>>>>>> Stashed changes
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\TypedReference;
use Symfony\Component\VarExporter\ProxyHelper;

/**
 * @author Guilhem Niot <guilhem.niot@gmail.com>
 */
class ResolveBindingsPass extends AbstractRecursivePass
{
    protected bool $skipScalars = true;

    private array $usedBindings = [];
    private array $unusedBindings = [];
    private array $errorMessages = [];

    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $this->usedBindings = $container->getRemovedBindingIds();

        try {
            parent::process($container);

            foreach ($this->unusedBindings as list($key, $serviceId)) {
                $message = sprintf('Unused binding "%s" in service "%s".', $key, $serviceId);
                if ($this->errorMessages) {
                    $message .= sprintf("\nCould be related to%s:", 1 < \count($this->errorMessages) ? ' one of' : '');
                }
                foreach ($this->errorMessages as $m) {
                    $message .= "\n - ".$m;
                }
                throw new InvalidArgumentException($message);
            }
        } finally {
            $this->usedBindings = [];
            $this->unusedBindings = [];
            $this->errorMessages = [];
        }
    }

    protected function processValue(mixed $value, bool $isRoot = false): mixed
    {
        if ($value instanceof TypedReference && $value->getType() === $this->container->normalizeId($value)) {
            // Already checked
            $bindings = $this->container->getDefinition($this->currentId)->getBindings();

            if (isset($bindings[$value->getType()])) {
                return $this->getBindingValue($bindings[$value->getType()]);
            }

            return parent::processValue($value, $isRoot);
        }

        if (!$value instanceof Definition || !$bindings = $value->getBindings()) {
            return parent::processValue($value, $isRoot);
        }

        foreach ($bindings as $key => $binding) {
            list($bindingValue, $bindingId, $used) = $binding->getValues();
            if ($used) {
                $this->usedBindings[$bindingId] = true;
                unset($this->unusedBindings[$bindingId]);
            } elseif (!isset($this->usedBindings[$bindingId])) {
                $this->unusedBindings[$bindingId] = [$key, $this->currentId];
            }

            if (isset($key[0]) && '$' === $key[0]) {
                continue;
            }

<<<<<<< Updated upstream
            if (null !== $bindingValue && !$bindingValue instanceof Reference && !$bindingValue instanceof Definition) {
                throw new InvalidArgumentException(sprintf('Invalid value for binding key "%s" for service "%s": expected null, an instance of "%s" or an instance of "%s", "%s" given.', $key, $this->currentId, Reference::class, Definition::class, \gettype($bindingValue)));
=======
            if (is_subclass_of($m[1], \UnitEnum::class)) {
                $bindingNames[substr($key, \strlen($m[0]))] = $binding;
                continue;
            }

            if (null !== $bindingValue && !$bindingValue instanceof Reference && !$bindingValue instanceof Definition && !$bindingValue instanceof TaggedIteratorArgument && !$bindingValue instanceof ServiceLocatorArgument) {
                throw new InvalidArgumentException(sprintf('Invalid value for binding key "%s" for service "%s": expected "%s", "%s", "%s", "%s" or null, "%s" given.', $key, $this->currentId, Reference::class, Definition::class, TaggedIteratorArgument::class, ServiceLocatorArgument::class, get_debug_type($bindingValue)));
>>>>>>> Stashed changes
            }
        }

        if ($value->isAbstract()) {
            return parent::processValue($value, $isRoot);
        }

        $calls = $value->getMethodCalls();

        try {
            if ($constructor = $this->getConstructor($value, false)) {
                $calls[] = [$constructor, $value->getArguments()];
            }
        } catch (RuntimeException $e) {
            $this->errorMessages[] = $e->getMessage();
            $this->container->getDefinition($this->currentId)->addError($e->getMessage());

            return parent::processValue($value, $isRoot);
        }

        foreach ($calls as $i => $call) {
            list($method, $arguments) = $call;

            if ($method instanceof \ReflectionFunctionAbstract) {
                $reflectionMethod = $method;
            } else {
                try {
                    $reflectionMethod = $this->getReflectionMethod($value, $method);
                } catch (RuntimeException $e) {
                    if ($value->getFactory()) {
                        continue;
                    }
                    throw $e;
                }
            }

            $names = [];

            foreach ($reflectionMethod->getParameters() as $key => $parameter) {
                $names[$key] = $parameter->name;

                if (\array_key_exists($key, $arguments) && '' !== $arguments[$key]) {
                    continue;
                }
                if (\array_key_exists($parameter->name, $arguments) && '' !== $arguments[$parameter->name]) {
                    continue;
                }
                if (
                    $value->isAutowired()
                    && !$value->hasTag('container.ignore_attributes')
                    && $parameter->getAttributes(Autowire::class, \ReflectionAttribute::IS_INSTANCEOF)
                ) {
                    continue;
                }

                $typeHint = ltrim(ProxyHelper::exportType($parameter) ?? '', '?');

<<<<<<< Updated upstream
                if (\array_key_exists('$'.$parameter->name, $bindings)) {
                    $arguments[$key] = $this->getBindingValue($bindings['$'.$parameter->name]);
=======
                $name = Target::parseName($parameter, parsedName: $parsedName);

                if ($typeHint && (
                    \array_key_exists($k = preg_replace('/(^|[(|&])\\\\/', '\1', $typeHint).' $'.$name, $bindings)
                    || \array_key_exists($k = preg_replace('/(^|[(|&])\\\\/', '\1', $typeHint).' $'.$parsedName, $bindings)
                )) {
                    $arguments[$key] = $this->getBindingValue($bindings[$k]);

                    continue;
                }

                if (\array_key_exists($k = '$'.$name, $bindings) || \array_key_exists($k = '$'.$parsedName, $bindings)) {
                    $arguments[$key] = $this->getBindingValue($bindings[$k]);
>>>>>>> Stashed changes

                    continue;
                }

                $typeHint = ProxyHelper::getTypeHint($reflectionMethod, $parameter, true);

                if (!isset($bindings[$typeHint])) {
                    continue;
                }

<<<<<<< Updated upstream
                $arguments[$key] = $this->getBindingValue($bindings[$typeHint]);
=======
                if (isset($bindingNames[$name]) || isset($bindingNames[$parsedName]) || isset($bindingNames[$parameter->name])) {
                    $bindingKey = array_search($binding, $bindings, true);
                    $argumentType = substr($bindingKey, 0, strpos($bindingKey, ' '));
                    $this->errorMessages[] = sprintf('Did you forget to add the type "%s" to argument "$%s" of method "%s::%s()"?', $argumentType, $parameter->name, $reflectionMethod->class, $reflectionMethod->name);
                }
>>>>>>> Stashed changes
            }

            foreach ($names as $key => $name) {
                if (\array_key_exists($name, $arguments) && (0 === $key || \array_key_exists($key - 1, $arguments))) {
                    $arguments[$key] = $arguments[$name];
                    unset($arguments[$name]);
                }
            }

            if ($arguments !== $call[1]) {
                ksort($arguments, \SORT_NATURAL);
                $calls[$i][1] = $arguments;
            }
        }

        if ($constructor) {
            list(, $arguments) = array_pop($calls);

            if ($arguments !== $value->getArguments()) {
                $value->setArguments($arguments);
            }
        }

        if ($calls !== $value->getMethodCalls()) {
            $value->setMethodCalls($calls);
        }

        return parent::processValue($value, $isRoot);
    }

<<<<<<< Updated upstream
    private function getBindingValue(BoundArgument $binding)
=======
    private function getBindingValue(BoundArgument $binding): mixed
>>>>>>> Stashed changes
    {
        list($bindingValue, $bindingId) = $binding->getValues();

        $this->usedBindings[$bindingId] = true;
        unset($this->unusedBindings[$bindingId]);

        return $bindingValue;
    }
}
