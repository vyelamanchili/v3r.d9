<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\Argument\AbstractArgument;
use Symfony\Component\DependencyInjection\Argument\BoundArgument;
use Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser as YamlParser;
use Symfony\Component\Yaml\Tag\TaggedValue;
use Symfony\Component\Yaml\Yaml;

/**
 * YamlFileLoader loads YAML files service definitions.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class YamlFileLoader extends FileLoader
{
    private static $serviceKeywords = [
        'alias' => 'alias',
        'parent' => 'parent',
        'class' => 'class',
        'shared' => 'shared',
        'synthetic' => 'synthetic',
        'lazy' => 'lazy',
        'public' => 'public',
        'abstract' => 'abstract',
        'deprecated' => 'deprecated',
        'factory' => 'factory',
        'file' => 'file',
        'arguments' => 'arguments',
        'properties' => 'properties',
        'configurator' => 'configurator',
        'calls' => 'calls',
        'tags' => 'tags',
        'decorates' => 'decorates',
        'decoration_inner_name' => 'decoration_inner_name',
        'decoration_priority' => 'decoration_priority',
        'autowire' => 'autowire',
        'autowiring_types' => 'autowiring_types',
        'autoconfigure' => 'autoconfigure',
        'bind' => 'bind',
        'constructor' => 'constructor',
    ];

    private static $prototypeKeywords = [
        'resource' => 'resource',
        'namespace' => 'namespace',
        'exclude' => 'exclude',
        'parent' => 'parent',
        'shared' => 'shared',
        'lazy' => 'lazy',
        'public' => 'public',
        'abstract' => 'abstract',
        'deprecated' => 'deprecated',
        'factory' => 'factory',
        'arguments' => 'arguments',
        'properties' => 'properties',
        'configurator' => 'configurator',
        'calls' => 'calls',
        'tags' => 'tags',
        'autowire' => 'autowire',
        'autoconfigure' => 'autoconfigure',
        'bind' => 'bind',
        'constructor' => 'constructor',
    ];

    private static $instanceofKeywords = [
        'shared' => 'shared',
        'lazy' => 'lazy',
        'public' => 'public',
        'properties' => 'properties',
        'configurator' => 'configurator',
        'calls' => 'calls',
        'tags' => 'tags',
        'autowire' => 'autowire',
<<<<<<< Updated upstream
=======
        'bind' => 'bind',
        'constructor' => 'constructor',
>>>>>>> Stashed changes
    ];

    private static $defaultsKeywords = [
        'public' => 'public',
        'tags' => 'tags',
        'autowire' => 'autowire',
        'autoconfigure' => 'autoconfigure',
        'bind' => 'bind',
    ];

    private YamlParser $yamlParser;

    private int $anonymousServicesCount;
    private string $anonymousServicesSuffix;

<<<<<<< Updated upstream
    /**
     * {@inheritdoc}
     */
    public function load($resource, $type = null)
=======
    protected $autoRegisterAliasesForSinglyImplementedInterfaces = false;

    public function load(mixed $resource, ?string $type = null): mixed
>>>>>>> Stashed changes
    {
        $path = $this->locator->locate($resource);

        $content = $this->loadFile($path);

        $this->container->fileExists($path);

        // empty file
        if (null === $content) {
            return null;
        }

        $this->loadContent($content, $path);

        // per-env configuration
        if ($this->env && isset($content['when@'.$this->env])) {
            if (!\is_array($content['when@'.$this->env])) {
                throw new InvalidArgumentException(sprintf('The "when@%s" key should contain an array in "%s". Check your YAML syntax.', $this->env, $path));
            }

            $env = $this->env;
            $this->env = null;
            try {
                $this->loadContent($content['when@'.$env], $path);
            } finally {
                $this->env = $env;
            }
        }

        return null;
    }

    private function loadContent(array $content, string $path): void
    {
        // imports
        $this->parseImports($content, $path);

        // parameters
        if (isset($content['parameters'])) {
            if (!\is_array($content['parameters'])) {
                throw new InvalidArgumentException(sprintf('The "parameters" key should contain an array in "%s". Check your YAML syntax.', $path));
            }

            foreach ($content['parameters'] as $key => $value) {
                $this->container->setParameter($key, $this->resolveServices($value, $path, true));
            }
        }

        // extensions
        $this->loadFromExtensions($content);

        // services
        $this->anonymousServicesCount = 0;
        $this->anonymousServicesSuffix = '~'.ContainerBuilder::hash($path);
        $this->setCurrentDir(\dirname($path));
        try {
            $this->parseDefinitions($content, $path);
        } finally {
            $this->instanceof = [];
        }
    }

    public function supports(mixed $resource, ?string $type = null): bool
    {
        if (!\is_string($resource)) {
            return false;
        }

        if (null === $type && \in_array(pathinfo($resource, PATHINFO_EXTENSION), ['yaml', 'yml'], true)) {
            return true;
        }

        return \in_array($type, ['yaml', 'yml'], true);
    }

<<<<<<< Updated upstream
    /**
     * Parses all imports.
     *
     * @param string $file
     */
    private function parseImports(array $content, $file)
=======
    private function parseImports(array $content, string $file): void
>>>>>>> Stashed changes
    {
        if (!isset($content['imports'])) {
            return;
        }

        if (!\is_array($content['imports'])) {
            throw new InvalidArgumentException(sprintf('The "imports" key should contain an array in "%s". Check your YAML syntax.', $file));
        }

        $defaultDirectory = \dirname($file);
        foreach ($content['imports'] as $import) {
            if (!\is_array($import)) {
                $import = ['resource' => $import];
            }
            if (!isset($import['resource'])) {
                throw new InvalidArgumentException(sprintf('An import should provide a resource in "%s". Check your YAML syntax.', $file));
            }

            $this->setCurrentDir($defaultDirectory);
            $this->import($import['resource'], isset($import['type']) ? $import['type'] : null, isset($import['ignore_errors']) ? (bool) $import['ignore_errors'] : false, $file);
        }
    }

<<<<<<< Updated upstream
    /**
     * Parses definitions.
     *
     * @param string $file
     */
    private function parseDefinitions(array $content, $file)
=======
    private function parseDefinitions(array $content, string $file, bool $trackBindings = true): void
>>>>>>> Stashed changes
    {
        if (!isset($content['services'])) {
            return;
        }

        if (!\is_array($content['services'])) {
            throw new InvalidArgumentException(sprintf('The "services" key should contain an array in "%s". Check your YAML syntax.', $file));
        }

        if (\array_key_exists('_instanceof', $content['services'])) {
            $instanceof = $content['services']['_instanceof'];
            unset($content['services']['_instanceof']);

            if (!\is_array($instanceof)) {
                throw new InvalidArgumentException(sprintf('Service "_instanceof" key must be an array, "%s" given in "%s".', get_debug_type($instanceof), $file));
            }
            $this->instanceof = [];
            $this->isLoadingInstanceof = true;
            foreach ($instanceof as $id => $service) {
                if (!$service || !\is_array($service)) {
                    throw new InvalidArgumentException(sprintf('Type definition "%s" must be a non-empty array within "_instanceof" in "%s". Check your YAML syntax.', $id, $file));
                }
                if (\is_string($service) && 0 === strpos($service, '@')) {
                    throw new InvalidArgumentException(sprintf('Type definition "%s" cannot be an alias within "_instanceof" in "%s". Check your YAML syntax.', $id, $file));
                }
                $this->parseDefinition($id, $service, $file, [], false, $trackBindings);
            }
        }

        $this->isLoadingInstanceof = false;
        $defaults = $this->parseDefaults($content, $file);
        foreach ($content['services'] as $id => $service) {
            $this->parseDefinition($id, $service, $file, $defaults, false, $trackBindings);
        }
    }

    /**
     * @param string $file
     *
     * @return array
     *
     * @throws InvalidArgumentException
     */
    private function parseDefaults(array &$content, $file)
    {
        if (!\array_key_exists('_defaults', $content['services'])) {
            return [];
        }
        $defaults = $content['services']['_defaults'];
        unset($content['services']['_defaults']);

        if (!\is_array($defaults)) {
            throw new InvalidArgumentException(sprintf('Service "_defaults" key must be an array, "%s" given in "%s".', get_debug_type($defaults), $file));
        }

        foreach ($defaults as $key => $default) {
            if (!isset(self::$defaultsKeywords[$key])) {
                throw new InvalidArgumentException(sprintf('The configuration key "%s" cannot be used to define a default value in "%s". Allowed keys are "%s".', $key, $file, implode('", "', self::$defaultsKeywords)));
            }
        }

        if (isset($defaults['tags'])) {
            if (!\is_array($tags = $defaults['tags'])) {
                throw new InvalidArgumentException(sprintf('Parameter "tags" in "_defaults" must be an array in "%s". Check your YAML syntax.', $file));
            }

            foreach ($tags as $tag) {
                if (!\is_array($tag)) {
                    $tag = ['name' => $tag];
                }

                if (1 === \count($tag) && \is_array(current($tag))) {
                    $name = key($tag);
                    $tag = current($tag);
                } else {
                    if (!isset($tag['name'])) {
                        throw new InvalidArgumentException(sprintf('A "tags" entry in "_defaults" is missing a "name" key in "%s".', $file));
                    }
                    $name = $tag['name'];
                    unset($tag['name']);
                }

                if (!\is_string($name) || '' === $name) {
                    throw new InvalidArgumentException(sprintf('The tag name in "_defaults" must be a non-empty string in "%s".', $file));
                }

<<<<<<< Updated upstream
                foreach ($tag as $attribute => $value) {
                    if (!is_scalar($value) && null !== $value) {
                        throw new InvalidArgumentException(sprintf('Tag "%s", attribute "%s" in "_defaults" must be of a scalar-type in "%s". Check your YAML syntax.', $name, $attribute, $file));
                    }
                }
=======
                $this->validateAttributes(sprintf('Tag "%s", attribute "%s" in "_defaults" must be of a scalar-type in "%s". Check your YAML syntax.', $name, '%s', $file), $tag);
>>>>>>> Stashed changes
            }
        }

        if (isset($defaults['bind'])) {
            if (!\is_array($defaults['bind'])) {
                throw new InvalidArgumentException(sprintf('Parameter "bind" in "_defaults" must be an array in "%s". Check your YAML syntax.', $file));
            }

            $defaults['bind'] = array_map(function ($v) { return new BoundArgument($v); }, $this->resolveServices($defaults['bind'], $file));
        }

        return $defaults;
    }

    /**
     * @return bool
     */
    private function isUsingShortSyntax(array $service)
    {
        foreach ($service as $key => $value) {
            if (\is_string($key) && ('' === $key || '$' !== $key[0])) {
                return false;
            }
        }

        return true;
    }

    /**
<<<<<<< Updated upstream
     * Parses a definition.
     *
     * @param string       $id
     * @param array|string $service
     * @param string       $file
     *
     * @throws InvalidArgumentException When tags are invalid
     */
    private function parseDefinition($id, $service, $file, array $defaults)
=======
     * @throws InvalidArgumentException When tags are invalid
     */
    private function parseDefinition(string $id, array|string|null $service, string $file, array $defaults, bool $return = false, bool $trackBindings = true): Definition|Alias|null
>>>>>>> Stashed changes
    {
        if (preg_match('/^_[a-zA-Z0-9_]*$/', $id)) {
            @trigger_error(sprintf('Service names that start with an underscore are deprecated since Symfony 3.3 and will be reserved in 4.0. Rename the "%s" service or define it in XML instead.', $id), E_USER_DEPRECATED);
        }
<<<<<<< Updated upstream
        if (\is_string($service) && 0 === strpos($service, '@')) {
            $this->container->setAlias($id, $alias = new Alias(substr($service, 1)));
=======

        if (\is_string($service) && str_starts_with($service, '@')) {
            $alias = new Alias(substr($service, 1));

>>>>>>> Stashed changes
            if (isset($defaults['public'])) {
                $alias->setPublic($defaults['public']);
            }

            return $return ? $alias : $this->container->setAlias($id, $alias);
        }

        if (\is_array($service) && $this->isUsingShortSyntax($service)) {
            $service = ['arguments' => $service];
        }

        if (!\is_array($service ??= [])) {
            throw new InvalidArgumentException(sprintf('A service definition must be an array or a string starting with "@" but "%s" found for service "%s" in "%s". Check your YAML syntax.', get_debug_type($service), $id, $file));
        }

        if (isset($service['stack'])) {
            if (!\is_array($service['stack'])) {
                throw new InvalidArgumentException(sprintf('A stack must be an array of definitions, "%s" given for service "%s" in "%s". Check your YAML syntax.', get_debug_type($service), $id, $file));
            }

            $stack = [];

            foreach ($service['stack'] as $k => $frame) {
                if (\is_array($frame) && 1 === \count($frame) && !isset(self::SERVICE_KEYWORDS[key($frame)])) {
                    $frame = [
                        'class' => key($frame),
                        'arguments' => current($frame),
                    ];
                }

                if (\is_array($frame) && isset($frame['stack'])) {
                    throw new InvalidArgumentException(sprintf('Service stack "%s" cannot contain another stack in "%s".', $id, $file));
                }

                $definition = $this->parseDefinition($id.'" at index "'.$k, $frame, $file, $defaults, true);

                if ($definition instanceof Definition) {
                    $definition->setInstanceofConditionals($this->instanceof);
                }

                $stack[$k] = $definition;
            }

            if ($diff = array_diff(array_keys($service), ['stack', 'public', 'deprecated'])) {
                throw new InvalidArgumentException(sprintf('Invalid attribute "%s"; supported ones are "public" and "deprecated" for service "%s" in "%s". Check your YAML syntax.', implode('", "', $diff), $id, $file));
            }

            $service = [
                'parent' => '',
                'arguments' => $stack,
                'tags' => ['container.stack'],
                'public' => $service['public'] ?? null,
                'deprecated' => $service['deprecated'] ?? null,
            ];
        }

        $definition = isset($service[0]) && $service[0] instanceof Definition ? array_shift($service) : null;
        $return = null === $definition ? $return : true;

        if (isset($service['from_callable'])) {
            foreach (['alias', 'parent', 'synthetic', 'factory', 'file', 'arguments', 'properties', 'configurator', 'calls'] as $key) {
                if (isset($service['factory'])) {
                    throw new InvalidArgumentException(sprintf('The configuration key "%s" is unsupported for the service "%s" when using "from_callable" in "%s".', $key, $id, $file));
                }
            }

            if ('Closure' !== $service['class'] ??= 'Closure') {
                $service['lazy'] = true;
            }

            $service['factory'] = ['Closure', 'fromCallable'];
            $service['arguments'] = [$service['from_callable']];
            unset($service['from_callable']);
        }

        $this->checkDefinition($id, $service, $file);

        if (isset($service['alias'])) {
            $alias = new Alias($service['alias']);

            if (isset($service['public'])) {
                $alias->setPublic($service['public']);
            } elseif (isset($defaults['public'])) {
                $alias->setPublic($defaults['public']);
            }

            foreach ($service as $key => $value) {
<<<<<<< Updated upstream
                if (!\in_array($key, ['alias', 'public'])) {
                    @trigger_error(sprintf('The configuration key "%s" is unsupported for the service "%s" which is defined as an alias in "%s". Allowed configuration keys for service aliases are "alias" and "public". The YamlFileLoader will raise an exception in Symfony 4.0, instead of silently ignoring unsupported attributes.', $key, $id, $file), E_USER_DEPRECATED);
=======
                if (!\in_array($key, ['alias', 'public', 'deprecated'])) {
                    throw new InvalidArgumentException(sprintf('The configuration key "%s" is unsupported for the service "%s" which is defined as an alias in "%s". Allowed configuration keys for service aliases are "alias", "public" and "deprecated".', $key, $id, $file));
                }

                if ('deprecated' === $key) {
                    $deprecation = \is_array($value) ? $value : ['message' => $value];

                    if (!isset($deprecation['package'])) {
                        throw new InvalidArgumentException(sprintf('Missing attribute "package" of the "deprecated" option in "%s".', $file));
                    }

                    if (!isset($deprecation['version'])) {
                        throw new InvalidArgumentException(sprintf('Missing attribute "version" of the "deprecated" option in "%s".', $file));
                    }

                    $alias->setDeprecated($deprecation['package'] ?? '', $deprecation['version'] ?? '', $deprecation['message'] ?? '');
>>>>>>> Stashed changes
                }
            }

            return $return ? $alias : $this->container->setAlias($id, $alias);
        }

        if (null !== $definition) {
            // no-op
        } elseif ($this->isLoadingInstanceof) {
            $definition = new ChildDefinition('');
        } elseif (isset($service['parent'])) {
<<<<<<< Updated upstream
            if (!empty($this->instanceof)) {
                throw new InvalidArgumentException(sprintf('The service "%s" cannot use the "parent" option in the same file where "_instanceof" configuration is defined as using both is not supported. Move your child definitions to a separate file.', $id));
            }

            foreach ($defaults as $k => $v) {
                if ('tags' === $k) {
                    // since tags are never inherited from parents, there is no confusion
                    // thus we can safely add them as defaults to ChildDefinition
                    continue;
                }
                if ('bind' === $k) {
                    throw new InvalidArgumentException(sprintf('Attribute "bind" on service "%s" cannot be inherited from "_defaults" when a "parent" is set. Move your child definitions to a separate file.', $id));
                }
                if (!isset($service[$k])) {
                    throw new InvalidArgumentException(sprintf('Attribute "%s" on service "%s" cannot be inherited from "_defaults" when a "parent" is set. Move your child definitions to a separate file or define this attribute explicitly.', $k, $id));
                }
=======
            if ('' !== $service['parent'] && '@' === $service['parent'][0]) {
                throw new InvalidArgumentException(sprintf('The value of the "parent" option for the "%s" service must be the id of the service without the "@" prefix (replace "%s" with "%s").', $id, $service['parent'], substr($service['parent'], 1)));
>>>>>>> Stashed changes
            }

            $definition = new ChildDefinition($service['parent']);
        } else {
            $definition = new Definition();
        }

        if (isset($defaults['public'])) {
            $definition->setPublic($defaults['public']);
        }
        if (isset($defaults['autowire'])) {
            $definition->setAutowired($defaults['autowire']);
        }
        if (isset($defaults['autoconfigure'])) {
            $definition->setAutoconfigured($defaults['autoconfigure']);
        }

        $definition->setChanges([]);

        if (isset($service['class'])) {
            $definition->setClass($service['class']);
        }

        if (isset($service['shared'])) {
            $definition->setShared($service['shared']);
        }

        if (isset($service['synthetic'])) {
            $definition->setSynthetic($service['synthetic']);
        }

        if (isset($service['lazy'])) {
            $definition->setLazy($service['lazy']);
        }

        if (isset($service['public'])) {
            $definition->setPublic($service['public']);
        }

        if (isset($service['abstract'])) {
            $definition->setAbstract($service['abstract']);
        }

        if (isset($service['deprecated'])) {
            $deprecation = \is_array($service['deprecated']) ? $service['deprecated'] : ['message' => $service['deprecated']];

            if (!isset($deprecation['package'])) {
                throw new InvalidArgumentException(sprintf('Missing attribute "package" of the "deprecated" option in "%s".', $file));
            }

            if (!isset($deprecation['version'])) {
                throw new InvalidArgumentException(sprintf('Missing attribute "version" of the "deprecated" option in "%s".', $file));
            }

            $definition->setDeprecated($deprecation['package'] ?? '', $deprecation['version'] ?? '', $deprecation['message'] ?? '');
        }

        if (isset($service['factory'])) {
            $definition->setFactory($this->parseCallable($service['factory'], 'factory', $id, $file));
        }

        if (isset($service['constructor'])) {
            if (null !== $definition->getFactory()) {
                throw new LogicException(sprintf('The "%s" service cannot declare a factory as well as a constructor.', $id));
            }

            $definition->setFactory([null, $service['constructor']]);
        }

        if (isset($service['file'])) {
            $definition->setFile($service['file']);
        }

        if (isset($service['arguments'])) {
            $definition->setArguments($this->resolveServices($service['arguments'], $file));
        }

        if (isset($service['properties'])) {
            $definition->setProperties($this->resolveServices($service['properties'], $file));
        }

        if (isset($service['configurator'])) {
            $definition->setConfigurator($this->parseCallable($service['configurator'], 'configurator', $id, $file));
        }

        if (isset($service['calls'])) {
            if (!\is_array($service['calls'])) {
                throw new InvalidArgumentException(sprintf('Parameter "calls" must be an array for service "%s" in "%s". Check your YAML syntax.', $id, $file));
            }

<<<<<<< Updated upstream
            foreach ($service['calls'] as $call) {
                if (isset($call['method'])) {
=======
            foreach ($service['calls'] as $k => $call) {
                if (!\is_array($call) && (!\is_string($k) || !$call instanceof TaggedValue)) {
                    throw new InvalidArgumentException(sprintf('Invalid method call for service "%s": expected map or array, "%s" given in "%s".', $id, $call instanceof TaggedValue ? '!'.$call->getTag() : get_debug_type($call), $file));
                }

                if (\is_string($k)) {
                    throw new InvalidArgumentException(sprintf('Invalid method call for service "%s", did you forgot a leading dash before "%s: ..." in "%s"?', $id, $k, $file));
                }

                if (isset($call['method']) && \is_string($call['method'])) {
>>>>>>> Stashed changes
                    $method = $call['method'];
                    $args = isset($call['arguments']) ? $this->resolveServices($call['arguments'], $file) : [];
                } else {
                    $method = $call[0];
                    $args = isset($call[1]) ? $this->resolveServices($call[1], $file) : [];
                }

                if (!\is_array($args)) {
                    throw new InvalidArgumentException(sprintf('The second parameter for function call "%s" must be an array of its arguments for service "%s" in "%s". Check your YAML syntax.', $method, $id, $file));
                }
                $definition->addMethodCall($method, $args);
            }
        }

        $tags = isset($service['tags']) ? $service['tags'] : [];
        if (!\is_array($tags)) {
            throw new InvalidArgumentException(sprintf('Parameter "tags" must be an array for service "%s" in "%s". Check your YAML syntax.', $id, $file));
        }

        if (isset($defaults['tags'])) {
            $tags = array_merge($tags, $defaults['tags']);
        }

        foreach ($tags as $tag) {
            if (!\is_array($tag)) {
                $tag = ['name' => $tag];
            }

            if (1 === \count($tag) && \is_array(current($tag))) {
                $name = key($tag);
                $tag = current($tag);
            } else {
                if (!isset($tag['name'])) {
                    throw new InvalidArgumentException(sprintf('A "tags" entry is missing a "name" key for service "%s" in "%s".', $id, $file));
                }
                $name = $tag['name'];
                unset($tag['name']);
            }

            if (!\is_string($name) || '' === $name) {
                throw new InvalidArgumentException(sprintf('The tag name for service "%s" in "%s" must be a non-empty string.', $id, $file));
            }

<<<<<<< Updated upstream
            foreach ($tag as $attribute => $value) {
                if (!is_scalar($value) && null !== $value) {
                    throw new InvalidArgumentException(sprintf('A "tags" attribute must be of a scalar-type for service "%s", tag "%s", attribute "%s" in "%s". Check your YAML syntax.', $id, $name, $attribute, $file));
                }
            }
=======
            $this->validateAttributes(sprintf('A "tags" attribute must be of a scalar-type for service "%s", tag "%s", attribute "%s" in "%s". Check your YAML syntax.', $id, $name, '%s', $file), $tag);
>>>>>>> Stashed changes

            $definition->addTag($name, $tag);
        }

        if (isset($service['decorates'])) {
            if ('' !== $service['decorates'] && '@' === $service['decorates'][0]) {
                throw new InvalidArgumentException(sprintf('The value of the "decorates" option for the "%s" service must be the id of the service without the "@" prefix (replace "%s" with "%s").', $id, $service['decorates'], substr($service['decorates'], 1)));
            }

            $renameId = isset($service['decoration_inner_name']) ? $service['decoration_inner_name'] : null;
            $priority = isset($service['decoration_priority']) ? $service['decoration_priority'] : 0;
            $definition->setDecoratedService($service['decorates'], $renameId, $priority);
        }

        if (isset($service['autowire'])) {
            $definition->setAutowired($service['autowire']);
        }

        if (isset($service['autowiring_types'])) {
            if (\is_string($service['autowiring_types'])) {
                $definition->addAutowiringType($service['autowiring_types']);
            } else {
                if (!\is_array($service['autowiring_types'])) {
                    throw new InvalidArgumentException(sprintf('Parameter "autowiring_types" must be a string or an array for service "%s" in "%s". Check your YAML syntax.', $id, $file));
                }

                foreach ($service['autowiring_types'] as $autowiringType) {
                    if (!\is_string($autowiringType)) {
                        throw new InvalidArgumentException(sprintf('A "autowiring_types" attribute must be of type string for service "%s" in "%s". Check your YAML syntax.', $id, $file));
                    }

                    $definition->addAutowiringType($autowiringType);
                }
            }
        }

        if (isset($defaults['bind']) || isset($service['bind'])) {
            // deep clone, to avoid multiple process of the same instance in the passes
            $bindings = $definition->getBindings();
            $bindings += isset($defaults['bind']) ? unserialize(serialize($defaults['bind'])) : [];

            if (isset($service['bind'])) {
                if (!\is_array($service['bind'])) {
                    throw new InvalidArgumentException(sprintf('Parameter "bind" must be an array for service "%s" in "%s". Check your YAML syntax.', $id, $file));
                }

                $bindings = array_merge($bindings, $this->resolveServices($service['bind'], $file));
<<<<<<< Updated upstream
=======
                $bindingType = $this->isLoadingInstanceof ? BoundArgument::INSTANCEOF_BINDING : BoundArgument::SERVICE_BINDING;
                foreach ($bindings as $argument => $value) {
                    if (!$value instanceof BoundArgument) {
                        $bindings[$argument] = new BoundArgument($value, $trackBindings, $bindingType, $file);
                    }
                }
>>>>>>> Stashed changes
            }

            $definition->setBindings($bindings);
        }

        if (isset($service['autoconfigure'])) {
            $definition->setAutoconfigured($service['autoconfigure']);
        }

        if (\array_key_exists('namespace', $service) && !\array_key_exists('resource', $service)) {
            throw new InvalidArgumentException(sprintf('A "resource" attribute must be set when the "namespace" attribute is set for service "%s" in "%s". Check your YAML syntax.', $id, $file));
        }

        if ($return) {
            if (\array_key_exists('resource', $service)) {
                throw new InvalidArgumentException(sprintf('Invalid "resource" attribute found for service "%s" in "%s". Check your YAML syntax.', $id, $file));
            }

            return $definition;
        }

        if (\array_key_exists('resource', $service)) {
            if (!\is_string($service['resource'])) {
                throw new InvalidArgumentException(sprintf('A "resource" attribute must be of type string for service "%s" in "%s". Check your YAML syntax.', $id, $file));
            }
<<<<<<< Updated upstream
            $exclude = isset($service['exclude']) ? $service['exclude'] : null;
            $namespace = isset($service['namespace']) ? $service['namespace'] : $id;
            $this->registerClasses($definition, $namespace, $service['resource'], $exclude);
=======
            $exclude = $service['exclude'] ?? null;
            $namespace = $service['namespace'] ?? $id;
            $this->registerClasses($definition, $namespace, $service['resource'], $exclude, $file);
>>>>>>> Stashed changes
        } else {
            $this->setDefinition($id, $definition);
        }

        return null;
    }

    /**
<<<<<<< Updated upstream
     * Parses a callable.
     *
     * @param string|array $callable  A callable
     * @param string       $parameter A parameter (e.g. 'factory' or 'configurator')
     * @param string       $id        A service identifier
     * @param string       $file      A parsed file
     *
     * @throws InvalidArgumentException When errors occur
     *
     * @return string|array A parsed callable
     */
    private function parseCallable($callable, $parameter, $id, $file)
=======
     * @throws InvalidArgumentException When errors occur
     */
    private function parseCallable(mixed $callable, string $parameter, string $id, string $file): string|array|Reference
>>>>>>> Stashed changes
    {
        if (\is_string($callable)) {
            if (str_starts_with($callable, '@=')) {
                if ('factory' !== $parameter) {
                    throw new InvalidArgumentException(sprintf('Using expressions in "%s" for the "%s" service is not supported in "%s".', $parameter, $id, $file));
                }
                if (!class_exists(Expression::class)) {
                    throw new \LogicException('The "@=" expression syntax cannot be used without the ExpressionLanguage component. Try running "composer require symfony/expression-language".');
                }

                return $callable;
            }

            if ('' !== $callable && '@' === $callable[0]) {
                throw new InvalidArgumentException(sprintf('The value of the "%s" option for the "%s" service must be the id of the service without the "@" prefix (replace "%s" with "%s").', $parameter, $id, $callable, substr($callable, 1)));
            }

<<<<<<< Updated upstream
            if (false !== strpos($callable, ':') && false === strpos($callable, '::')) {
                $parts = explode(':', $callable);

                return [$this->resolveServices('@'.$parts[0], $file), $parts[1]];
            }

=======
>>>>>>> Stashed changes
            return $callable;
        }

        if (\is_array($callable)) {
            if (isset($callable[0]) && isset($callable[1])) {
                return [$this->resolveServices($callable[0], $file), $callable[1]];
            }

            if ('factory' === $parameter && isset($callable[1]) && null === $callable[0]) {
                return $callable;
            }

            throw new InvalidArgumentException(sprintf('Parameter "%s" must contain an array with two elements for service "%s" in "%s". Check your YAML syntax.', $parameter, $id, $file));
        }

        throw new InvalidArgumentException(sprintf('Parameter "%s" must be a string or an array for service "%s" in "%s". Check your YAML syntax.', $parameter, $id, $file));
    }

    /**
     * Loads a YAML file.
     *
     * @throws InvalidArgumentException when the given file is not a local file or when it does not exist
     */
    protected function loadFile(string $file): ?array
    {
<<<<<<< Updated upstream
        if (!class_exists('Symfony\Component\Yaml\Parser')) {
            throw new RuntimeException('Unable to load YAML config files as the Symfony Yaml Component is not installed.');
=======
        if (!class_exists(\Symfony\Component\Yaml\Parser::class)) {
            throw new RuntimeException('Unable to load YAML config files as the Symfony Yaml Component is not installed. Try running "composer require symfony/yaml".');
>>>>>>> Stashed changes
        }

        if (!stream_is_local($file)) {
            throw new InvalidArgumentException(sprintf('This is not a local file "%s".', $file));
        }

        if (!is_file($file)) {
            throw new InvalidArgumentException(sprintf('The file "%s" does not exist.', $file));
        }

        $this->yamlParser ??= new YamlParser();

        $prevErrorHandler = set_error_handler(function ($level, $message, $script, $line) use ($file, &$prevErrorHandler) {
            $message = E_USER_DEPRECATED === $level ? preg_replace('/ on line \d+/', ' in "'.$file.'"$0', $message) : $message;

            return $prevErrorHandler ? $prevErrorHandler($level, $message, $script, $line) : false;
        });

        try {
            $configuration = $this->yamlParser->parseFile($file, Yaml::PARSE_CONSTANT | Yaml::PARSE_CUSTOM_TAGS);
        } catch (ParseException $e) {
            throw new InvalidArgumentException(sprintf('The file "%s" does not contain valid YAML: ', $file).$e->getMessage(), 0, $e);
        } finally {
            restore_error_handler();
        }

        return $this->validate($configuration, $file);
    }

    /**
     * Validates a YAML file.
     *
     * @param mixed  $content
     * @param string $file
     *
     * @return array
     *
     * @throws InvalidArgumentException When service file is not valid
     */
<<<<<<< Updated upstream
    private function validate($content, $file)
=======
    private function validate(mixed $content, string $file): ?array
>>>>>>> Stashed changes
    {
        if (null === $content) {
            return $content;
        }

        if (!\is_array($content)) {
            throw new InvalidArgumentException(sprintf('The service file "%s" is not valid. It should contain an array. Check your YAML syntax.', $file));
        }

        foreach ($content as $namespace => $data) {
            if (\in_array($namespace, ['imports', 'parameters', 'services']) || str_starts_with($namespace, 'when@')) {
                continue;
            }

            if (!$this->container->hasExtension($namespace)) {
<<<<<<< Updated upstream
                $extensionNamespaces = array_filter(array_map(function ($ext) { return $ext->getAlias(); }, $this->container->getExtensions()));
=======
                $extensionNamespaces = array_filter(array_map(fn (ExtensionInterface $ext) => $ext->getAlias(), $this->container->getExtensions()));
>>>>>>> Stashed changes
                throw new InvalidArgumentException(sprintf('There is no extension able to load the configuration for "%s" (in "%s"). Looked for namespace "%s", found "%s".', $namespace, $file, $namespace, $extensionNamespaces ? sprintf('"%s"', implode('", "', $extensionNamespaces)) : 'none'));
            }
        }

        return $content;
    }

<<<<<<< Updated upstream
    /**
     * Resolves services.
     *
     * @param mixed  $value
     * @param string $file
     * @param bool   $isParameter
     *
     * @return array|string|Reference|ArgumentInterface
     */
    private function resolveServices($value, $file, $isParameter = false)
=======
    private function resolveServices(mixed $value, string $file, bool $isParameter = false): mixed
>>>>>>> Stashed changes
    {
        if ($value instanceof TaggedValue) {
            $argument = $value->getValue();

            if ('closure' === $value->getTag()) {
                $argument = $this->resolveServices($argument, $file, $isParameter);

                return (new Definition('Closure'))
                    ->setFactory(['Closure', 'fromCallable'])
                    ->addArgument($argument);
            }
            if ('iterator' === $value->getTag()) {
                if (!\is_array($argument)) {
                    throw new InvalidArgumentException(sprintf('"!iterator" tag only accepts sequences in "%s".', $file));
                }
                $argument = $this->resolveServices($argument, $file, $isParameter);

                return new IteratorArgument($argument);
            }
<<<<<<< Updated upstream
            if ('tagged' === $value->getTag()) {
                if (!\is_string($argument) || !$argument) {
                    throw new InvalidArgumentException(sprintf('"!tagged" tag only accepts non empty string in "%s".', $file));
=======
            if ('service_closure' === $value->getTag()) {
                $argument = $this->resolveServices($argument, $file, $isParameter);

                return new ServiceClosureArgument($argument);
            }
            if ('service_locator' === $value->getTag()) {
                if (!\is_array($argument)) {
                    throw new InvalidArgumentException(sprintf('"!service_locator" tag only accepts maps in "%s".', $file));
                }

                $argument = $this->resolveServices($argument, $file, $isParameter);

                if (isset($argument[0])) {
                    trigger_deprecation('symfony/dependency-injection', '6.3', 'Using integers as keys in a "!service_locator" tag is deprecated. The keys will default to the IDs of the original services in 7.0.');
                }

                return new ServiceLocatorArgument($argument);
            }
            if (\in_array($value->getTag(), ['tagged', 'tagged_iterator', 'tagged_locator'], true)) {
                $forLocator = 'tagged_locator' === $value->getTag();

                if (\is_array($argument) && isset($argument['tag']) && $argument['tag']) {
                    if ($diff = array_diff(array_keys($argument), $supportedKeys = ['tag', 'index_by', 'default_index_method', 'default_priority_method', 'exclude', 'exclude_self'])) {
                        throw new InvalidArgumentException(sprintf('"!%s" tag contains unsupported key "%s"; supported ones are "%s".', $value->getTag(), implode('", "', $diff), implode('", "', $supportedKeys)));
                    }

                    $argument = new TaggedIteratorArgument($argument['tag'], $argument['index_by'] ?? null, $argument['default_index_method'] ?? null, $forLocator, $argument['default_priority_method'] ?? null, (array) ($argument['exclude'] ?? null), $argument['exclude_self'] ?? true);
                } elseif (\is_string($argument) && $argument) {
                    $argument = new TaggedIteratorArgument($argument, null, null, $forLocator);
                } else {
                    throw new InvalidArgumentException(sprintf('"!%s" tags only accept a non empty string or an array with a key "tag" in "%s".', $value->getTag(), $file));
>>>>>>> Stashed changes
                }

                return new TaggedIteratorArgument($argument);
            }
            if ('service' === $value->getTag()) {
                if ($isParameter) {
                    throw new InvalidArgumentException(sprintf('Using an anonymous service in a parameter is not allowed in "%s".', $file));
                }

                $isLoadingInstanceof = $this->isLoadingInstanceof;
                $this->isLoadingInstanceof = false;
                $instanceof = $this->instanceof;
                $this->instanceof = [];

                $id = sprintf('%d_%s', ++$this->anonymousServicesCount, preg_replace('/^.*\\\\/', '', isset($argument['class']) ? $argument['class'] : '').$this->anonymousServicesSuffix);
                $this->parseDefinition($id, $argument, $file, []);

                if (!$this->container->hasDefinition($id)) {
                    throw new InvalidArgumentException(sprintf('Creating an alias using the tag "!service" is not allowed in "%s".', $file));
                }

                $this->container->getDefinition($id);

                $this->isLoadingInstanceof = $isLoadingInstanceof;
                $this->instanceof = $instanceof;

                return new Reference($id);
            }
            if ('abstract' === $value->getTag()) {
                return new AbstractArgument($value->getValue());
            }

            throw new InvalidArgumentException(sprintf('Unsupported tag "!%s".', $value->getTag()));
        }

        if (\is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = $this->resolveServices($v, $file, $isParameter);
            }
        } elseif (\is_string($value) && 0 === strpos($value, '@=')) {
            if (!class_exists(Expression::class)) {
                throw new \LogicException(sprintf('The "@=" expression syntax cannot be used without the ExpressionLanguage component. Try running "composer require symfony/expression-language".'));
            }

            return new Expression(substr($value, 2));
        } elseif (\is_string($value) && 0 === strpos($value, '@')) {
            if (0 === strpos($value, '@@')) {
                $value = substr($value, 1);
                $invalidBehavior = null;
            } elseif (0 === strpos($value, '@!')) {
                $value = substr($value, 2);
                $invalidBehavior = ContainerInterface::IGNORE_ON_UNINITIALIZED_REFERENCE;
            } elseif (0 === strpos($value, '@?')) {
                $value = substr($value, 2);
                $invalidBehavior = ContainerInterface::IGNORE_ON_INVALID_REFERENCE;
            } else {
                $value = substr($value, 1);
                $invalidBehavior = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE;
            }

            if ('=' === substr($value, -1)) {
                @trigger_error(sprintf('The "=" suffix that used to disable strict references in Symfony 2.x is deprecated since Symfony 3.3 and will be unsupported in 4.0. Remove it in "%s".', $value), E_USER_DEPRECATED);
                $value = substr($value, 0, -1);
            }

            if (null !== $invalidBehavior) {
                $value = new Reference($value, $invalidBehavior);
            }
        }

        return $value;
    }

<<<<<<< Updated upstream
    /**
     * Loads from Extensions.
     */
    private function loadFromExtensions(array $content)
=======
    private function loadFromExtensions(array $content): void
>>>>>>> Stashed changes
    {
        foreach ($content as $namespace => $values) {
            if (\in_array($namespace, ['imports', 'parameters', 'services']) || str_starts_with($namespace, 'when@')) {
                continue;
            }

            if (!\is_array($values) && null !== $values) {
                $values = [];
            }

            $this->container->loadFromExtension($namespace, $values);
        }
    }

<<<<<<< Updated upstream
    /**
     * Checks the keywords used to define a service.
     *
     * @param string $id         The service name
     * @param array  $definition The service definition to check
     * @param string $file       The loaded YAML file
     */
    private function checkDefinition($id, array $definition, $file)
=======
    private function checkDefinition(string $id, array $definition, string $file): void
>>>>>>> Stashed changes
    {
        if ($throw = $this->isLoadingInstanceof) {
            $keywords = self::$instanceofKeywords;
        } elseif ($throw = (isset($definition['resource']) || isset($definition['namespace']))) {
            $keywords = self::$prototypeKeywords;
        } else {
            $keywords = self::$serviceKeywords;
        }

        foreach ($definition as $key => $value) {
            if (!isset($keywords[$key])) {
                if ($throw) {
                    throw new InvalidArgumentException(sprintf('The configuration key "%s" is unsupported for definition "%s" in "%s". Allowed configuration keys are "%s".', $key, $id, $file, implode('", "', $keywords)));
                }

                @trigger_error(sprintf('The configuration key "%s" is unsupported for service definition "%s" in "%s". Allowed configuration keys are "%s". The YamlFileLoader object will raise an exception instead in Symfony 4.0 when detecting an unsupported service configuration key.', $key, $id, $file, implode('", "', $keywords)), E_USER_DEPRECATED);
            }
        }
    }

    private function validateAttributes(string $message, array $attributes, array $path = []): void
    {
        foreach ($attributes as $name => $value) {
            if (\is_array($value)) {
                $this->validateAttributes($message, $value, [...$path, $name]);
            } elseif (!\is_scalar($value ?? '')) {
                $name = implode('.', [...$path, $name]);
                throw new InvalidArgumentException(sprintf($message, $name));
            }
        }
    }
}
