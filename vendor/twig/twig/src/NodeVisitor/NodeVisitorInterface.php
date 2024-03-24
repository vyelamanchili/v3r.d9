<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\NodeVisitor;

use Twig\Environment;

/**
 * Interface for node visitor classes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface NodeVisitorInterface
{
    /**
     * Called before child nodes are visited.
     *
     * @return \Twig_NodeInterface The modified node
     */
<<<<<<< Updated upstream
    public function enterNode(\Twig_NodeInterface $node, Environment $env);
=======
    public function enterNode(Node $node, Environment $env): Node;
>>>>>>> Stashed changes

    /**
     * Called after child nodes are visited.
     *
     * @return \Twig_NodeInterface|false|null The modified node or null if the node must be removed
     */
<<<<<<< Updated upstream
    public function leaveNode(\Twig_NodeInterface $node, Environment $env);
=======
    public function leaveNode(Node $node, Environment $env): ?Node;
>>>>>>> Stashed changes

    /**
     * Returns the priority for this visitor.
     *
     * Priority should be between -10 and 10 (0 is the default).
     *
     * @return int The priority level
     */
    public function getPriority();
}
