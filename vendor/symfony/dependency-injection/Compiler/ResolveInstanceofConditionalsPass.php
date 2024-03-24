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

use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * Applies instanceof conditionals to definitions.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class ResolveInstanceofConditionalsPass implements CompilerPassInterface
{
    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        foreach ($container->getAutoconfiguredInstanceof() as $interface => $definition) {
            if ($definition->getArguments()) {
                throw new InvalidArgumentException(sprintf('Autoconfigured instanceof for type "%s" defines arguments but these are not supported and should be removed.', $interface));
            }
            if ($definition->getMethodCalls()) {
                throw new InvalidArgumentException(sprintf('Autoconfigured instanceof for type "%s" defines method calls but these are not supported and should be removed.', $interface));
            }
        }

        foreach ($container->getDefinitions() as $id => $definition) {
<<<<<<< Updated upstream
            if ($definition instanceof ChildDefinition) {
                // don't apply "instanceof" to children: it will be applied to their parent
                continue;
            }
            $container->setDefinition($id, $this->processDefinition($container, $id, $definition));
=======
            $container->setDefinition($id, $this->processDefinition($container, $id, $definition, $tagsToKeep));
        }

        if ($container->hasParameter('container.behavior_describing_tags')) {
            $container->getParameterBag()->remove('container.behavior_describing_tags');
>>>>>>> Stashed changes
        }
    }

    private function processDefinition(ContainerBuilder $container, $id, Definition $definition)
    {
        $instanceofConditionals = $definition->getInstanceofConditionals();
        $autoconfiguredInstanceof = $definition->isAutoconfigured() ? $container->getAutoconfiguredInstanceof() : [];
        if (!$instanceofConditionals && !$autoconfiguredInstanceof) {
            return $definition;
        }

        if (!$class = $container->getParameterBag()->resolveValue($definition->getClass())) {
            return $definition;
        }

        $conditionals = $this->mergeConditionals($autoconfiguredInstanceof, $instanceofConditionals, $container);

        $definition->setInstanceofConditionals([]);
        $shared = null;
        $instanceofTags = [];
        $reflectionClass = null;
        $parent = $definition instanceof ChildDefinition ? $definition->getParent() : null;

        foreach ($conditionals as $interface => $instanceofDefs) {
<<<<<<< Updated upstream
            if ($interface !== $class && !(null === $reflectionClass ? $reflectionClass = ($container->getReflectionClass($class, false) ?: false) : $reflectionClass)) {
=======
            if ($interface !== $class && !($reflectionClass ??= $container->getReflectionClass($class, false) ?: false)) {
>>>>>>> Stashed changes
                continue;
            }

            if ($interface !== $class && !is_subclass_of($class, $interface)) {
                continue;
            }

            foreach ($instanceofDefs as $key => $instanceofDef) {
                /** @var ChildDefinition $instanceofDef */
                $instanceofDef = clone $instanceofDef;
                $instanceofDef->setAbstract(true)->setParent($parent ?: 'abstract.instanceof.'.$id);
                $parent = 'instanceof.'.$interface.'.'.$key.'.'.$id;
                $container->setDefinition($parent, $instanceofDef);
<<<<<<< Updated upstream
                $instanceofTags[] = $instanceofDef->getTags();
=======
                $instanceofTags[] = [$interface, $instanceofDef->getTags()];
                $instanceofBindings = $instanceofDef->getBindings() + $instanceofBindings;

                foreach ($instanceofDef->getMethodCalls() as $methodCall) {
                    $instanceofCalls[] = $methodCall;
                }

>>>>>>> Stashed changes
                $instanceofDef->setTags([]);

                if (isset($instanceofDef->getChanges()['shared'])) {
                    $shared = $instanceofDef->isShared();
                }
            }
        }

        if ($parent) {
            $bindings = $definition->getBindings();
<<<<<<< Updated upstream
            $abstract = $container->setDefinition('abstract.instanceof.'.$id, $definition);

            // cast Definition to ChildDefinition
            $definition->setBindings([]);
            $definition = serialize($definition);
            $definition = substr_replace($definition, '53', 2, 2);
            $definition = substr_replace($definition, 'Child', 44, 0);
=======
            $abstract = $container->setDefinition('.abstract.instanceof.'.$id, $definition);
            $definition->setBindings([]);
            $definition = serialize($definition);

            if (Definition::class === $abstract::class) {
                // cast Definition to ChildDefinition
                $definition = substr_replace($definition, '53', 2, 2);
                $definition = substr_replace($definition, 'Child', 44, 0);
            }
            /** @var ChildDefinition $definition */
>>>>>>> Stashed changes
            $definition = unserialize($definition);
            $definition->setParent($parent);

            if (null !== $shared && !isset($definition->getChanges()['shared'])) {
                $definition->setShared($shared);
            }

            $i = \count($instanceofTags);
            while (0 <= --$i) {
<<<<<<< Updated upstream
                foreach ($instanceofTags[$i] as $k => $v) {
                    foreach ($v as $v) {
                        if ($definition->hasTag($k) && \in_array($v, $definition->getTag($k))) {
                            continue;
=======
                [$interface, $tags] = $instanceofTags[$i];
                foreach ($tags as $k => $v) {
                    if (null === $definition->getDecoratedService() || $interface === $definition->getClass() || \in_array($k, $tagsToKeep, true)) {
                        foreach ($v as $v) {
                            if ($definition->hasTag($k) && \in_array($v, $definition->getTag($k))) {
                                continue;
                            }
                            $definition->addTag($k, $v);
>>>>>>> Stashed changes
                        }
                        $definition->addTag($k, $v);
                    }
                }
            }

            $definition->setBindings($bindings);

            // reset fields with "merge" behavior
            $abstract
                ->setBindings([])
                ->setArguments([])
                ->setMethodCalls([])
                ->setDecoratedService(null)
                ->setTags([])
                ->setAbstract(true);
        }

        return $definition;
    }

    private function mergeConditionals(array $autoconfiguredInstanceof, array $instanceofConditionals, ContainerBuilder $container)
    {
        // make each value an array of ChildDefinition
        $conditionals = array_map(fn ($childDef) => [$childDef], $autoconfiguredInstanceof);

        foreach ($instanceofConditionals as $interface => $instanceofDef) {
            // make sure the interface/class exists (but don't validate automaticInstanceofConditionals)
            if (!$container->getReflectionClass($interface)) {
                throw new RuntimeException(sprintf('"%s" is set as an "instanceof" conditional, but it does not exist.', $interface));
            }

            if (!isset($autoconfiguredInstanceof[$interface])) {
                $conditionals[$interface] = [];
            }

            $conditionals[$interface][] = $instanceofDef;
        }

        return $conditionals;
    }
}
