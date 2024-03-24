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

use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is a directed graph of your services.
 *
 * This information can be used by your compiler passes instead of collecting
 * it themselves which improves performance quite a lot.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 *
 * @final since version 3.4
 */
class ServiceReferenceGraph
{
    /**
     * @var ServiceReferenceGraphNode[]
     */
    private array $nodes = [];

    /**
     * Checks if the graph has a specific node.
     *
     * @param string $id Id to check
     *
     * @return bool
     */
    public function hasNode($id)
    {
        return isset($this->nodes[$id]);
    }

    /**
     * Gets a node by identifier.
     *
     * @param string $id The id to retrieve
     *
     * @return ServiceReferenceGraphNode
     *
     * @throws InvalidArgumentException if no node matches the supplied identifier
     */
    public function getNode($id)
    {
        if (!isset($this->nodes[$id])) {
            throw new InvalidArgumentException(sprintf('There is no node with id "%s".', $id));
        }

        return $this->nodes[$id];
    }

    /**
     * Returns all nodes.
     *
     * @return ServiceReferenceGraphNode[]
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * Clears all nodes.
     */
    public function clear(): void
    {
        foreach ($this->nodes as $node) {
            $node->clear();
        }
        $this->nodes = [];
    }

    /**
     * Connects 2 nodes together in the Graph.
     *
     * @param string $sourceId
     * @param mixed  $sourceValue
     * @param string $destId
     * @param mixed  $destValue
     * @param string $reference
     */
<<<<<<< Updated upstream
    public function connect($sourceId, $sourceValue, $destId, $destValue = null, $reference = null/*, bool $lazy = false, bool $weak = false, bool $byConstructor = false*/)
=======
    public function connect(?string $sourceId, mixed $sourceValue, ?string $destId, mixed $destValue = null, ?Reference $reference = null, bool $lazy = false, bool $weak = false, bool $byConstructor = false): void
>>>>>>> Stashed changes
    {
        $lazy = \func_num_args() >= 6 ? func_get_arg(5) : false;
        $weak = \func_num_args() >= 7 ? func_get_arg(6) : false;
        $byConstructor = \func_num_args() >= 8 ? func_get_arg(7) : false;

        if (null === $sourceId || null === $destId) {
            return;
        }

        $sourceNode = $this->createNode($sourceId, $sourceValue);
        $destNode = $this->createNode($destId, $destValue);
        $edge = new ServiceReferenceGraphEdge($sourceNode, $destNode, $reference, $lazy, $weak, $byConstructor);

        $sourceNode->addOutEdge($edge);
        $destNode->addInEdge($edge);
    }

<<<<<<< Updated upstream
    /**
     * Creates a graph node.
     *
     * @param string $id
     * @param mixed  $value
     *
     * @return ServiceReferenceGraphNode
     */
    private function createNode($id, $value)
=======
    private function createNode(string $id, mixed $value): ServiceReferenceGraphNode
>>>>>>> Stashed changes
    {
        if (isset($this->nodes[$id]) && $this->nodes[$id]->getValue() === $value) {
            return $this->nodes[$id];
        }

        return $this->nodes[$id] = new ServiceReferenceGraphNode($id, $value);
    }
}
