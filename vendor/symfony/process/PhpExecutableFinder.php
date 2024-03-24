<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Process;

/**
 * An executable finder specifically designed for the PHP executable.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class PhpExecutableFinder
{
    private ExecutableFinder $executableFinder;

    public function __construct()
    {
        $this->executableFinder = new ExecutableFinder();
    }

    /**
     * Finds The PHP executable.
     */
    public function find(bool $includeArgs = true): string|false
    {
<<<<<<< Updated upstream
=======
        if ($php = getenv('PHP_BINARY')) {
            if (!is_executable($php)) {
                $command = '\\' === \DIRECTORY_SEPARATOR ? 'where' : 'command -v --';
                if (\function_exists('exec') && $php = strtok(exec($command.' '.escapeshellarg($php)), \PHP_EOL)) {
                    if (!is_executable($php)) {
                        return false;
                    }
                } else {
                    return false;
                }
            }

            if (@is_dir($php)) {
                return false;
            }

            return $php;
        }

>>>>>>> Stashed changes
        $args = $this->findArguments();
        $args = $includeArgs && $args ? ' '.implode(' ', $args) : '';

        // HHVM support
        if (\defined('HHVM_VERSION')) {
            return (getenv('PHP_BINARY') ?: PHP_BINARY).$args;
        }

        // PHP_BINARY return the current sapi executable
<<<<<<< Updated upstream
        if (PHP_BINARY && \in_array(\PHP_SAPI, ['cli', 'cli-server', 'phpdbg'], true)) {
            return PHP_BINARY.$args;
=======
        if (\PHP_BINARY && \in_array(\PHP_SAPI, ['cli', 'cli-server', 'phpdbg'], true)) {
            return \PHP_BINARY.$args;
>>>>>>> Stashed changes
        }

        if ($php = getenv('PHP_PATH')) {
            if (!@is_executable($php)) {
                return false;
            }

            return $php;
        }

        if ($php = getenv('PHP_PEAR_PHP_BIN')) {
            if (@is_executable($php)) {
                return $php;
            }
        }

        if (@is_executable($php = PHP_BINDIR.('\\' === \DIRECTORY_SEPARATOR ? '\\php.exe' : '/php'))) {
            return $php;
        }

        $dirs = [PHP_BINDIR];
        if ('\\' === \DIRECTORY_SEPARATOR) {
            $dirs[] = 'C:\xampp\php\\';
        }

        return $this->executableFinder->find('php', false, $dirs);
    }

    /**
     * Finds the PHP executable arguments.
     */
    public function findArguments(): array
    {
        $arguments = [];

        if (\defined('HHVM_VERSION')) {
            $arguments[] = '--php';
        } elseif ('phpdbg' === \PHP_SAPI) {
            $arguments[] = '-qrr';
        }

        return $arguments;
    }
}
