<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\ParameterBag;

use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class EnvPlaceholderParameterBag extends ParameterBag
{
<<<<<<< Updated upstream
    private $envPlaceholders = [];
    private $providedTypes = [];

    /**
     * {@inheritdoc}
     */
    public function get($name)
=======
    private string $envPlaceholderUniquePrefix;
    private array $envPlaceholders = [];
    private array $unusedEnvPlaceholders = [];
    private array $providedTypes = [];

    private static int $counter = 0;

    public function get(string $name): array|bool|string|int|float|\UnitEnum|null
>>>>>>> Stashed changes
    {
        if (0 === strpos($name, 'env(') && ')' === substr($name, -1) && 'env()' !== $name) {
            $env = substr($name, 4, -1);

            if (isset($this->envPlaceholders[$env])) {
                foreach ($this->envPlaceholders[$env] as $placeholder) {
                    return $placeholder; // return first result
                }
            }
<<<<<<< Updated upstream
            if (!preg_match('/^(?:\w++:)*+\w++$/', $env)) {
                throw new InvalidArgumentException(sprintf('Invalid "%s" name: only "word" characters are allowed.', $name));
            }

            if ($this->has($name)) {
                $defaultValue = parent::get($name);

                if (null !== $defaultValue && !is_scalar($defaultValue)) {
                    throw new RuntimeException(sprintf('The default value of an env() parameter must be scalar or null, but "%s" given to "%s".', \gettype($defaultValue), $name));
                }
            }

            $uniqueName = md5($name.uniqid(mt_rand(), true));
            $placeholder = sprintf('env_%s_%s', str_replace(':', '_', $env), $uniqueName);
=======
            if (isset($this->unusedEnvPlaceholders[$env])) {
                foreach ($this->unusedEnvPlaceholders[$env] as $placeholder) {
                    return $placeholder; // return first result
                }
            }
            if (!preg_match('/^(?:[-.\w\\\\]*+:)*+\w*+$/', $env)) {
                throw new InvalidArgumentException(sprintf('Invalid %s name: only "word" characters are allowed.', $name));
            }
            if ($this->has($name) && null !== ($defaultValue = parent::get($name)) && !\is_string($defaultValue)) {
                throw new RuntimeException(sprintf('The default value of an env() parameter must be a string or null, but "%s" given to "%s".', get_debug_type($defaultValue), $name));
            }

            $uniqueName = hash('xxh128', $name.'_'.self::$counter++);
            $placeholder = sprintf('%s_%s_%s', $this->getEnvPlaceholderUniquePrefix(), strtr($env, ':-.\\', '____'), $uniqueName);
>>>>>>> Stashed changes
            $this->envPlaceholders[$env][$placeholder] = $placeholder;

            return $placeholder;
        }

        return parent::get($name);
    }

    /**
<<<<<<< Updated upstream
=======
     * Gets the common env placeholder prefix for env vars created by this bag.
     */
    public function getEnvPlaceholderUniquePrefix(): string
    {
        if (!isset($this->envPlaceholderUniquePrefix)) {
            $reproducibleEntropy = unserialize(serialize($this->parameters));
            array_walk_recursive($reproducibleEntropy, function (&$v) { $v = null; });
            $this->envPlaceholderUniquePrefix = 'env_'.substr(hash('xxh128', serialize($reproducibleEntropy)), -16);
        }

        return $this->envPlaceholderUniquePrefix;
    }

    /**
>>>>>>> Stashed changes
     * Returns the map of env vars used in the resolved parameter values to their placeholders.
     *
     * @return string[][] A map of env var names to their placeholders
     */
    public function getEnvPlaceholders(): array
    {
        return $this->envPlaceholders;
    }

<<<<<<< Updated upstream
=======
    public function getUnusedEnvPlaceholders(): array
    {
        return $this->unusedEnvPlaceholders;
    }

    /**
     * @return void
     */
    public function clearUnusedEnvPlaceholders()
    {
        $this->unusedEnvPlaceholders = [];
    }

>>>>>>> Stashed changes
    /**
     * Merges the env placeholders of another EnvPlaceholderParameterBag.
     *
     * @return void
     */
    public function mergeEnvPlaceholders(self $bag)
    {
        if ($newPlaceholders = $bag->getEnvPlaceholders()) {
            $this->envPlaceholders += $newPlaceholders;

            foreach ($newPlaceholders as $env => $placeholders) {
                $this->envPlaceholders[$env] += $placeholders;
            }
        }
    }

    /**
     * Maps env prefixes to their corresponding PHP types.
     *
     * @return void
     */
    public function setProvidedTypes(array $providedTypes)
    {
        $this->providedTypes = $providedTypes;
    }

    /**
     * Gets the PHP types corresponding to env() parameter prefixes.
     *
     * @return string[][]
     */
    public function getProvidedTypes(): array
    {
        return $this->providedTypes;
    }

    /**
     * @return void
     */
    public function resolve()
    {
        if ($this->resolved) {
            return;
        }
        parent::resolve();

        foreach ($this->envPlaceholders as $env => $placeholders) {
<<<<<<< Updated upstream
            if (!$this->has($name = "env($env)")) {
                continue;
            }
            if (is_numeric($default = $this->parameters[$name])) {
                $this->parameters[$name] = (string) $default;
            } elseif (null !== $default && !is_scalar($default)) {
                throw new RuntimeException(sprintf('The default value of env parameter "%s" must be scalar or null, "%s" given.', $env, \gettype($default)));
=======
            if ($this->has($name = "env($env)") && null !== ($default = $this->parameters[$name]) && !\is_string($default)) {
                throw new RuntimeException(sprintf('The default value of env parameter "%s" must be a string or null, "%s" given.', $env, get_debug_type($default)));
>>>>>>> Stashed changes
            }
        }
    }
}
