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

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Overwrites a service but keeps the overridden one.
 *
 * @author Christophe Coevoet <stof@notk.org>
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Diego Saint Esteben <diego@saintesteben.me>
 */
class DecoratorServicePass extends AbstractRecursivePass
{
    protected bool $skipScalars = true;

    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $definitions = new \SplPriorityQueue();
        $order = PHP_INT_MAX;

        foreach ($container->getDefinitions() as $id => $definition) {
            if (!$decorated = $definition->getDecoratedService()) {
                continue;
            }
            $definitions->insert([$id, $definition], [$decorated[2], --$order]);
        }
        $decoratingDefinitions = [];
        $decoratedIds = [];

<<<<<<< Updated upstream
        foreach ($definitions as list($id, $definition)) {
            list($inner, $renamedId) = $definition->getDecoratedService();
=======
        $tagsToKeep = $container->hasParameter('container.behavior_describing_tags')
            ? $container->getParameter('container.behavior_describing_tags')
            : ['proxy', 'container.do_not_inline', 'container.service_locator', 'container.service_subscriber', 'container.service_subscriber.locator'];

        foreach ($definitions as [$id, $definition]) {
            $decoratedService = $definition->getDecoratedService();
            [$inner, $renamedId] = $decoratedService;
            $invalidBehavior = $decoratedService[3] ?? ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE;
>>>>>>> Stashed changes

            $definition->setDecoratedService(null);

            if (!$renamedId) {
                $renamedId = $id.'.inner';
            }
<<<<<<< Updated upstream
=======

            $decoratedIds[$inner] ??= $renamedId;
            $this->currentId = $renamedId;
            $this->processValue($definition);

            $definition->innerServiceId = $renamedId;
            $definition->decorationOnInvalid = $invalidBehavior;
>>>>>>> Stashed changes

            // we create a new alias/service for the service we are replacing
            // to be able to reference it in the new one
            if ($container->hasAlias($inner)) {
                $alias = $container->getAlias($inner);
                $public = $alias->isPublic();
<<<<<<< Updated upstream
                $private = $alias->isPrivate();
                $container->setAlias($renamedId, new Alias($container->normalizeId($alias), false));
            } else {
=======
                $container->setAlias($renamedId, new Alias((string) $alias, false));
                $decoratedDefinition = $container->findDefinition($alias);
            } elseif ($container->hasDefinition($inner)) {
>>>>>>> Stashed changes
                $decoratedDefinition = $container->getDefinition($inner);
                $public = $decoratedDefinition->isPublic();
                $decoratedDefinition->setPublic(false);
                $container->setDefinition($renamedId, $decoratedDefinition);
                $decoratingDefinitions[$inner] = $decoratedDefinition;
<<<<<<< Updated upstream
=======
            } elseif (ContainerInterface::IGNORE_ON_INVALID_REFERENCE === $invalidBehavior) {
                $container->removeDefinition($id);
                continue;
            } elseif (ContainerInterface::NULL_ON_INVALID_REFERENCE === $invalidBehavior) {
                $public = $definition->isPublic();
                $decoratedDefinition = null;
            } else {
                throw new ServiceNotFoundException($inner, $id);
            }

            if ($decoratedDefinition?->isSynthetic()) {
                throw new InvalidArgumentException(sprintf('A synthetic service cannot be decorated: service "%s" cannot decorate "%s".', $id, $inner));
>>>>>>> Stashed changes
            }

            if (isset($decoratingDefinitions[$inner])) {
                $decoratingDefinition = $decoratingDefinitions[$inner];
                $definition->setTags(array_merge($decoratingDefinition->getTags(), $definition->getTags()));
                $autowiringTypes = $decoratingDefinition->getAutowiringTypes(false);
                if ($types = array_merge($autowiringTypes, $definition->getAutowiringTypes(false))) {
                    $definition->setAutowiringTypes($types);
                }
                $decoratingDefinition->setTags([]);
                if ($autowiringTypes) {
                    $decoratingDefinition->setAutowiringTypes([]);
                }
                $decoratingDefinitions[$inner] = $definition;
            }

            $container->setAlias($inner, $id)->setPublic($public);
        }

        foreach ($decoratingDefinitions as $inner => $definition) {
            $definition->addTag('container.decorator', ['id' => $inner, 'inner' => $decoratedIds[$inner]]);
        }
    }

    protected function processValue(mixed $value, bool $isRoot = false): mixed
    {
        if ($value instanceof Reference && '.inner' === (string) $value) {
            return new Reference($this->currentId, $value->getInvalidBehavior());
        }

        return parent::processValue($value, $isRoot);
    }
}
