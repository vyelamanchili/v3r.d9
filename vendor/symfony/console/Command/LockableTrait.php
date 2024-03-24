<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Command;

use Symfony\Component\Console\Exception\LogicException;
<<<<<<< Updated upstream
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Lock\Factory;
use Symfony\Component\Lock\Lock;
=======
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Lock\LockInterface;
>>>>>>> Stashed changes
use Symfony\Component\Lock\Store\FlockStore;
use Symfony\Component\Lock\Store\SemaphoreStore;

/**
 * Basic lock feature for commands.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
trait LockableTrait
{
    private ?LockInterface $lock = null;

    /**
     * Locks a command.
     *
     * @return bool
     */
<<<<<<< Updated upstream
    private function lock($name = null, $blocking = false)
    {
        if (!class_exists(SemaphoreStore::class)) {
            throw new RuntimeException('To enable the locking feature you must install the symfony/lock component.');
=======
    private function lock(?string $name = null, bool $blocking = false): bool
    {
        if (!class_exists(SemaphoreStore::class)) {
            throw new LogicException('To enable the locking feature you must install the symfony/lock component. Try running "composer require symfony/lock".');
>>>>>>> Stashed changes
        }

        if (null !== $this->lock) {
            throw new LogicException('A lock is already in place.');
        }

        if (SemaphoreStore::isSupported($blocking)) {
            $store = new SemaphoreStore();
        } else {
            $store = new FlockStore();
        }

        $this->lock = (new Factory($store))->createLock($name ?: $this->getName());
        if (!$this->lock->acquire($blocking)) {
            $this->lock = null;

            return false;
        }

        return true;
    }

    /**
     * Releases the command lock if there is one.
     */
    private function release(): void
    {
        if ($this->lock) {
            $this->lock->release();
            $this->lock = null;
        }
    }
}
