<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * HelperSet represents a set of helpers to be used with a command.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @implements \IteratorAggregate<string, HelperInterface>
 */
class HelperSet implements \IteratorAggregate
{
    /** @var array<string, HelperInterface> */
    private array $helpers = [];

    /**
     * @param HelperInterface[] $helpers
     */
    public function __construct(array $helpers = [])
    {
        foreach ($helpers as $alias => $helper) {
            $this->set($helper, \is_int($alias) ? null : $alias);
        }
    }

    /**
<<<<<<< Updated upstream
     * Sets a helper.
     *
     * @param HelperInterface $helper The helper instance
     * @param string          $alias  An alias
=======
     * @return void
>>>>>>> Stashed changes
     */
    public function set(HelperInterface $helper, ?string $alias = null)
    {
        $this->helpers[$helper->getName()] = $helper;
        if (null !== $alias) {
            $this->helpers[$alias] = $helper;
        }

        $helper->setHelperSet($this);
    }

    /**
     * Returns true if the helper if defined.
     */
    public function has(string $name): bool
    {
        return isset($this->helpers[$name]);
    }

    /**
     * Gets a helper value.
     *
     * @throws InvalidArgumentException if the helper is not defined
     */
    public function get(string $name): HelperInterface
    {
        if (!$this->has($name)) {
            throw new InvalidArgumentException(sprintf('The helper "%s" is not defined.', $name));
        }

        return $this->helpers[$name];
    }

<<<<<<< Updated upstream
    public function setCommand(Command $command = null)
    {
        $this->command = $command;
    }

    /**
     * Gets the command associated with this helper set.
     *
     * @return Command A Command instance
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @return Helper[]
     */
    public function getIterator()
=======
    public function getIterator(): \Traversable
>>>>>>> Stashed changes
    {
        return new \ArrayIterator($this->helpers);
    }
}
