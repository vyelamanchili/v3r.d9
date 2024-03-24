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

use Symfony\Component\DependencyInjection\Argument\ArgumentInterface;
use Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Emulates the invalid behavior if the reference is not found within the
 * container.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class ResolveInvalidReferencesPass implements CompilerPassInterface
{
<<<<<<< Updated upstream
    private $container;
    private $signalingException;
=======
    private ContainerBuilder $container;
    private RuntimeException $signalingException;
    private string $currentId;
>>>>>>> Stashed changes

    /**
     * Process the ContainerBuilder to resolve invalid references.
     *
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $this->container = $container;
        $this->signalingException = new RuntimeException('Invalid reference.');

        try {
            $this->processValue($container->getDefinitions(), 1);
        } finally {
            unset($this->container, $this->signalingException);
        }
    }

    /**
     * Processes arguments to determine invalid references.
     *
     * @throws RuntimeException When an invalid reference is found
     */
<<<<<<< Updated upstream
    private function processValue($value, $rootLevel = 0, $level = 0)
=======
    private function processValue(mixed $value, int $rootLevel = 0, int $level = 0): mixed
>>>>>>> Stashed changes
    {
        if ($value instanceof ServiceClosureArgument) {
            $value->setValues($this->processValue($value->getValues(), 1, 1));
        } elseif ($value instanceof ArgumentInterface) {
            $value->setValues($this->processValue($value->getValues(), $rootLevel, 1 + $level));
        } elseif ($value instanceof Definition) {
            if ($value->isSynthetic() || $value->isAbstract()) {
                return $value;
            }
            $value->setArguments($this->processValue($value->getArguments(), 0));
            $value->setProperties($this->processValue($value->getProperties(), 1));
            $value->setMethodCalls($this->processValue($value->getMethodCalls(), 2));
        } elseif (\is_array($value)) {
            $i = 0;

            foreach ($value as $k => $v) {
                try {
                    if (false !== $i && $k !== $i++) {
                        $i = false;
                    }
                    if ($v !== $processedValue = $this->processValue($v, $rootLevel, 1 + $level)) {
                        $value[$k] = $processedValue;
                    }
                } catch (RuntimeException $e) {
                    if ($rootLevel < $level || ($rootLevel && !$level)) {
                        unset($value[$k]);
                    } elseif ($rootLevel) {
                        throw $e;
                    } else {
                        $value[$k] = null;
                    }
                }
            }

            // Ensure numerically indexed arguments have sequential numeric keys.
            if (false !== $i) {
                $value = array_values($value);
            }
        } elseif ($value instanceof Reference) {
<<<<<<< Updated upstream
            if ($this->container->has($value)) {
=======
            if ($this->container->hasDefinition($id = (string) $value) ? !$this->container->getDefinition($id)->hasTag('container.excluded') : $this->container->hasAlias($id)) {
>>>>>>> Stashed changes
                return $value;
            }
            $invalidBehavior = $value->getInvalidBehavior();

            // resolve invalid behavior
            if (ContainerInterface::NULL_ON_INVALID_REFERENCE === $invalidBehavior) {
                $value = null;
            } elseif (ContainerInterface::IGNORE_ON_INVALID_REFERENCE === $invalidBehavior) {
                if (0 < $level || $rootLevel) {
                    throw $this->signalingException;
                }
                $value = null;
            }
        }

        return $value;
    }
}
