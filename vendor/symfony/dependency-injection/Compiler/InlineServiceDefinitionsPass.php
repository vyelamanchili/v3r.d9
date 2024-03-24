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
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Inline service definitions where this is possible.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class InlineServiceDefinitionsPass extends AbstractRecursivePass
{
<<<<<<< Updated upstream
    private $cloningIds = [];
    private $inlinedServiceIds = [];
=======
    protected bool $skipScalars = true;

    private ?AnalyzeServiceReferencesPass $analyzingPass;
    private array $cloningIds = [];
    private array $connectedIds = [];
    private array $notInlinedIds = [];
    private array $inlinedIds = [];
    private array $notInlinableIds = [];
    private ?ServiceReferenceGraph $graph = null;

    public function __construct(?AnalyzeServiceReferencesPass $analyzingPass = null)
    {
        $this->analyzingPass = $analyzingPass;
    }
>>>>>>> Stashed changes

    /**
     * @return void
     */
<<<<<<< Updated upstream
    public function setRepeatedPass(RepeatedPass $repeatedPass)
    {
        // no-op for BC
    }

    /**
     * Returns an array of all services inlined by this pass.
     *
     * The key is the inlined service id and its value is the list of services it was inlined into.
     *
     * @deprecated since version 3.4, to be removed in 4.0.
     *
     * @return array
     */
    public function getInlinedServiceIds()
    {
        @trigger_error('Calling InlineServiceDefinitionsPass::getInlinedServiceIds() is deprecated since Symfony 3.4 and will be removed in 4.0.', E_USER_DEPRECATED);
=======
    public function process(ContainerBuilder $container)
    {
        $this->container = $container;
        if ($this->analyzingPass) {
            $analyzedContainer = new ContainerBuilder();
            $analyzedContainer->setAliases($container->getAliases());
            $analyzedContainer->setDefinitions($container->getDefinitions());
            foreach ($container->getExpressionLanguageProviders() as $provider) {
                $analyzedContainer->addExpressionLanguageProvider($provider);
            }
        } else {
            $analyzedContainer = $container;
        }
        try {
            $notInlinableIds = [];
            $remainingInlinedIds = [];
            $this->connectedIds = $this->notInlinedIds = $container->getDefinitions();
            do {
                if ($this->analyzingPass) {
                    $analyzedContainer->setDefinitions(array_intersect_key($analyzedContainer->getDefinitions(), $this->connectedIds));
                    $this->analyzingPass->process($analyzedContainer);
                }
                $this->graph = $analyzedContainer->getCompiler()->getServiceReferenceGraph();
                $notInlinedIds = $this->notInlinedIds;
                $notInlinableIds += $this->notInlinableIds;
                $this->connectedIds = $this->notInlinedIds = $this->inlinedIds = $this->notInlinableIds = [];

                foreach ($analyzedContainer->getDefinitions() as $id => $definition) {
                    if (!$this->graph->hasNode($id)) {
                        continue;
                    }
                    foreach ($this->graph->getNode($id)->getOutEdges() as $edge) {
                        if (isset($notInlinedIds[$edge->getSourceNode()->getId()])) {
                            $this->currentId = $id;
                            $this->processValue($definition, true);
                            break;
                        }
                    }
                }

                foreach ($this->inlinedIds as $id => $isPublicOrNotShared) {
                    if ($isPublicOrNotShared) {
                        $remainingInlinedIds[$id] = $id;
                    } else {
                        $container->removeDefinition($id);
                        $analyzedContainer->removeDefinition($id);
                    }
                }
            } while ($this->inlinedIds && $this->analyzingPass);

            foreach ($remainingInlinedIds as $id) {
                if (isset($notInlinableIds[$id])) {
                    continue;
                }

                $definition = $container->getDefinition($id);
>>>>>>> Stashed changes

        return $this->inlinedServiceIds;
    }

    protected function processValue(mixed $value, bool $isRoot = false): mixed
    {
        if ($value instanceof ArgumentInterface) {
            // Reference found in ArgumentInterface::getValues() are not inlineable
            return $value;
        }

        if ($value instanceof Definition && $this->cloningIds) {
            if ($value->isShared()) {
                return $value;
            }
            $value = clone $value;
        }

        if (!$value instanceof Reference || !$this->container->hasDefinition($id = $this->container->normalizeId($value))) {
            return parent::processValue($value, $isRoot);
        }

        $definition = $this->container->getDefinition($id);

<<<<<<< Updated upstream
        if (!$this->isInlineableDefinition($id, $definition, $this->container->getCompiler()->getServiceReferenceGraph())) {
=======
        if (isset($this->notInlinableIds[$id]) || !$this->isInlineableDefinition($id, $definition)) {
            if ($this->currentId !== $id) {
                $this->notInlinableIds[$id] = true;
            }

>>>>>>> Stashed changes
            return $value;
        }

        $this->container->log($this, sprintf('Inlined service "%s" to "%s".', $id, $this->currentId));
        $this->inlinedServiceIds[$id][] = $this->currentId;

        if ($definition->isShared()) {
            return $definition;
        }

        if (isset($this->cloningIds[$id])) {
            $ids = array_keys($this->cloningIds);
            $ids[] = $id;

            throw new ServiceCircularReferenceException($id, \array_slice($ids, array_search($id, $ids)));
        }

        $this->cloningIds[$id] = true;
        try {
            return $this->processValue($definition);
        } finally {
            unset($this->cloningIds[$id]);
        }
    }

    /**
     * Checks if the definition is inlineable.
     *
     * @return bool If the definition is inlineable
     */
    private function isInlineableDefinition($id, Definition $definition, ServiceReferenceGraph $graph)
    {
        if ($definition->getErrors() || $definition->isDeprecated() || $definition->isLazy() || $definition->isSynthetic()) {
            return false;
        }

        if (!$definition->isShared()) {
            return true;
        }

        if ($definition->isPublic() || $definition->isPrivate()) {
            return false;
        }

        if (!$graph->hasNode($id)) {
            return true;
        }

        if ($this->currentId === $id) {
            return false;
        }

        $ids = [];
        $isReferencedByConstructor = false;
        foreach ($graph->getNode($id)->getInEdges() as $edge) {
            $isReferencedByConstructor = $isReferencedByConstructor || $edge->isReferencedByConstructor();
            if ($edge->isWeak() || $edge->isLazy()) {
                return false;
            }
            $ids[] = $edge->getSourceNode()->getId();
        }

        if (!$ids) {
            return true;
        }

        if (\count(array_unique($ids)) > 1) {
            return false;
        }

        if (\count($ids) > 1 && \is_array($factory = $definition->getFactory()) && ($factory[0] instanceof Reference || $factory[0] instanceof Definition)) {
            return false;
        }

        return $this->container->getDefinition($ids[0])->isShared();
    }
}
