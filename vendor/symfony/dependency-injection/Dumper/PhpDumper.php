<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Dumper;

<<<<<<< Updated upstream
=======
use Composer\Autoload\ClassLoader;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\Argument\AbstractArgument;
>>>>>>> Stashed changes
use Symfony\Component\DependencyInjection\Argument\ArgumentInterface;
use Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Symfony\Component\DependencyInjection\Argument\LazyClosure;
use Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument;
use Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass;
use Symfony\Component\DependencyInjection\Compiler\CheckCircularReferencesPass;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\EnvParameterException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ExpressionLanguage;
use Symfony\Component\DependencyInjection\LazyProxy\PhpDumper\DumperInterface;
use Symfony\Component\DependencyInjection\LazyProxy\PhpDumper\LazyServiceDumper;
use Symfony\Component\DependencyInjection\LazyProxy\PhpDumper\NullDumper;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\TypedReference;
use Symfony\Component\DependencyInjection\Variable;
use Symfony\Component\ExpressionLanguage\Expression;

/**
 * PhpDumper dumps a service container as a PHP class.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class PhpDumper extends Dumper
{
    /**
     * Characters that might appear in the generated variable name as first character.
     */
    const FIRST_CHARS = 'abcdefghijklmnopqrstuvwxyz';

    /**
     * Characters that might appear in the generated variable name as any but the first character.
     */
    const NON_FIRST_CHARS = 'abcdefghijklmnopqrstuvwxyz0123456789_';

<<<<<<< Updated upstream
    private $definitionVariables;
    private $referenceVariables;
    private $variableCount;
    private $inlinedDefinitions;
    private $serviceCalls;
    private $reservedVariables = ['instance', 'class', 'this'];
    private $expressionLanguage;
    private $targetDirRegex;
    private $targetDirMaxMatches;
    private $docStar;
    private $serviceIdToMethodNameMap;
    private $usedMethodNames;
    private $namespace;
    private $asFiles;
    private $hotPathTag;
    private $inlineRequires;
    private $inlinedRequires = [];
    private $circularReferences = [];
=======
    /** @var \SplObjectStorage<Definition, Variable>|null */
    private ?\SplObjectStorage $definitionVariables = null;
    private ?array $referenceVariables = null;
    private int $variableCount;
    private ?\SplObjectStorage $inlinedDefinitions = null;
    private ?array $serviceCalls = null;
    private array $reservedVariables = ['instance', 'class', 'this', 'container'];
    private ExpressionLanguage $expressionLanguage;
    private ?string $targetDirRegex = null;
    private int $targetDirMaxMatches;
    private string $docStar;
    private array $serviceIdToMethodNameMap;
    private array $usedMethodNames;
    private string $namespace;
    private bool $asFiles;
    private string $hotPathTag;
    private array $preloadTags;
    private bool $inlineFactories;
    private bool $inlineRequires;
    private array $inlinedRequires = [];
    private array $circularReferences = [];
    private array $singleUsePrivateIds = [];
    private array $preload = [];
    private bool $addGetService = false;
    private array $locatedIds = [];
    private string $serviceLocatorTag;
    private array $exportedVariables = [];
    private array $dynamicParameters = [];
    private string $baseClass;
    private string $class;
    private DumperInterface $proxyDumper;
    private bool $hasProxyDumper = true;
>>>>>>> Stashed changes

    public function __construct(ContainerBuilder $container)
    {
        if (!$container->isCompiled()) {
            @trigger_error('Dumping an uncompiled ContainerBuilder is deprecated since Symfony 3.3 and will not be supported anymore in 4.0. Compile the container beforehand.', E_USER_DEPRECATED);
        }

        parent::__construct($container);
    }

    /**
     * Sets the dumper to be used when dumping proxies in the generated container.
     *
     * @return void
     */
    public function setProxyDumper(DumperInterface $proxyDumper)
    {
        $this->proxyDumper = $proxyDumper;
        $this->hasProxyDumper = !$proxyDumper instanceof NullDumper;
    }

    /**
     * Dumps the service container as a PHP class.
     *
     * Available options:
     *
     *  * class:      The class name
     *  * base_class: The base class name
     *  * namespace:  The class namespace
     *  * as_files:   To split the container in several files
     *
     * @return string|array A PHP class representing the service container or an array of PHP files if the "as_files" option is set
     *
     * @throws EnvParameterException When an env var exists but has not been dumped
     */
    public function dump(array $options = []): string|array
    {
        $this->targetDirRegex = null;
        $this->inlinedRequires = [];
<<<<<<< Updated upstream
=======
        $this->exportedVariables = [];
        $this->dynamicParameters = [];
>>>>>>> Stashed changes
        $options = array_merge([
            'class' => 'ProjectServiceContainer',
            'base_class' => 'Container',
            'namespace' => '',
            'as_files' => false,
            'debug' => true,
            'hot_path_tag' => 'container.hot_path',
<<<<<<< Updated upstream
            'inline_class_loader_parameter' => 'container.dumper.inline_class_loader',
            'build_time' => time(),
        ], $options);

        $this->namespace = $options['namespace'];
        $this->asFiles = $options['as_files'];
        $this->hotPathTag = $options['hot_path_tag'];
        $this->inlineRequires = $options['inline_class_loader_parameter'] && $this->container->hasParameter($options['inline_class_loader_parameter']) && $this->container->getParameter($options['inline_class_loader_parameter']);
=======
            'preload_tags' => ['container.preload', 'container.no_preload'],
            'inline_factories_parameter' => 'container.dumper.inline_factories', // @deprecated since Symfony 6.3
            'inline_class_loader_parameter' => 'container.dumper.inline_class_loader', // @deprecated since Symfony 6.3
            'inline_factories' => null,
            'inline_class_loader' => null,
            'preload_classes' => [],
            'service_locator_tag' => 'container.service_locator',
            'build_time' => time(),
        ], $options);

        $this->addGetService = false;
        $this->namespace = $options['namespace'];
        $this->asFiles = $options['as_files'];
        $this->hotPathTag = $options['hot_path_tag'];
        $this->preloadTags = $options['preload_tags'];

        $this->inlineFactories = false;
        if (isset($options['inline_factories'])) {
            $this->inlineFactories = $this->asFiles && $options['inline_factories'];
        } elseif (!$options['inline_factories_parameter']) {
            trigger_deprecation('symfony/dependency-injection', '6.3', 'Option "inline_factories_parameter" passed to "%s()" is deprecated, use option "inline_factories" instead.', __METHOD__);
        } elseif ($this->container->hasParameter($options['inline_factories_parameter'])) {
            trigger_deprecation('symfony/dependency-injection', '6.3', 'Option "inline_factories_parameter" passed to "%s()" is deprecated, use option "inline_factories" instead.', __METHOD__);
            $this->inlineFactories = $this->asFiles && $this->container->getParameter($options['inline_factories_parameter']);
        }

        $this->inlineRequires = $options['debug'];
        if (isset($options['inline_class_loader'])) {
            $this->inlineRequires = $options['inline_class_loader'];
        } elseif (!$options['inline_class_loader_parameter']) {
            trigger_deprecation('symfony/dependency-injection', '6.3', 'Option "inline_class_loader_parameter" passed to "%s()" is deprecated, use option "inline_class_loader" instead.', __METHOD__);
            $this->inlineRequires = false;
        } elseif ($this->container->hasParameter($options['inline_class_loader_parameter'])) {
            trigger_deprecation('symfony/dependency-injection', '6.3', 'Option "inline_class_loader_parameter" passed to "%s()" is deprecated, use option "inline_class_loader" instead.', __METHOD__);
            $this->inlineRequires = $this->container->getParameter($options['inline_class_loader_parameter']);
        }

        $this->serviceLocatorTag = $options['service_locator_tag'];
        $this->class = $options['class'];
>>>>>>> Stashed changes

        if (0 !== strpos($baseClass = $options['base_class'], '\\') && 'Container' !== $baseClass) {
            $baseClass = sprintf('%s\%s', $options['namespace'] ? '\\'.$options['namespace'] : '', $baseClass);
            $baseClassWithNamespace = $baseClass;
        } elseif ('Container' === $baseClass) {
            $baseClassWithNamespace = Container::class;
        } else {
            $baseClassWithNamespace = $baseClass;
        }

        $this->initializeMethodNamesMap('Container' === $baseClass ? Container::class : $baseClass);

        if (!$this->hasProxyDumper) {
            (new AnalyzeServiceReferencesPass(true, false))->process($this->container);
            (new CheckCircularReferencesPass())->process($this->container);
        }

        (new AnalyzeServiceReferencesPass(false, !$this->getProxyDumper() instanceof NullDumper))->process($this->container);
        $checkedNodes = [];
        $this->circularReferences = [];
        foreach ($this->container->getCompiler()->getServiceReferenceGraph()->getNodes() as $id => $node) {
            if (!$node->getValue() instanceof Definition) {
                continue;
            }
            if (!isset($checkedNodes[$id])) {
                $this->analyzeCircularReferences($id, $node->getOutEdges(), $checkedNodes);
            }
        }
        $this->container->getCompiler()->getServiceReferenceGraph()->clear();
        $checkedNodes = [];

        $this->docStar = $options['debug'] ? '*' : '';

        if (!empty($options['file']) && is_dir($dir = \dirname($options['file']))) {
            // Build a regexp where the first root dirs are mandatory,
            // but every other sub-dir is optional up to the full path in $dir
            // Mandate at least 1 root dir and not more than 5 optional dirs.

            $dir = explode(\DIRECTORY_SEPARATOR, realpath($dir));
            $i = \count($dir);

            if (2 + (int) ('\\' === \DIRECTORY_SEPARATOR) <= $i) {
                $regex = '';
                $lastOptionalDir = $i > 8 ? $i - 5 : (2 + (int) ('\\' === \DIRECTORY_SEPARATOR));
                $this->targetDirMaxMatches = $i - $lastOptionalDir;

                while (--$i >= $lastOptionalDir) {
                    $regex = sprintf('(%s%s)?', preg_quote(\DIRECTORY_SEPARATOR.$dir[$i], '#'), $regex);
                }

                do {
                    $regex = preg_quote(\DIRECTORY_SEPARATOR.$dir[$i], '#').$regex;
                } while (0 < --$i);

                $this->targetDirRegex = '#'.preg_quote($dir[0], '#').$regex.'#';
            }
        }

<<<<<<< Updated upstream
        $code =
            $this->startClass($options['class'], $baseClass, $baseClassWithNamespace).
            $this->addServices().
            $this->addDefaultParametersMethod().
            $this->endClass()
        ;

=======
        $proxyClasses = $this->inlineFactories ? $this->generateProxyClasses() : null;

        if ($options['preload_classes']) {
            $this->preload = array_combine($options['preload_classes'], $options['preload_classes']);
        }

        $code = $this->addDefaultParametersMethod();
        $code =
            $this->startClass($options['class'], $baseClass, $this->inlineFactories && $proxyClasses).
            $this->addServices($services).
            $this->addDeprecatedAliases().
            $code
        ;

        $proxyClasses ??= $this->generateProxyClasses();

        if ($this->addGetService) {
            $code = preg_replace(
                "/\r?\n\r?\n    public function __construct.+?\\{\r?\n/s",
                "\n    protected \Closure \$getService;$0",
                $code,
                1
            );
        }

>>>>>>> Stashed changes
        if ($this->asFiles) {
            $fileTemplate = <<<EOF
<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
<<<<<<< Updated upstream
=======
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
>>>>>>> Stashed changes

/*{$this->docStar}
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class %s extends {$options['class']}
{%s}

EOF;
            $files = [];
<<<<<<< Updated upstream

            if ($ids = array_keys($this->container->getRemovedIds())) {
=======
            $preloadedFiles = [];
            $ids = $this->container->getRemovedIds();
            foreach ($this->container->getDefinitions() as $id => $definition) {
                if (!$definition->isPublic()) {
                    $ids[$id] = true;
                }
            }
            if ($ids = array_keys($ids)) {
>>>>>>> Stashed changes
                sort($ids);
                $c = "<?php\n\nreturn [\n";
                foreach ($ids as $id) {
                    $c .= '    '.$this->doExport($id)." => true,\n";
                }
                $files['removed-ids.php'] = $c."];\n";
            }

<<<<<<< Updated upstream
            foreach ($this->generateServiceFiles() as $file => $c) {
                $files[$file] = $fileStart.$c;
            }
            foreach ($this->generateProxyClasses() as $file => $c) {
                $files[$file] = "<?php\n".$c;
=======
            if (!$this->inlineFactories) {
                foreach ($this->generateServiceFiles($services) as $file => [$c, $preload]) {
                    $files[$file] = sprintf($fileTemplate, substr($file, 0, -4), $c);

                    if ($preload) {
                        $preloadedFiles[$file] = $file;
                    }
                }
                foreach ($proxyClasses as $file => $c) {
                    $files[$file] = "<?php\n".$c;
                    $preloadedFiles[$file] = $file;
                }
            }

            $code .= $this->endClass();

            if ($this->inlineFactories && $proxyClasses) {
                $files['proxy-classes.php'] = "<?php\n\n";

                foreach ($proxyClasses as $c) {
                    $files['proxy-classes.php'] .= $c;
                }
>>>>>>> Stashed changes
            }
            $files[$options['class'].'.php'] = $code;
            $hash = ucfirst(strtr(ContainerBuilder::hash($files), '._', 'xx'));
            $code = [];

            foreach ($files as $file => $c) {
                $code["Container{$hash}/{$file}"] = substr_replace($c, "<?php\n\nnamespace Container{$hash};\n", 0, 6);

                if (isset($preloadedFiles[$file])) {
                    $preloadedFiles[$file] = "Container{$hash}/{$file}";
                }
            }
            $namespaceLine = $this->namespace ? "\nnamespace {$this->namespace};\n" : '';
            $time = $options['build_time'];
            $id = hash('crc32', $hash.$time);
<<<<<<< Updated upstream
=======
            $this->asFiles = false;

            if ($this->preload && null !== $autoloadFile = $this->getAutoloadFile()) {
                $autoloadFile = trim($this->export($autoloadFile), '()\\');

                $preloadedFiles = array_reverse($preloadedFiles);
                if ('' !== $preloadedFiles = implode("';\nrequire __DIR__.'/", $preloadedFiles)) {
                    $preloadedFiles = "require __DIR__.'/$preloadedFiles';\n";
                }

                $code[$options['class'].'.preload.php'] = <<<EOF
<?php

// This file has been auto-generated by the Symfony Dependency Injection Component
// You can reference it in the "opcache.preload" php.ini setting on PHP >= 7.4 when preloading is desired

use Symfony\Component\DependencyInjection\Dumper\Preloader;

if (in_array(PHP_SAPI, ['cli', 'phpdbg', 'embed'], true)) {
    return;
}

require $autoloadFile;
(require __DIR__.'/{$options['class']}.php')->set(\\Container{$hash}\\{$options['class']}::class, null);
$preloadedFiles
\$classes = [];

EOF;

                foreach ($this->preload as $class) {
                    if (!$class || str_contains($class, '$') || \in_array($class, ['int', 'float', 'string', 'bool', 'resource', 'object', 'array', 'null', 'callable', 'iterable', 'mixed', 'void'], true)) {
                        continue;
                    }
                    if (!(class_exists($class, false) || interface_exists($class, false) || trait_exists($class, false)) || (new \ReflectionClass($class))->isUserDefined()) {
                        $code[$options['class'].'.preload.php'] .= sprintf("\$classes[] = '%s';\n", $class);
                    }
                }

                $code[$options['class'].'.preload.php'] .= <<<'EOF'

$preloaded = Preloader::preload($classes);

EOF;
            }
>>>>>>> Stashed changes

            $code[$options['class'].'.php'] = <<<EOF
<?php
{$namespaceLine}
// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\\class_exists(\\Container{$hash}\\{$options['class']}::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container{$hash}/{$options['class']}.php') {
    touch(__DIR__.'/Container{$hash}.legacy');

    return;
}

if (!\\class_exists({$options['class']}::class, false)) {
    \\class_alias(\\Container{$hash}\\{$options['class']}::class, {$options['class']}::class, false);
}

return new \\Container{$hash}\\{$options['class']}([
    'container.build_hash' => '$hash',
    'container.build_id' => '$id',
    'container.build_time' => $time,
    'container.runtime_mode' => \\in_array(\\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\\DIRECTORY_SEPARATOR.'Container{$hash}');

EOF;
        } else {
            foreach ($this->generateProxyClasses() as $c) {
                $code .= $c;
            }
        }

        $this->targetDirRegex = null;
        $this->inlinedRequires = [];
        $this->circularReferences = [];
<<<<<<< Updated upstream
=======
        $this->locatedIds = [];
        $this->exportedVariables = [];
        $this->dynamicParameters = [];
        $this->preload = [];
>>>>>>> Stashed changes

        $unusedEnvs = [];
        foreach ($this->container->getEnvCounters() as $env => $use) {
            if (!$use) {
                $unusedEnvs[] = $env;
            }
        }
        if ($unusedEnvs) {
            throw new EnvParameterException($unusedEnvs, null, 'Environment variables "%s" are never used. Please, check your container\'s configuration.');
        }

        return $code;
    }

    /**
     * Retrieves the currently set proxy dumper or instantiates one.
     *
     * @return ProxyDumper
     */
<<<<<<< Updated upstream
    private function getProxyDumper()
=======
    private function getProxyDumper(): DumperInterface
>>>>>>> Stashed changes
    {
        return $this->proxyDumper ??= new LazyServiceDumper($this->class);
    }

<<<<<<< Updated upstream
    private function analyzeCircularReferences($sourceId, array $edges, &$checkedNodes, &$currentPath = [], $byConstructor = true)
    {
=======
    private function analyzeReferences(): void
    {
        (new AnalyzeServiceReferencesPass(false, $this->hasProxyDumper))->process($this->container);
        $checkedNodes = [];
        $this->circularReferences = [];
        $this->singleUsePrivateIds = [];
        foreach ($this->container->getCompiler()->getServiceReferenceGraph()->getNodes() as $id => $node) {
            if (!$node->getValue() instanceof Definition) {
                continue;
            }

            if ($this->isSingleUsePrivateNode($node)) {
                $this->singleUsePrivateIds[$id] = $id;
            }

            $this->collectCircularReferences($id, $node->getOutEdges(), $checkedNodes);
        }

        $this->container->getCompiler()->getServiceReferenceGraph()->clear();
        $this->singleUsePrivateIds = array_diff_key($this->singleUsePrivateIds, $this->circularReferences);
    }

    private function collectCircularReferences(string $sourceId, array $edges, array &$checkedNodes, array &$loops = [], array $path = [], bool $byConstructor = true): void
    {
        $path[$sourceId] = $byConstructor;
>>>>>>> Stashed changes
        $checkedNodes[$sourceId] = true;
        $currentPath[$sourceId] = $byConstructor;

        foreach ($edges as $edge) {
            $node = $edge->getDestNode();
            $id = $node->getId();
<<<<<<< Updated upstream

            if (!$node->getValue() instanceof Definition || $sourceId === $id || $edge->isLazy() || $edge->isWeak()) {
                // no-op
            } elseif (isset($currentPath[$id])) {
                $this->addCircularReferences($id, $currentPath, $edge->isReferencedByConstructor());
            } elseif (!isset($checkedNodes[$id])) {
                $this->analyzeCircularReferences($id, $node->getOutEdges(), $checkedNodes, $currentPath, $edge->isReferencedByConstructor());
            } elseif (isset($this->circularReferences[$id])) {
                $this->connectCircularReferences($id, $currentPath, $edge->isReferencedByConstructor());
            }
        }
        unset($currentPath[$sourceId]);
    }

    private function connectCircularReferences($sourceId, &$currentPath, $byConstructor, &$subPath = [])
    {
        $currentPath[$sourceId] = $subPath[$sourceId] = $byConstructor;

        foreach ($this->circularReferences[$sourceId] as $id => $byConstructor) {
            if (isset($currentPath[$id])) {
                $this->addCircularReferences($id, $currentPath, $byConstructor);
            } elseif (!isset($subPath[$id]) && isset($this->circularReferences[$id])) {
                $this->connectCircularReferences($id, $currentPath, $byConstructor, $subPath);
=======
            if ($sourceId === $id || !$node->getValue() instanceof Definition || $edge->isWeak()) {
                continue;
            }

            if (isset($path[$id])) {
                $loop = null;
                $loopByConstructor = $edge->isReferencedByConstructor() && !$edge->isLazy();
                $pathInLoop = [$id, []];
                foreach ($path as $k => $pathByConstructor) {
                    if (null !== $loop) {
                        $loop[] = $k;
                        $pathInLoop[1][$k] = $pathByConstructor;
                        $loops[$k][] = &$pathInLoop;
                        $loopByConstructor = $loopByConstructor && $pathByConstructor;
                    } elseif ($k === $id) {
                        $loop = [];
                    }
                }
                $this->addCircularReferences($id, $loop, $loopByConstructor);
            } elseif (!isset($checkedNodes[$id])) {
                $this->collectCircularReferences($id, $node->getOutEdges(), $checkedNodes, $loops, $path, $edge->isReferencedByConstructor() && !$edge->isLazy());
            } elseif (isset($loops[$id])) {
                // we already had detected loops for this edge
                // let's check if we have a common ancestor in one of the detected loops
                foreach ($loops[$id] as [$first, $loopPath]) {
                    if (!isset($path[$first])) {
                        continue;
                    }
                    // We have a common ancestor, let's fill the current path
                    $fillPath = null;
                    foreach ($loopPath as $k => $pathByConstructor) {
                        if (null !== $fillPath) {
                            $fillPath[$k] = $pathByConstructor;
                        } elseif ($k === $id) {
                            $fillPath = $path;
                            $fillPath[$k] = $pathByConstructor;
                        }
                    }

                    // we can now build the loop
                    $loop = null;
                    $loopByConstructor = $edge->isReferencedByConstructor() && !$edge->isLazy();
                    foreach ($fillPath as $k => $pathByConstructor) {
                        if (null !== $loop) {
                            $loop[] = $k;
                            $loopByConstructor = $loopByConstructor && $pathByConstructor;
                        } elseif ($k === $first) {
                            $loop = [];
                        }
                    }
                    $this->addCircularReferences($first, $loop, $loopByConstructor);
                    break;
                }
>>>>>>> Stashed changes
            }
        }
        unset($currentPath[$sourceId], $subPath[$sourceId]);
    }

<<<<<<< Updated upstream
    private function addCircularReferences($id, $currentPath, $byConstructor)
=======
    private function addCircularReferences(string $sourceId, array $currentPath, bool $byConstructor): void
>>>>>>> Stashed changes
    {
        $currentPath[$id] = $byConstructor;
        $circularRefs = [];

        foreach (array_reverse($currentPath) as $parentId => $v) {
            $byConstructor = $byConstructor && $v;
            $circularRefs[] = $parentId;

            if ($parentId === $id) {
                break;
            }
        }

        $currentId = $id;
        foreach ($circularRefs as $parentId) {
            if (empty($this->circularReferences[$parentId][$currentId])) {
                $this->circularReferences[$parentId][$currentId] = $byConstructor;
            }

            $currentId = $parentId;
        }
    }

<<<<<<< Updated upstream
    private function collectLineage($class, array &$lineage)
=======
    private function collectLineage(string $class, array &$lineage): void
>>>>>>> Stashed changes
    {
        if (isset($lineage[$class])) {
            return;
        }
        if (!$r = $this->container->getReflectionClass($class, false)) {
            return;
        }
        if ($this->container instanceof $class) {
            return;
        }
        $file = $r->getFileName();
        if (!$file || $this->doExport($file) === $exportedFile = $this->export($file)) {
            return;
        }

        if ($parent = $r->getParentClass()) {
            $this->collectLineage($parent->name, $lineage);
        }

        foreach ($r->getInterfaces() as $parent) {
            $this->collectLineage($parent->name, $lineage);
        }

        foreach ($r->getTraits() as $parent) {
            $this->collectLineage($parent->name, $lineage);
        }

        $lineage[$class] = substr($exportedFile, 1, -1);
    }

    private function generateProxyClasses()
    {
        $alreadyGenerated = [];
        $definitions = $this->container->getDefinitions();
<<<<<<< Updated upstream
        $strip = '' === $this->docStar && method_exists('Symfony\Component\HttpKernel\Kernel', 'stripComments');
=======
        $strip = '' === $this->docStar;
>>>>>>> Stashed changes
        $proxyDumper = $this->getProxyDumper();
        ksort($definitions);
        foreach ($definitions as $id => $definition) {
            if (!$definition = $this->isProxyCandidate($definition, $asGhostObject, $id)) {
                continue;
            }
            if (isset($alreadyGenerated[$asGhostObject][$class = $definition->getClass()])) {
                continue;
            }
            $alreadyGenerated[$asGhostObject][$class] = true;

            foreach (array_column($definition->getTag('proxy'), 'interface') ?: [$class] as $r) {
                if (!$r = $this->container->getReflectionClass($r)) {
                    continue;
                }
                do {
                    $file = $r->getFileName();
                    if (str_ends_with($file, ') : eval()\'d code')) {
                        $file = substr($file, 0, strrpos($file, '(', -17));
                    }
                    if (is_file($file)) {
                        $this->container->addResource(new FileResource($file));
                    }
                    $r = $r->getParentClass() ?: null;
                } while ($r?->isUserDefined());
            }

            if ("\n" === $proxyCode = "\n".$proxyDumper->getProxyCode($definition, $id)) {
                continue;
            }
            if ($strip) {
                $proxyCode = "<?php\n".$proxyCode;
                $proxyCode = substr(self::stripComments($proxyCode), 5);
            }
<<<<<<< Updated upstream
            yield sprintf('%s.php', explode(' ', $proxyCode, 3)[1]) => $proxyCode;
=======

            $proxyClass = $this->inlineRequires ? substr($proxyCode, \strlen($code)) : $proxyCode;
            $i = strpos($proxyClass, 'class');
            $proxyClass = substr($proxyClass, 6 + $i, strpos($proxyClass, ' ', 7 + $i) - $i - 6);

            if ($this->asFiles || $this->namespace) {
                $proxyCode .= "\nif (!\\class_exists('$proxyClass', false)) {\n    \\class_alias(__NAMESPACE__.'\\\\$proxyClass', '$proxyClass', false);\n}\n";
            }

            $proxyClasses[$proxyClass.'.php'] = $proxyCode;
>>>>>>> Stashed changes
        }
    }

<<<<<<< Updated upstream
    /**
     * Generates the require_once statement for service includes.
     *
     * @return string
     */
    private function addServiceInclude($cId, Definition $definition)
    {
        $code = '';

        if ($this->inlineRequires && !$this->isHotPath($definition)) {
            $lineage = [];
            foreach ($this->inlinedDefinitions as $def) {
                if (!$def->isDeprecated() && \is_string($class = \is_array($factory = $def->getFactory()) && \is_string($factory[0]) ? $factory[0] : $def->getClass())) {
                    $this->collectLineage($class, $lineage);
=======
    private function addServiceInclude(string $cId, Definition $definition, bool $isProxyCandidate): string
    {
        $code = '';

        if ($this->inlineRequires && (!$this->isHotPath($definition) || $isProxyCandidate)) {
            $lineage = [];
            foreach ($this->inlinedDefinitions as $def) {
                if (!$def->isDeprecated()) {
                    foreach ($this->getClasses($def, $cId) as $class) {
                        $this->collectLineage($class, $lineage);
                    }
>>>>>>> Stashed changes
                }
            }

            foreach ($this->serviceCalls as $id => list($callCount, $behavior)) {
                if ('service_container' !== $id && $id !== $cId
                    && ContainerInterface::IGNORE_ON_UNINITIALIZED_REFERENCE !== $behavior
                    && $this->container->has($id)
                    && $this->isTrivialInstance($def = $this->container->findDefinition($id))
                    && \is_string($class = \is_array($factory = $def->getFactory()) && \is_string($factory[0]) ? $factory[0] : $def->getClass())
                ) {
<<<<<<< Updated upstream
                    $this->collectLineage($class, $lineage);
=======
                    foreach ($this->getClasses($def, $cId) as $class) {
                        $this->collectLineage($class, $lineage);
                    }
>>>>>>> Stashed changes
                }
            }

            foreach (array_diff_key(array_flip($lineage), $this->inlinedRequires) as $file => $class) {
                $code .= sprintf("        include_once %s;\n", $file);
            }
        }

        foreach ($this->inlinedDefinitions as $def) {
            if ($file = $def->getFile()) {
                $code .= sprintf("        include_once %s;\n", $this->dumpValue($file));
            }
        }

        if ('' !== $code) {
            $code .= "\n";
        }

        return $code;
    }

    /**
     * Generates the service instance.
     *
     * @param string $id
     * @param bool   $isSimpleInstance
     *
     * @return string
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    private function addServiceInstance($id, Definition $definition, $isSimpleInstance)
    {
        $class = $this->dumpValue($definition->getClass());

        if (0 === strpos($class, "'") && false === strpos($class, '$') && !preg_match('/^\'(?:\\\{2})?[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*(?:\\\{2}[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)*\'$/', $class)) {
            throw new InvalidArgumentException(sprintf('"%s" is not a valid class name for the "%s" service.', $class, $id));
        }

        $asGhostObject = false;
        $isProxyCandidate = $this->isProxyCandidate($definition, $asGhostObject, $id);
        $instantiation = '';

<<<<<<< Updated upstream
        if (!$isProxyCandidate && $definition->isShared()) {
            $instantiation = sprintf('$this->services[%s] = %s', $this->doExport($id), $isSimpleInstance ? '' : '$instance');
=======
        $lastWitherIndex = null;
        foreach ($definition->getMethodCalls() as $k => $call) {
            if ($call[2] ?? false) {
                $lastWitherIndex = $k;
            }
        }

        if (!$isProxyCandidate && $definition->isShared() && !isset($this->singleUsePrivateIds[$id]) && null === $lastWitherIndex) {
            $instantiation = sprintf('$container->%s[%s] = %s', $this->container->getDefinition($id)->isPublic() ? 'services' : 'privates', $this->doExport($id), $isSimpleInstance ? '' : '$instance');
>>>>>>> Stashed changes
        } elseif (!$isSimpleInstance) {
            $instantiation = '$instance';
        }

        $return = '';
        if ($isSimpleInstance) {
            $return = 'return ';
        } else {
            $instantiation .= ' = ';
        }

<<<<<<< Updated upstream
        return $this->addNewInstance($definition, $return, $instantiation, $id);
=======
        return $this->addNewInstance($definition, '        '.$return.$instantiation, $id, $asGhostObject);
>>>>>>> Stashed changes
    }

    /**
     * Checks if the definition is a trivial instance.
     *
     * @return bool
     */
    private function isTrivialInstance(Definition $definition)
    {
        if ($definition->isSynthetic() || $definition->getFile() || $definition->getMethodCalls() || $definition->getProperties() || $definition->getConfigurator()) {
            return false;
        }
        if ($definition->isDeprecated() || $definition->isLazy() || $definition->getFactory() || 3 < \count($definition->getArguments())) {
            return false;
        }

        foreach ($definition->getArguments() as $arg) {
            if (!$arg || $arg instanceof Parameter) {
                continue;
            }
            if (\is_array($arg) && 3 >= \count($arg)) {
                foreach ($arg as $k => $v) {
                    if ($this->dumpValue($k) !== $this->dumpValue($k, false)) {
                        return false;
                    }
                    if (!$v || $v instanceof Parameter) {
                        continue;
                    }
                    if ($v instanceof Reference && $this->container->has($id = (string) $v) && $this->container->findDefinition($id)->isSynthetic()) {
                        continue;
                    }
                    if (!is_scalar($v) || $this->dumpValue($v) !== $this->dumpValue($v, false)) {
                        return false;
                    }
                }
            } elseif ($arg instanceof Reference && $this->container->has($id = (string) $arg) && $this->container->findDefinition($id)->isSynthetic()) {
                continue;
            } elseif (!is_scalar($arg) || $this->dumpValue($arg) !== $this->dumpValue($arg, false)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Adds method calls to a service definition.
     *
     * @param string $variableName
     *
     * @return string
     */
    private function addServiceMethodCalls(Definition $definition, $variableName = 'instance')
    {
        $calls = '';
        foreach ($definition->getMethodCalls() as $call) {
            $arguments = [];
            foreach ($call[1] as $value) {
                $arguments[] = $this->dumpValue($value);
            }

<<<<<<< Updated upstream
            $calls .= $this->wrapServiceConditionals($call[1], sprintf("        \$%s->%s(%s);\n", $variableName, $call[0], implode(', ', $arguments)));
=======
            $witherAssignation = '';

            if ($call[2] ?? false) {
                if (null !== $sharedNonLazyId && $lastWitherIndex === $k && 'instance' === $variableName) {
                    $witherAssignation = sprintf('$container->%s[\'%s\'] = ', $definition->isPublic() ? 'services' : 'privates', $sharedNonLazyId);
                }
                $witherAssignation .= sprintf('$%s = ', $variableName);
            }

            $calls .= $this->wrapServiceConditionals($call[1], sprintf("        %s\$%s->%s(%s);\n", $witherAssignation, $variableName, $call[0], implode(', ', $arguments)));
>>>>>>> Stashed changes
        }

        return $calls;
    }

    private function addServiceProperties(Definition $definition, $variableName = 'instance')
    {
        $code = '';
        foreach ($definition->getProperties() as $name => $value) {
            $code .= sprintf("        \$%s->%s = %s;\n", $variableName, $name, $this->dumpValue($value));
        }

        return $code;
    }

    /**
     * Adds configurator definition.
     *
     * @param string $variableName
     *
     * @return string
     */
    private function addServiceConfigurator(Definition $definition, $variableName = 'instance')
    {
        if (!$callable = $definition->getConfigurator()) {
            return '';
        }

        if (\is_array($callable)) {
            if ($callable[0] instanceof Reference
                || ($callable[0] instanceof Definition && $this->definitionVariables->contains($callable[0]))
            ) {
                return sprintf("        %s->%s(\$%s);\n", $this->dumpValue($callable[0]), $callable[1], $variableName);
            }

            $class = $this->dumpValue($callable[0]);
            // If the class is a string we can optimize call_user_func away
            if (0 === strpos($class, "'") && false === strpos($class, '$')) {
                return sprintf("        %s::%s(\$%s);\n", $this->dumpLiteralClass($class), $callable[1], $variableName);
            }

            if (0 === strpos($class, 'new ')) {
                return sprintf("        (%s)->%s(\$%s);\n", $this->dumpValue($callable[0]), $callable[1], $variableName);
            }

            return sprintf("        \\call_user_func([%s, '%s'], \$%s);\n", $this->dumpValue($callable[0]), $callable[1], $variableName);
        }

        return sprintf("        %s(\$%s);\n", $callable, $variableName);
    }

    /**
     * Adds a service.
     *
     * @param string $id
     * @param string &$file
     *
     * @return string
     */
    private function addService($id, Definition $definition, &$file = null)
    {
        $this->definitionVariables = new \SplObjectStorage();
        $this->referenceVariables = [];
        $this->variableCount = 0;
        $this->referenceVariables[$id] = new Variable('instance');

        $return = [];

        if ($class = $definition->getClass()) {
            $class = $class instanceof Parameter ? '%'.$class.'%' : $this->container->resolveEnvPlaceholders($class);
            $return[] = sprintf(0 === strpos($class, '%') ? '@return object A %1$s instance' : '@return \%s', ltrim($class, '\\'));
        } elseif ($definition->getFactory()) {
            $factory = $definition->getFactory();
            if (\is_string($factory) && !str_starts_with($factory, '@=')) {
                $return[] = sprintf('@return object An instance returned by %s()', $factory);
            } elseif (\is_array($factory) && (\is_string($factory[0]) || $factory[0] instanceof Definition || $factory[0] instanceof Reference)) {
                $class = $factory[0] instanceof Definition ? $factory[0]->getClass() : (string) $factory[0];
                $class = $class instanceof Parameter ? '%'.$class.'%' : $this->container->resolveEnvPlaceholders($class);
                $return[] = sprintf('@return object An instance returned by %s::%s()', $class, $factory[1]);
            }
        }

        if ($definition->isDeprecated()) {
            if ($return && 0 === strpos($return[\count($return) - 1], '@return')) {
                $return[] = '';
            }

            $deprecation = $definition->getDeprecation($id);
            $return[] = sprintf('@deprecated %s', ($deprecation['package'] || $deprecation['version'] ? "Since {$deprecation['package']} {$deprecation['version']}: " : '').$deprecation['message']);
        }

        $return = str_replace("\n     * \n", "\n     *\n", implode("\n     * ", $return));
        $return = $this->container->resolveEnvPlaceholders($return);

        $shared = $definition->isShared() ? ' shared' : '';
        $public = $definition->isPublic() ? 'public' : 'private';
        $autowired = $definition->isAutowired() ? ' autowired' : '';
        $asFile = $this->asFiles && !$this->inlineFactories && !$this->isHotPath($definition);
        $methodName = $this->generateMethodName($id);

        if ($asFile || $definition->isLazy()) {
            $lazyInitialization = ', $lazyLoad = true';
        } else {
            $lazyInitialization = '';
        }

<<<<<<< Updated upstream
        $asFile = $this->asFiles && $definition->isShared() && !$this->isHotPath($definition);
        $methodName = $this->generateMethodName($id);
        if ($asFile) {
            $file = $methodName.'.php';
            $code = "        // Returns the $public '$id'$shared$autowired service.\n\n";
        } else {
            $code = <<<EOF
=======
        $code = <<<EOF
>>>>>>> Stashed changes

    /*{$this->docStar}
     * Gets the $public '$id'$shared$autowired service.
     *
     * $return
EOF;
        $code = str_replace('*/', ' ', $code).<<<EOF

     */
    protected static function {$methodName}(\$container$lazyInitialization)
    {

EOF;

        if ($asFile) {
            $file = $methodName.'.php';
            $code = str_replace("protected static function {$methodName}(", 'public static function do(', $code);
        } else {
            $file = null;
        }

<<<<<<< Updated upstream
        $this->serviceCalls = [];
        $this->inlinedDefinitions = $this->getDefinitionsFromArguments([$definition], null, $this->serviceCalls);

        $code .= $this->addServiceInclude($id, $definition);

        if ($this->getProxyDumper()->isProxyCandidate($definition)) {
            $factoryCode = $asFile ? "\$this->load('%s.php', false)" : '$this->%s(false)';
            $code .= $this->getProxyDumper()->getProxyFactoryCode($definition, $id, sprintf($factoryCode, $methodName, $this->doExport($id)));
        }

        if ($definition->isDeprecated()) {
            $code .= sprintf("        @trigger_error(%s, E_USER_DEPRECATED);\n\n", $this->export($definition->getDeprecationMessage($id)));
        }

        $code .= $this->addInlineService($id, $definition);

        if ($asFile) {
            $code = implode("\n", array_map(function ($line) { return $line ? substr($line, 8) : $line; }, explode("\n", $code)));
        } else {
            $code .= "    }\n";
=======
        if ($definition->hasErrors() && $e = $definition->getErrors()) {
            $code .= sprintf("        throw new RuntimeException(%s);\n", $this->export(reset($e)));
        } else {
            $this->serviceCalls = [];
            $this->inlinedDefinitions = $this->getDefinitionsFromArguments([$definition], null, $this->serviceCalls);

            if ($definition->isDeprecated()) {
                $deprecation = $definition->getDeprecation($id);
                $code .= sprintf("        trigger_deprecation(%s, %s, %s);\n\n", $this->export($deprecation['package']), $this->export($deprecation['version']), $this->export($deprecation['message']));
            } elseif ($definition->hasTag($this->hotPathTag) || !$definition->hasTag($this->preloadTags[1])) {
                foreach ($this->inlinedDefinitions as $def) {
                    foreach ($this->getClasses($def, $id) as $class) {
                        $this->preload[$class] = $class;
                    }
                }
            }

            if (!$definition->isShared()) {
                $factory = sprintf('$container->factories%s[%s]', $definition->isPublic() ? '' : "['service_container']", $this->doExport($id));
            }

            $asGhostObject = false;
            if ($isProxyCandidate = $this->isProxyCandidate($definition, $asGhostObject, $id)) {
                $definition = $isProxyCandidate;

                if (!$definition->isShared()) {
                    $code .= sprintf('        %s ??= ', $factory);

                    if ($definition->isPublic()) {
                        $code .= sprintf("fn () => self::%s(\$container);\n\n", $asFile ? 'do' : $methodName);
                    } else {
                        $code .= sprintf("self::%s(...);\n\n", $asFile ? 'do' : $methodName);
                    }
                }
                $lazyLoad = $asGhostObject ? '$proxy' : 'false';

                $factoryCode = $asFile ? sprintf('self::do($container, %s)', $lazyLoad) : sprintf('self::%s($container, %s)', $methodName, $lazyLoad);
                $code .= $this->getProxyDumper()->getProxyFactoryCode($definition, $id, $factoryCode);
            }

            $c = $this->addServiceInclude($id, $definition, null !== $isProxyCandidate);

            if ('' !== $c && $isProxyCandidate && !$definition->isShared()) {
                $c = implode("\n", array_map(fn ($line) => $line ? '    '.$line : $line, explode("\n", $c)));
                $code .= "        static \$include = true;\n\n";
                $code .= "        if (\$include) {\n";
                $code .= $c;
                $code .= "            \$include = false;\n";
                $code .= "        }\n\n";
            } else {
                $code .= $c;
            }

            $c = $this->addInlineService($id, $definition);

            if (!$isProxyCandidate && !$definition->isShared()) {
                $c = implode("\n", array_map(fn ($line) => $line ? '    '.$line : $line, explode("\n", $c)));
                $lazyloadInitialization = $definition->isLazy() ? ', $lazyLoad = true' : '';

                $c = sprintf("        %s = function (\$container%s) {\n%s        };\n\n        return %1\$s(\$container);\n", $factory, $lazyloadInitialization, $c);
            }

            $code .= $c;
>>>>>>> Stashed changes
        }

        $code .= "    }\n";

        $this->definitionVariables = $this->inlinedDefinitions = null;
        $this->referenceVariables = $this->serviceCalls = null;

        return $code;
    }

    private function addInlineVariables($id, Definition $definition, array $arguments, $forConstructor)
    {
        $code = '';

        foreach ($arguments as $argument) {
            if (\is_array($argument)) {
                $code .= $this->addInlineVariables($id, $definition, $argument, $forConstructor);
            } elseif ($argument instanceof Reference) {
                $code .= $this->addInlineReference($id, $definition, $this->container->normalizeId($argument), $forConstructor);
            } elseif ($argument instanceof Definition) {
                $code .= $this->addInlineService($id, $definition, $argument, $forConstructor);
            }
        }

        return $code;
    }

    private function addInlineReference($id, Definition $definition, $targetId, $forConstructor)
    {
        while ($this->container->hasAlias($targetId)) {
            $targetId = (string) $this->container->getAlias($targetId);
        }

        list($callCount, $behavior) = $this->serviceCalls[$targetId];

        if ($id === $targetId) {
            return $this->addInlineService($id, $definition, $definition);
        }

        if ('service_container' === $targetId || isset($this->referenceVariables[$targetId])) {
            return '';
        }

<<<<<<< Updated upstream
        $hasSelfRef = isset($this->circularReferences[$id][$targetId]) && !isset($this->definitionVariables[$definition]);
=======
        if ($this->container->hasDefinition($targetId) && ($def = $this->container->getDefinition($targetId)) && !$def->isShared()) {
            return '';
        }

        $hasSelfRef = isset($this->circularReferences[$id][$targetId]) && !isset($this->definitionVariables[$definition]) && !($this->hasProxyDumper && $definition->isLazy());
>>>>>>> Stashed changes

        if ($hasSelfRef && !$forConstructor && !$forConstructor = !$this->circularReferences[$id][$targetId]) {
            $code = $this->addInlineService($id, $definition, $definition);
        } else {
            $code = '';
        }

        if (isset($this->referenceVariables[$targetId]) || (2 > $callCount && (!$hasSelfRef || !$forConstructor))) {
            return $code;
        }

        $name = $this->getNextVariableName();
        $this->referenceVariables[$targetId] = new Variable($name);

        $reference = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE >= $behavior ? new Reference($targetId, $behavior) : null;
        $code .= sprintf("        \$%s = %s;\n", $name, $this->getServiceCall($targetId, $reference));

        if (!$hasSelfRef || !$forConstructor) {
            return $code;
        }

        $code .= sprintf(<<<'EOTXT'

        if (isset($container->%s[%s])) {
            return $container->%1$s[%2$s];
        }

EOTXT
            ,
            'services',
            $this->doExport($id)
        );

        return $code;
    }

<<<<<<< Updated upstream
    private function addInlineService($id, Definition $definition, Definition $inlineDef = null, $forConstructor = true)
=======
    private function addInlineService(string $id, Definition $definition, ?Definition $inlineDef = null, bool $forConstructor = true): string
>>>>>>> Stashed changes
    {
        $code = '';

        if ($isSimpleInstance = $isRootInstance = null === $inlineDef) {
<<<<<<< Updated upstream
            foreach ($this->serviceCalls as $targetId => list($callCount, $behavior, $byConstructor)) {
                if ($byConstructor && isset($this->circularReferences[$id][$targetId]) && !$this->circularReferences[$id][$targetId]) {
=======
            foreach ($this->serviceCalls as $targetId => [$callCount, $behavior, $byConstructor]) {
                if ($byConstructor && isset($this->circularReferences[$id][$targetId]) && !$this->circularReferences[$id][$targetId] && !($this->hasProxyDumper && $definition->isLazy())) {
>>>>>>> Stashed changes
                    $code .= $this->addInlineReference($id, $definition, $targetId, $forConstructor);
                }
            }
        }

        if (isset($this->definitionVariables[$inlineDef ??= $definition])) {
            return $code;
        }

        $arguments = [$inlineDef->getArguments(), $inlineDef->getFactory()];

        $code .= $this->addInlineVariables($id, $definition, $arguments, $forConstructor);

        if ($arguments = array_filter([$inlineDef->getProperties(), $inlineDef->getMethodCalls(), $inlineDef->getConfigurator()])) {
            $isSimpleInstance = false;
        } elseif ($definition !== $inlineDef && 2 > $this->inlinedDefinitions[$inlineDef]) {
            return $code;
        }

        $asGhostObject = false;
        $isProxyCandidate = $this->isProxyCandidate($inlineDef, $asGhostObject, $id);

        if (isset($this->definitionVariables[$inlineDef])) {
            $isSimpleInstance = false;
        } else {
            $name = $definition === $inlineDef ? 'instance' : $this->getNextVariableName();
            $this->definitionVariables[$inlineDef] = new Variable($name);
            $code .= '' !== $code ? "\n" : '';

            if ('instance' === $name) {
                $code .= $this->addServiceInstance($id, $definition, $isSimpleInstance);
            } else {
                $code .= $this->addNewInstance($inlineDef, '$'.$name, ' = ', $id);
            }

            if ('' !== $inline = $this->addInlineVariables($id, $definition, $arguments, false)) {
                $code .= "\n".$inline."\n";
            } elseif ($arguments && 'instance' === $name) {
                $code .= "\n";
            }

            $code .= $this->addServiceProperties($inlineDef, $name);
<<<<<<< Updated upstream
            $code .= $this->addServiceMethodCalls($inlineDef, $name);
=======
            $code .= $this->addServiceMethodCalls($inlineDef, $name, !$isProxyCandidate && $inlineDef->isShared() && !isset($this->singleUsePrivateIds[$id]) ? $id : null);
>>>>>>> Stashed changes
            $code .= $this->addServiceConfigurator($inlineDef, $name);
        }

        if (!$isRootInstance || $isSimpleInstance) {
            return $code;
        }

        return $code."\n        return \$instance;\n";
    }

<<<<<<< Updated upstream
    /**
     * Adds multiple services.
     *
     * @return string
     */
    private function addServices()
=======
    private function addServices(?array &$services = null): string
>>>>>>> Stashed changes
    {
        $publicServices = $privateServices = '';
        $definitions = $this->container->getDefinitions();
        ksort($definitions);
        foreach ($definitions as $id => $definition) {
<<<<<<< Updated upstream
            if ($definition->isSynthetic() || ($this->asFiles && $definition->isShared() && !$this->isHotPath($definition))) {
=======
            if (!$definition->isSynthetic()) {
                $services[$id] = $this->addService($id, $definition);
            } elseif ($definition->hasTag($this->hotPathTag) || !$definition->hasTag($this->preloadTags[1])) {
                $services[$id] = null;

                foreach ($this->getClasses($definition, $id) as $class) {
                    $this->preload[$class] = $class;
                }
            }
        }

        foreach ($definitions as $id => $definition) {
            if (!([$file, $code] = $services[$id]) || null !== $file) {
>>>>>>> Stashed changes
                continue;
            }
            if ($definition->isPublic()) {
                $publicServices .= $this->addService($id, $definition);
            } else {
                $privateServices .= $this->addService($id, $definition);
            }
        }

        return $publicServices.$privateServices;
    }

    private function generateServiceFiles()
    {
        $definitions = $this->container->getDefinitions();
        ksort($definitions);
        foreach ($definitions as $id => $definition) {
<<<<<<< Updated upstream
            if (!$definition->isSynthetic() && $definition->isShared() && !$this->isHotPath($definition)) {
                $code = $this->addService($id, $definition, $file);
                yield $file => $code;
=======
            if (([$file, $code] = $services[$id]) && null !== $file && ($definition->isPublic() || !$this->isTrivialInstance($definition) || isset($this->locatedIds[$id]))) {
                yield $file => [$code, $definition->hasTag($this->hotPathTag) || !$definition->hasTag($this->preloadTags[1]) && !$definition->isDeprecated() && !$definition->hasErrors()];
>>>>>>> Stashed changes
            }
        }
    }

<<<<<<< Updated upstream
    private function addNewInstance(Definition $definition, $return, $instantiation, $id)
    {
        $class = $this->dumpValue($definition->getClass());
        $return = '        '.$return.$instantiation;
=======
    private function addNewInstance(Definition $definition, string $return = '', ?string $id = null, bool $asGhostObject = false): string
    {
        $tail = $return ? str_repeat(')', substr_count($return, '(') - substr_count($return, ')')).";\n" : '';

        if (BaseServiceLocator::class === $definition->getClass() && $definition->hasTag($this->serviceLocatorTag)) {
            $arguments = [];
            foreach ($definition->getArgument(0) as $k => $argument) {
                $arguments[$k] = $argument->getValues()[0];
            }

            return $return.$this->dumpValue(new ServiceLocatorArgument($arguments)).$tail;
        }
>>>>>>> Stashed changes

        $arguments = [];
        foreach ($definition->getArguments() as $value) {
            $arguments[] = $this->dumpValue($value);
        }

        if (null !== $definition->getFactory()) {
            $callable = $definition->getFactory();
<<<<<<< Updated upstream
            if (\is_array($callable)) {
                if (!preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $callable[1])) {
                    throw new RuntimeException(sprintf('Cannot dump definition because of invalid factory method (%s).', $callable[1] ?: 'n/a'));
                }

                if ($callable[0] instanceof Reference
                    || ($callable[0] instanceof Definition && $this->definitionVariables->contains($callable[0]))) {
                    return $return.sprintf("%s->%s(%s);\n", $this->dumpValue($callable[0]), $callable[1], $arguments ? implode(', ', $arguments) : '');
                }

                $class = $this->dumpValue($callable[0]);
                // If the class is a string we can optimize call_user_func away
                if (0 === strpos($class, "'") && false === strpos($class, '$')) {
                    if ("''" === $class) {
                        throw new RuntimeException(sprintf('Cannot dump definition: The "%s" service is defined to be created by a factory but is missing the service reference, did you forget to define the factory service id or class?', $id));
                    }

                    return $return.sprintf("%s::%s(%s);\n", $this->dumpLiteralClass($class), $callable[1], $arguments ? implode(', ', $arguments) : '');
=======

            if ('current' === $callable && [0] === array_keys($definition->getArguments()) && \is_array($value) && [0] === array_keys($value)) {
                return $return.$this->dumpValue($value[0]).$tail;
            }

            if (['Closure', 'fromCallable'] === $callable) {
                $callable = $definition->getArgument(0);
                if ($callable instanceof ServiceClosureArgument) {
                    return $return.$this->dumpValue($callable).$tail;
                }

                $arguments = ['...'];

                if ($callable instanceof Reference || $callable instanceof Definition) {
                    $callable = [$callable, '__invoke'];
>>>>>>> Stashed changes
                }
            }

            if (\is_string($callable) && str_starts_with($callable, '@=')) {
                return $return.sprintf('(($args = %s) ? (%s) : null)',
                    $this->dumpValue(new ServiceLocatorArgument($definition->getArguments())),
                    $this->getExpressionLanguage()->compile(substr($callable, 2), ['container' => 'container', 'args' => 'args'])
                ).$tail;
            }

<<<<<<< Updated upstream
                if (0 === strpos($class, 'new ')) {
                    return $return.sprintf("(%s)->%s(%s);\n", $class, $callable[1], $arguments ? implode(', ', $arguments) : '');
                }

                return $return.sprintf("\\call_user_func([%s, '%s']%s);\n", $class, $callable[1], $arguments ? ', '.implode(', ', $arguments) : '');
            }

            return $return.sprintf("%s(%s);\n", $this->dumpLiteralClass($this->dumpValue($callable)), $arguments ? implode(', ', $arguments) : '');
=======
            if (!\is_array($callable)) {
                return $return.sprintf('%s(%s)', $this->dumpLiteralClass($this->dumpValue($callable)), $arguments ? implode(', ', $arguments) : '').$tail;
            }

            if (!preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $callable[1])) {
                throw new RuntimeException(sprintf('Cannot dump definition because of invalid factory method (%s).', $callable[1] ?: 'n/a'));
            }

            if (['...'] === $arguments && ($definition->isLazy() || 'Closure' !== ($definition->getClass() ?? 'Closure')) && (
                $callable[0] instanceof Reference
                || ($callable[0] instanceof Definition && !$this->definitionVariables->contains($callable[0]))
            )) {
                $initializer = 'fn () => '.$this->dumpValue($callable[0]);

                return $return.LazyClosure::getCode($initializer, $callable, $definition, $this->container, $id).$tail;
            }

            if ($callable[0] instanceof Reference
                || ($callable[0] instanceof Definition && $this->definitionVariables->contains($callable[0]))
            ) {
                return $return.sprintf('%s->%s(%s)', $this->dumpValue($callable[0]), $callable[1], $arguments ? implode(', ', $arguments) : '').$tail;
            }

            $class = $this->dumpValue($callable[0]);
            // If the class is a string we can optimize away
            if (str_starts_with($class, "'") && !str_contains($class, '$')) {
                if ("''" === $class) {
                    throw new RuntimeException(sprintf('Cannot dump definition: "%s" service is defined to be created by a factory but is missing the service reference, did you forget to define the factory service id or class?', $id ? 'The "'.$id.'"' : 'inline'));
                }

                return $return.sprintf('%s::%s(%s)', $this->dumpLiteralClass($class), $callable[1], $arguments ? implode(', ', $arguments) : '').$tail;
            }

            if (str_starts_with($class, 'new ')) {
                return $return.sprintf('(%s)->%s(%s)', $class, $callable[1], $arguments ? implode(', ', $arguments) : '').$tail;
            }

            return $return.sprintf("[%s, '%s'](%s)", $class, $callable[1], $arguments ? implode(', ', $arguments) : '').$tail;
>>>>>>> Stashed changes
        }

        if (false !== strpos($class, '$')) {
            return sprintf("        \$class = %s;\n\n%snew \$class(%s);\n", $class, $return, implode(', ', $arguments));
        }

<<<<<<< Updated upstream
        return $return.sprintf("new %s(%s);\n", $this->dumpLiteralClass($class), implode(', ', $arguments));
    }

    /**
     * Adds the class headers.
     *
     * @param string $class                  Class name
     * @param string $baseClass              The name of the base class
     * @param string $baseClassWithNamespace Fully qualified base class name
     *
     * @return string
     */
    private function startClass($class, $baseClass, $baseClassWithNamespace)
=======
        if (!$asGhostObject) {
            return $return.sprintf('new %s(%s)', $this->dumpLiteralClass($this->dumpValue($class)), implode(', ', $arguments)).$tail;
        }

        if (!method_exists($this->container->getParameterBag()->resolveValue($class), '__construct')) {
            return $return.'$lazyLoad'.$tail;
        }

        return $return.sprintf('($lazyLoad->__construct(%s) && false ?: $lazyLoad)', implode(', ', $arguments)).$tail;
    }

    private function startClass(string $class, string $baseClass, bool $hasProxyClasses): string
>>>>>>> Stashed changes
    {
        $bagClass = $this->container->isCompiled() ? 'use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;' : 'use Symfony\Component\DependencyInjection\ParameterBag\\ParameterBag;';
        $namespaceLine = !$this->asFiles && $this->namespace ? "\nnamespace {$this->namespace};\n" : '';

        $code = <<<EOF
<?php
$namespaceLine
use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
$bagClass

/*{$this->docStar}
<<<<<<< Updated upstream
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class $class extends $baseClass
{
    private \$parameters = [];
    private \$targetDirs = [];
=======
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class $class extends $baseClass
{
    private const DEPRECATED_PARAMETERS = [];

    protected \$parameters = [];
>>>>>>> Stashed changes

    public function __construct()
    {

EOF;
<<<<<<< Updated upstream
        if (null !== $this->targetDirRegex) {
            $dir = $this->asFiles ? '$this->targetDirs[0] = \\dirname($containerDir)' : '__DIR__';
            $code .= <<<EOF
        \$dir = {$dir};
        for (\$i = 1; \$i <= {$this->targetDirMaxMatches}; ++\$i) {
            \$this->targetDirs[\$i] = \$dir = \\dirname(\$dir);
        }

EOF;
        }
        if ($this->asFiles) {
            $code = str_replace('$parameters', "\$buildParameters;\n    private \$containerDir;\n    private \$parameters", $code);
            $code = str_replace('__construct()', '__construct(array $buildParameters = [], $containerDir = __DIR__)', $code);
            $code .= "        \$this->buildParameters = \$buildParameters;\n";
            $code .= "        \$this->containerDir = \$containerDir;\n";
        }

        if ($this->container->isCompiled()) {
            if (Container::class !== $baseClassWithNamespace) {
                $r = $this->container->getReflectionClass($baseClassWithNamespace, false);
                if (null !== $r
                    && (null !== $constructor = $r->getConstructor())
                    && 0 === $constructor->getNumberOfRequiredParameters()
                    && Container::class !== $constructor->getDeclaringClass()->name
                ) {
                    $code .= "        parent::__construct();\n";
                    $code .= "        \$this->parameterBag = null;\n\n";
                }
=======
        $code = str_replace("    private const DEPRECATED_PARAMETERS = [];\n\n", $this->addDeprecatedParameters(), $code);
        if ($this->asFiles) {
            $code = str_replace('__construct()', '__construct(private array $buildParameters = [], protected string $containerDir = __DIR__)', $code);

            if (null !== $this->targetDirRegex) {
                $code = str_replace('$parameters = []', "\$targetDir;\n    protected \$parameters = []", $code);
                $code .= '        $this->targetDir = \\dirname($containerDir);'."\n";
>>>>>>> Stashed changes
            }

            if ($this->container->getParameterBag()->all()) {
                $code .= "        \$this->parameters = \$this->getDefaultParameters();\n\n";
            }

            $code .= "        \$this->services = [];\n";
        } else {
            $arguments = $this->container->getParameterBag()->all() ? 'new ParameterBag($this->getDefaultParameters())' : null;
            $code .= "        parent::__construct($arguments);\n";
        }

        $code .= $this->addNormalizedIds();
        $code .= $this->addSyntheticIds();
        $code .= $this->addMethodMap();
        $code .= $this->asFiles ? $this->addFileMap() : '';
        $code .= $this->addPrivateServices();
        $code .= $this->addAliases();
<<<<<<< Updated upstream
        $code .= $this->addInlineRequires();
        $code .= <<<'EOF'
=======
        $code .= $this->addInlineRequires($hasProxyClasses);
        $code .= <<<EOF
>>>>>>> Stashed changes
    }

EOF;
        $code .= $this->addRemovedIds();

        if ($this->container->isCompiled()) {
            $code .= <<<EOF

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function isFrozen()
    {
        @trigger_error(sprintf('The %s() method is deprecated since Symfony 3.3 and will be removed in 4.0. Use the isCompiled() method instead.', __METHOD__), E_USER_DEPRECATED);

        return true;
    }

EOF;
        }

<<<<<<< Updated upstream
        if ($this->asFiles) {
            $code .= <<<EOF
=======
        if ($this->asFiles && !$this->inlineFactories) {
            $code .= <<<'EOF'
>>>>>>> Stashed changes

    protected function load($file, $lazyLoad = true): mixed
    {
        if (class_exists($class = __NAMESPACE__.'\\'.$file, false)) {
            return $class::do($this, $lazyLoad);
        }

        if ('.' === $file[-4]) {
            $class = substr($class, 0, -4);
        } else {
            $file .= '.php';
        }

        $service = require $this->containerDir.\DIRECTORY_SEPARATOR.$file;

        return class_exists($class, false) ? $class::do($this, $lazyLoad) : $service;
    }

EOF;
        }

        foreach ($this->container->getDefinitions() as $definition) {
            if (!$definition->isLazy() || !$this->hasProxyDumper) {
                continue;
            }
<<<<<<< Updated upstream
            if ($this->asFiles) {
                $proxyLoader = '$this->load("{$class}.php")';
            } elseif ($this->namespace) {
                $proxyLoader = 'class_alias("'.$this->namespace.'\\\\{$class}", $class, false)';
=======

            if ($this->asFiles && !$this->inlineFactories) {
                $proxyLoader = "class_exists(\$class, false) || require __DIR__.'/'.\$class.'.php';\n\n        ";
>>>>>>> Stashed changes
            } else {
                $proxyLoader = '';
            }

            $code .= <<<EOF

    protected function createProxy(\$class, \Closure \$factory)
    {
        {$proxyLoader}return \$factory();
    }

EOF;
            break;
        }

        return $code;
    }

    /**
     * Adds the normalizedIds property definition.
     *
     * @return string
     */
    private function addNormalizedIds()
    {
        $code = '';
        $normalizedIds = $this->container->getNormalizedIds();
        ksort($normalizedIds);
        foreach ($normalizedIds as $id => $normalizedId) {
            if ($this->container->has($normalizedId)) {
                $code .= '            '.$this->doExport($id).' => '.$this->doExport($normalizedId).",\n";
            }
        }

        return $code ? "        \$this->normalizedIds = [\n".$code."        ];\n" : '';
    }

    /**
     * Adds the syntheticIds definition.
     *
     * @return string
     */
    private function addSyntheticIds()
    {
        $code = '';
        $definitions = $this->container->getDefinitions();
        ksort($definitions);
        foreach ($definitions as $id => $definition) {
            if ($definition->isSynthetic() && 'service_container' !== $id) {
                $code .= '            '.$this->doExport($id)." => true,\n";
            }
        }

        return $code ? "        \$this->syntheticIds = [\n{$code}        ];\n" : '';
    }

    /**
     * Adds the removedIds definition.
     *
     * @return string
     */
    private function addRemovedIds()
    {
        if (!$ids = $this->container->getRemovedIds()) {
            return '';
        }
        if ($this->asFiles) {
            $code = "require \$this->containerDir.\\DIRECTORY_SEPARATOR.'removed-ids.php'";
        } else {
            $code = '';
            $ids = array_keys($ids);
            sort($ids);
            foreach ($ids as $id) {
                if (preg_match('/^\d+_[^~]++~[._a-zA-Z\d]{7}$/', $id)) {
                    continue;
                }
                $code .= '            '.$this->doExport($id)." => true,\n";
            }

            $code = "[\n{$code}        ]";
        }

        return <<<EOF

    public function getRemovedIds()
    {
        return {$code};
    }

EOF;
    }

<<<<<<< Updated upstream
    /**
     * Adds the methodMap property definition.
     *
     * @return string
     */
    private function addMethodMap()
=======
    private function addDeprecatedParameters(): string
    {
        if (!($bag = $this->container->getParameterBag()) instanceof ParameterBag) {
            return '';
        }

        if (!$deprecated = $bag->allDeprecated()) {
            return '';
        }
        $code = '';
        ksort($deprecated);
        foreach ($deprecated as $param => $deprecation) {
            $code .= '        '.$this->doExport($param).' => ['.implode(', ', array_map($this->doExport(...), $deprecation))."],\n";
        }

        return "    private const DEPRECATED_PARAMETERS = [\n{$code}    ];\n\n";
    }

    private function addMethodMap(): string
>>>>>>> Stashed changes
    {
        $code = '';
        $definitions = $this->container->getDefinitions();
        ksort($definitions);
        foreach ($definitions as $id => $definition) {
            if (!$definition->isSynthetic() && (!$this->asFiles || !$definition->isShared() || $this->isHotPath($definition))) {
                $code .= '            '.$this->doExport($id).' => '.$this->doExport($this->generateMethodName($id)).",\n";
            }
        }

        return $code ? "        \$this->methodMap = [\n{$code}        ];\n" : '';
    }

    /**
     * Adds the fileMap property definition.
     *
     * @return string
     */
    private function addFileMap()
    {
        $code = '';
        $definitions = $this->container->getDefinitions();
        ksort($definitions);
        foreach ($definitions as $id => $definition) {
<<<<<<< Updated upstream
            if (!$definition->isSynthetic() && $definition->isShared() && !$this->isHotPath($definition)) {
                $code .= sprintf("            %s => '%s.php',\n", $this->doExport($id), $this->generateMethodName($id));
=======
            if (!$definition->isSynthetic() && $definition->isPublic() && !$this->isHotPath($definition)) {
                $code .= sprintf("            %s => '%s',\n", $this->doExport($id), $this->generateMethodName($id));
>>>>>>> Stashed changes
            }
        }

        return $code ? "        \$this->fileMap = [\n{$code}        ];\n" : '';
    }

    /**
     * Adds the privates property definition.
     *
     * @return string
     */
    private function addPrivateServices()
    {
        $code = '';

        $aliases = $this->container->getAliases();
        ksort($aliases);
        foreach ($aliases as $id => $alias) {
            if ($alias->isPrivate()) {
                $code .= '            '.$this->doExport($id)." => true,\n";
            }
        }

        $definitions = $this->container->getDefinitions();
        ksort($definitions);
        foreach ($definitions as $id => $definition) {
            if (!$definition->isPublic()) {
                $code .= '            '.$this->doExport($id)." => true,\n";
            }
        }

        if (empty($code)) {
            return '';
        }

<<<<<<< Updated upstream
        $out = "        \$this->privates = [\n";
        $out .= $code;
        $out .= "        ];\n";
=======
    private function addDeprecatedAliases(): string
    {
        $code = '';
        $aliases = $this->container->getAliases();
        foreach ($aliases as $alias => $definition) {
            if (!$definition->isDeprecated()) {
                continue;
            }
            $public = $definition->isPublic() ? 'public' : 'private';
            $id = (string) $definition;
            $methodNameAlias = $this->generateMethodName($alias);
            $idExported = $this->export($id);
            $deprecation = $definition->getDeprecation($alias);
            $packageExported = $this->export($deprecation['package']);
            $versionExported = $this->export($deprecation['version']);
            $messageExported = $this->export($deprecation['message']);
            $code .= <<<EOF
>>>>>>> Stashed changes

        return $out;
    }

    /**
     * Adds the aliases property definition.
     *
     * @return string
     */
<<<<<<< Updated upstream
    private function addAliases()
    {
        if (!$aliases = $this->container->getAliases()) {
            return $this->container->isCompiled() ? "\n        \$this->aliases = [];\n" : '';
        }
=======
    protected static function {$methodNameAlias}(\$container)
    {
        trigger_deprecation($packageExported, $versionExported, $messageExported);

        return \$container->get($idExported);
    }
>>>>>>> Stashed changes

        $code = "        \$this->aliases = [\n";
        ksort($aliases);
        foreach ($aliases as $alias => $id) {
            $id = $this->container->normalizeId($id);
            while (isset($aliases[$id])) {
                $id = $this->container->normalizeId($aliases[$id]);
            }
            $code .= '            '.$this->doExport($alias).' => '.$this->doExport($id).",\n";
        }

        return $code."        ];\n";
    }

<<<<<<< Updated upstream
    private function addInlineRequires()
=======
    private function addInlineRequires(bool $hasProxyClasses): string
>>>>>>> Stashed changes
    {
        $lineage = [];
        $hotPathServices = $this->hotPathTag && $this->inlineRequires ? $this->container->findTaggedServiceIds($this->hotPathTag) : [];

        foreach ($hotPathServices as $id => $tags) {
            $definition = $this->container->getDefinition($id);
<<<<<<< Updated upstream
            $inlinedDefinitions = $this->getDefinitionsFromArguments([$definition]);

            foreach ($inlinedDefinitions as $def) {
                if (\is_string($class = \is_array($factory = $def->getFactory()) && \is_string($factory[0]) ? $factory[0] : $def->getClass())) {
=======

            if ($definition->isLazy() && $this->hasProxyDumper) {
                continue;
            }

            $inlinedDefinitions = $this->getDefinitionsFromArguments([$definition]);

            foreach ($inlinedDefinitions as $def) {
                foreach ($this->getClasses($def, $id) as $class) {
>>>>>>> Stashed changes
                    $this->collectLineage($class, $lineage);
                }
            }
        }

        $code = '';

        foreach ($lineage as $file) {
            if (!isset($this->inlinedRequires[$file])) {
                $this->inlinedRequires[$file] = true;
                $code .= sprintf("\n            include_once %s;", $file);
            }
        }

        if ($hasProxyClasses) {
            $code .= "\n            include_once __DIR__.'/proxy-classes.php';";
        }

        return $code ? sprintf("\n        \$this->privates['service_container'] = static function (\$container) {%s\n        };\n", $code) : '';
    }

    /**
     * Adds default parameters method.
     *
     * @return string
     */
    private function addDefaultParametersMethod()
    {
        if (!$this->container->getParameterBag()->all()) {
            return '';
        }

        $php = [];
        $dynamicPhp = [];
        $normalizedParams = [];

        foreach ($this->container->getParameterBag()->all() as $key => $value) {
            if ($key !== $resolvedKey = $this->container->resolveEnvPlaceholders($key)) {
                throw new InvalidArgumentException(sprintf('Parameter name cannot use env parameters: "%s".', $resolvedKey));
            }
            if ($key !== $lcKey = strtolower($key)) {
                $normalizedParams[] = sprintf('        %s => %s,', $this->export($lcKey), $this->export($key));
            }
            $export = $this->exportParameters([$value]);
            $export = explode('0 => ', substr(rtrim($export, " ]\n"), 2, -1), 2);

<<<<<<< Updated upstream
            if (preg_match("/\\\$this->(?:getEnv\('(?:\w++:)*+\w++'\)|targetDirs\[\d++\])/", $export[1])) {
                $dynamicPhp[$key] = sprintf('%scase %s: $value = %s; break;', $export[0], $this->export($key), $export[1]);
=======
            if ($hasEnum || preg_match("/\\\$container->(?:getEnv\('(?:[-.\w\\\\]*+:)*+\w*+'\)|targetDir\.'')/", $export[1])) {
                $dynamicPhp[$key] = sprintf('%s%s => %s,', $export[0], $this->export($key), $export[1]);
                $this->dynamicParameters[$key] = true;
>>>>>>> Stashed changes
            } else {
                $php[] = sprintf('%s%s => %s,', $export[0], $this->export($key), $export[1]);
            }
        }

        $parameters = sprintf("[\n%s\n%s]", implode("\n", $php), str_repeat(' ', 8));

        $code = '';
        if ($this->container->isCompiled()) {
            $code .= <<<'EOF'

<<<<<<< Updated upstream
    public function getParameter($name)
=======
    public function getParameter(string $name): array|bool|string|int|float|\UnitEnum|null
>>>>>>> Stashed changes
    {
        if (isset(self::DEPRECATED_PARAMETERS[$name])) {
            trigger_deprecation(...self::DEPRECATED_PARAMETERS[$name]);
        }

        if (isset($this->buildParameters[$name])) {
            return $this->buildParameters[$name];
        }
<<<<<<< Updated upstream
        if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters))) {
            $name = $this->normalizeParameterName($name);

            if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters))) {
                throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
            }
=======

        if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || \array_key_exists($name, $this->parameters))) {
            throw new ParameterNotFoundException($name);
>>>>>>> Stashed changes
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

<<<<<<< Updated upstream
    public function hasParameter($name)
=======
    public function hasParameter(string $name): bool
>>>>>>> Stashed changes
    {
        if (isset($this->buildParameters[$name])) {
            return true;
        }
        $name = $this->normalizeParameterName($name);

        return isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || \array_key_exists($name, $this->parameters);
    }

<<<<<<< Updated upstream
    public function setParameter($name, $value)
=======
    public function setParameter(string $name, $value): void
>>>>>>> Stashed changes
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    public function getParameterBag()
    {
        if (!isset($this->parameterBag)) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            foreach ($this->buildParameters as $name => $value) {
                $parameters[$name] = $value;
            }
            $this->parameterBag = new FrozenParameterBag($parameters, self::DEPRECATED_PARAMETERS);
        }

        return $this->parameterBag;
    }

EOF;
<<<<<<< Updated upstream
            if (!$this->asFiles) {
                $code = preg_replace('/^.*buildParameters.*\n.*\n.*\n/m', '', $code);
            }

            if ($dynamicPhp) {
                $loadedDynamicParameters = $this->exportParameters(array_combine(array_keys($dynamicPhp), array_fill(0, \count($dynamicPhp), false)), '', 8);
                $getDynamicParameter = <<<'EOF'
        switch ($name) {
=======

        if (!$this->asFiles) {
            $code = preg_replace('/^.*buildParameters.*\n.*\n.*\n\n?/m', '', $code);
        }

        if (!($bag = $this->container->getParameterBag()) instanceof ParameterBag || !$bag->allDeprecated()) {
            $code = preg_replace("/\n.*DEPRECATED_PARAMETERS.*\n.*\n.*\n/m", '', $code, 1);
            $code = str_replace(', self::DEPRECATED_PARAMETERS', '', $code);
        }

        if ($dynamicPhp) {
            $loadedDynamicParameters = $this->exportParameters(array_combine(array_keys($dynamicPhp), array_fill(0, \count($dynamicPhp), false)), '', 8);
            $getDynamicParameter = <<<'EOF'
        $container = $this;
        $value = match ($name) {
>>>>>>> Stashed changes
%s
            default => throw new ParameterNotFoundException($name),
        };
        $this->loadedDynamicParameters[$name] = true;

        return $this->dynamicParameters[$name] = $value;
EOF;
<<<<<<< Updated upstream
                $getDynamicParameter = sprintf($getDynamicParameter, implode("\n", $dynamicPhp));
            } else {
                $loadedDynamicParameters = '[]';
                $getDynamicParameter = str_repeat(' ', 8).'throw new InvalidArgumentException(sprintf(\'The dynamic parameter "%s" must be defined.\', $name));';
            }
=======
            $getDynamicParameter = sprintf($getDynamicParameter, implode("\n", $dynamicPhp));
        } else {
            $loadedDynamicParameters = '[]';
            $getDynamicParameter = str_repeat(' ', 8).'throw new ParameterNotFoundException($name);';
        }
>>>>>>> Stashed changes

            $code .= <<<EOF

    private \$loadedDynamicParameters = {$loadedDynamicParameters};
    private \$dynamicParameters = [];

    /*{$this->docStar}
     * Computes a dynamic parameter.
     *
     * @param string \$name The name of the dynamic parameter to load
     *
     * @return mixed The value of the dynamic parameter
     *
     * @throws InvalidArgumentException When the dynamic parameter does not exist
     */
    private function getDynamicParameter(\$name)
    {
{$getDynamicParameter}
    }


EOF;

            $code .= '    private $normalizedParameterNames = '.($normalizedParams ? sprintf("[\n%s\n    ];", implode("\n", $normalizedParams)) : '[];')."\n";
            $code .= <<<'EOF'

    private function normalizeParameterName($name)
    {
        if (isset($this->normalizedParameterNames[$normalizedName = strtolower($name)]) || isset($this->parameters[$normalizedName]) || array_key_exists($normalizedName, $this->parameters)) {
            $normalizedName = isset($this->normalizedParameterNames[$normalizedName]) ? $this->normalizedParameterNames[$normalizedName] : $normalizedName;
            if ((string) $name !== $normalizedName) {
                @trigger_error(sprintf('Parameter names will be made case sensitive in Symfony 4.0. Using "%s" instead of "%s" is deprecated since Symfony 3.4.', $name, $normalizedName), E_USER_DEPRECATED);
            }
        } else {
            $normalizedName = $this->normalizedParameterNames[$normalizedName] = (string) $name;
        }

        return $normalizedName;
    }

EOF;
        } elseif ($dynamicPhp) {
            throw new RuntimeException('You cannot dump a not-frozen container with dynamic parameters.');
        }

        $code .= <<<EOF

    /*{$this->docStar}
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return $parameters;
    }

EOF;

        return $code;
    }

    /**
     * Exports parameters.
     *
     * @param string $path
     * @param int    $indent
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    private function exportParameters(array $parameters, $path = '', $indent = 12)
    {
        $php = [];
        foreach ($parameters as $key => $value) {
            if (\is_array($value)) {
                $value = $this->exportParameters($value, $path.'/'.$key, $indent + 4);
            } elseif ($value instanceof ArgumentInterface) {
                throw new InvalidArgumentException(sprintf('You cannot dump a container with parameters that contain special arguments. "%s" found in "%s".', get_debug_type($value), $path.'/'.$key));
            } elseif ($value instanceof Variable) {
                throw new InvalidArgumentException(sprintf('You cannot dump a container with parameters that contain variable references. Variable "%s" found in "%s".', $value, $path.'/'.$key));
            } elseif ($value instanceof Definition) {
                throw new InvalidArgumentException(sprintf('You cannot dump a container with parameters that contain service definitions. Definition for "%s" found in "%s".', $value->getClass(), $path.'/'.$key));
            } elseif ($value instanceof Reference) {
                throw new InvalidArgumentException(sprintf('You cannot dump a container with parameters that contain references to other services (reference to service "%s" found in "%s").', $value, $path.'/'.$key));
            } elseif ($value instanceof Expression) {
                throw new InvalidArgumentException(sprintf('You cannot dump a container with parameters that contain expressions. Expression "%s" found in "%s".', $value, $path.'/'.$key));
<<<<<<< Updated upstream
=======
            } elseif ($value instanceof \UnitEnum) {
                $hasEnum = true;
                $value = sprintf('\%s::%s', $value::class, $value->name);
>>>>>>> Stashed changes
            } else {
                $value = $this->export($value);
            }

            $php[] = sprintf('%s%s => %s,', str_repeat(' ', $indent), $this->export($key), $value);
        }

        return sprintf("[\n%s\n%s]", implode("\n", $php), str_repeat(' ', $indent - 4));
    }

<<<<<<< Updated upstream
    /**
     * Ends the class definition.
     *
     * @return string
     */
    private function endClass()
=======
    private function endClass(): string
>>>>>>> Stashed changes
    {
        return <<<'EOF'
}

EOF;
    }

<<<<<<< Updated upstream
    /**
     * Wraps the service conditionals.
     *
     * @param string $value
     * @param string $code
     *
     * @return string
     */
    private function wrapServiceConditionals($value, $code)
=======
    private function wrapServiceConditionals(mixed $value, string $code): string
>>>>>>> Stashed changes
    {
        if (!$condition = $this->getServiceConditionals($value)) {
            return $code;
        }

        // re-indent the wrapped code
        $code = implode("\n", array_map(fn ($line) => $line ? '    '.$line : $line, explode("\n", $code)));

        return sprintf("        if (%s) {\n%s        }\n", $condition, $code);
    }

<<<<<<< Updated upstream
    /**
     * Get the conditions to execute for conditional services.
     *
     * @param string $value
     *
     * @return string|null
     */
    private function getServiceConditionals($value)
=======
    private function getServiceConditionals(mixed $value): string
>>>>>>> Stashed changes
    {
        $conditions = [];
        foreach (ContainerBuilder::getInitializedConditionals($value) as $service) {
            if (!$this->container->hasDefinition($service)) {
                return 'false';
            }
<<<<<<< Updated upstream
            $conditions[] = sprintf('isset($this->services[%s])', $this->doExport($service));
=======
            $conditions[] = sprintf('isset($container->%s[%s])', $this->container->getDefinition($service)->isPublic() ? 'services' : 'privates', $this->doExport($service));
>>>>>>> Stashed changes
        }
        foreach (ContainerBuilder::getServiceConditionals($value) as $service) {
            if ($this->container->hasDefinition($service) && !$this->container->getDefinition($service)->isPublic()) {
                continue;
            }

            $conditions[] = sprintf('$container->has(%s)', $this->doExport($service));
        }

        if (!$conditions) {
            return '';
        }

        return implode(' && ', $conditions);
    }

<<<<<<< Updated upstream
    private function getDefinitionsFromArguments(array $arguments, \SplObjectStorage $definitions = null, array &$calls = [], $byConstructor = null)
=======
    private function getDefinitionsFromArguments(array $arguments, ?\SplObjectStorage $definitions = null, array &$calls = [], ?bool $byConstructor = null): \SplObjectStorage
>>>>>>> Stashed changes
    {
        $definitions ??= new \SplObjectStorage();

        foreach ($arguments as $argument) {
            if (\is_array($argument)) {
                $this->getDefinitionsFromArguments($argument, $definitions, $calls, $byConstructor);
            } elseif ($argument instanceof Reference) {
                $id = $this->container->normalizeId($argument);

                while ($this->container->hasAlias($id)) {
                    $id = (string) $this->container->getAlias($id);
                }

                if (!isset($calls[$id])) {
                    $calls[$id] = [0, $argument->getInvalidBehavior(), $byConstructor];
                } else {
                    $calls[$id][1] = min($calls[$id][1], $argument->getInvalidBehavior());
                }

                ++$calls[$id][0];
            } elseif (!$argument instanceof Definition) {
                // no-op
            } elseif (isset($definitions[$argument])) {
                $definitions[$argument] = 1 + $definitions[$argument];
            } else {
                $definitions[$argument] = 1;
                $arguments = [$argument->getArguments(), $argument->getFactory()];
                $this->getDefinitionsFromArguments($arguments, $definitions, $calls, null === $byConstructor || $byConstructor);
                $arguments = [$argument->getProperties(), $argument->getMethodCalls(), $argument->getConfigurator()];
                $this->getDefinitionsFromArguments($arguments, $definitions, $calls, null !== $byConstructor && $byConstructor);
            }
        }

        return $definitions;
    }

    /**
     * Dumps values.
     *
     * @param mixed $value
     * @param bool  $interpolate
     *
     * @return string
     *
     * @throws RuntimeException
     */
<<<<<<< Updated upstream
    private function dumpValue($value, $interpolate = true)
=======
    private function dumpValue(mixed $value, bool $interpolate = true): string
>>>>>>> Stashed changes
    {
        if (\is_array($value)) {
            if ($value && $interpolate && false !== $param = array_search($value, $this->container->getParameterBag()->all(), true)) {
                return $this->dumpValue("%$param%");
            }
            $isList = array_is_list($value);
            $code = [];
            foreach ($value as $k => $v) {
                $code[] = $isList ? $this->dumpValue($v, $interpolate) : sprintf('%s => %s', $this->dumpValue($k, $interpolate), $this->dumpValue($v, $interpolate));
            }

            return sprintf('[%s]', implode(', ', $code));
        } elseif ($value instanceof ArgumentInterface) {
            $scope = [$this->definitionVariables, $this->referenceVariables];
            $this->definitionVariables = $this->referenceVariables = null;

            try {
                if ($value instanceof ServiceClosureArgument) {
                    $value = $value->getValues()[0];
                    $code = $this->dumpValue($value, $interpolate);

                    if ($value instanceof TypedReference) {
<<<<<<< Updated upstream
                        $code = sprintf('$f = function (\\%s $v%s) { return $v; }; return $f(%s);', $value->getType(), ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE !== $value->getInvalidBehavior() ? ' = null' : '', $code);
                    } else {
                        $code = sprintf('return %s;', $code);
                    }

                    return sprintf("function () {\n            %s\n        }", $code);
=======
                        $returnedType = sprintf(': %s\%s', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE >= $value->getInvalidBehavior() ? '' : '?', str_replace(['|', '&'], ['|\\', '&\\'], $value->getType()));
                    }

                    $attribute = '';
                    if ($value instanceof Reference) {
                        $attribute = 'name: '.$this->dumpValue((string) $value, $interpolate);

                        if ($this->container->hasDefinition($value) && ($class = $this->container->findDefinition($value)->getClass()) && $class !== (string) $value) {
                            $attribute .= ', class: '.$this->dumpValue($class, $interpolate);
                        }

                        $attribute = sprintf('#[\Closure(%s)] ', $attribute);
                    }

                    return sprintf('%sfn ()%s => %s', $attribute, $returnedType, $code);
>>>>>>> Stashed changes
                }

                if ($value instanceof IteratorArgument) {
                    if (!$values = $value->getValues()) {
                        return 'new RewindableGenerator(fn () => new \EmptyIterator(), 0)';
                    }

                    $code = [];
                    $code[] = 'new RewindableGenerator(function () use ($container) {';

                    $operands = [0];
                    foreach ($values as $k => $v) {
                        ($c = $this->getServiceConditionals($v)) ? $operands[] = "(int) ($c)" : ++$operands[0];
                        $v = $this->wrapServiceConditionals($v, sprintf("        yield %s => %s;\n", $this->dumpValue($k, $interpolate), $this->dumpValue($v, $interpolate)));
                        foreach (explode("\n", $v) as $v) {
                            if ($v) {
                                $code[] = '    '.$v;
                            }
                        }
                    }

                    $code[] = sprintf('        }, %s)', \count($operands) > 1 ? 'fn () => '.implode(' + ', $operands) : $operands[0]);

                    return implode("\n", $code);
                }
<<<<<<< Updated upstream
=======

                if ($value instanceof ServiceLocatorArgument) {
                    $serviceMap = '';
                    $serviceTypes = '';
                    foreach ($value->getValues() as $k => $v) {
                        if (!$v instanceof Reference) {
                            $serviceMap .= sprintf("\n            %s => [%s],", $this->export($k), $this->dumpValue($v));
                            $serviceTypes .= sprintf("\n            %s => '?',", $this->export($k));
                            continue;
                        }
                        $id = (string) $v;
                        while ($this->container->hasAlias($id)) {
                            $id = (string) $this->container->getAlias($id);
                        }
                        $definition = $this->container->getDefinition($id);
                        $load = !($definition->hasErrors() && $e = $definition->getErrors()) ? $this->asFiles && !$this->inlineFactories && !$this->isHotPath($definition) : reset($e);
                        $serviceMap .= sprintf("\n            %s => [%s, %s, %s, %s],",
                            $this->export($k),
                            $this->export($definition->isShared() ? ($definition->isPublic() ? 'services' : 'privates') : false),
                            $this->doExport($id),
                            $this->export(ContainerInterface::IGNORE_ON_UNINITIALIZED_REFERENCE !== $v->getInvalidBehavior() && !\is_string($load) ? $this->generateMethodName($id) : null),
                            $this->export($load)
                        );
                        $serviceTypes .= sprintf("\n            %s => %s,", $this->export($k), $this->export($v instanceof TypedReference ? $v->getType() : '?'));
                        $this->locatedIds[$id] = true;
                    }
                    $this->addGetService = true;

                    return sprintf('new \%s($container->getService ??= $container->getService(...), [%s%s], [%s%s])', ServiceLocator::class, $serviceMap, $serviceMap ? "\n        " : '', $serviceTypes, $serviceTypes ? "\n        " : '');
                }
>>>>>>> Stashed changes
            } finally {
                list($this->definitionVariables, $this->referenceVariables) = $scope;
            }
        } elseif ($value instanceof Definition) {
<<<<<<< Updated upstream
            if (null !== $this->definitionVariables && $this->definitionVariables->contains($value)) {
=======
            if ($value->hasErrors() && $e = $value->getErrors()) {
                return sprintf('throw new RuntimeException(%s)', $this->export(reset($e)));
            }
            if ($this->definitionVariables?->contains($value)) {
>>>>>>> Stashed changes
                return $this->dumpValue($this->definitionVariables[$value], $interpolate);
            }
            if ($value->getMethodCalls()) {
                throw new RuntimeException('Cannot dump definitions which have method calls.');
            }
            if ($value->getProperties()) {
                throw new RuntimeException('Cannot dump definitions which have properties.');
            }
            if (null !== $value->getConfigurator()) {
                throw new RuntimeException('Cannot dump definitions which have a configurator.');
            }

            $arguments = [];
            foreach ($value->getArguments() as $argument) {
                $arguments[] = $this->dumpValue($argument);
            }

            if (null !== $value->getFactory()) {
                $factory = $value->getFactory();

                if (\is_string($factory)) {
                    return sprintf('%s(%s)', $this->dumpLiteralClass($this->dumpValue($factory)), implode(', ', $arguments));
                }

                if (\is_array($factory)) {
                    if (!preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $factory[1])) {
                        throw new RuntimeException(sprintf('Cannot dump definition because of invalid factory method (%s).', $factory[1] ?: 'n/a'));
                    }

                    $class = $this->dumpValue($factory[0]);
                    if (\is_string($factory[0])) {
                        return sprintf('%s::%s(%s)', $this->dumpLiteralClass($class), $factory[1], implode(', ', $arguments));
                    }

                    if ($factory[0] instanceof Definition) {
                        if (0 === strpos($class, 'new ')) {
                            return sprintf('(%s)->%s(%s)', $class, $factory[1], implode(', ', $arguments));
                        }

                        return sprintf("\\call_user_func([%s, '%s']%s)", $class, $factory[1], \count($arguments) > 0 ? ', '.implode(', ', $arguments) : '');
                    }

                    if ($factory[0] instanceof Reference) {
                        return sprintf('%s->%s(%s)', $class, $factory[1], implode(', ', $arguments));
                    }
                }

                throw new RuntimeException('Cannot dump definition because of invalid factory.');
            }

            $class = $value->getClass();
            if (null === $class) {
                throw new RuntimeException('Cannot dump definitions which have no class nor factory.');
            }

            return sprintf('new %s(%s)', $this->dumpLiteralClass($this->dumpValue($class)), implode(', ', $arguments));
        } elseif ($value instanceof Variable) {
            return '$'.$value;
        } elseif ($value instanceof Reference) {
            $id = $this->container->normalizeId($value);

            while ($this->container->hasAlias($id)) {
                $id = (string) $this->container->getAlias($id);
            }

            if (null !== $this->referenceVariables && isset($this->referenceVariables[$id])) {
                return $this->dumpValue($this->referenceVariables[$id], $interpolate);
            }

            return $this->getServiceCall($id, $value);
        } elseif ($value instanceof Expression) {
            return $this->getExpressionLanguage()->compile((string) $value, ['container' => 'container']);
        } elseif ($value instanceof Parameter) {
            return $this->dumpParameter($value);
        } elseif (true === $interpolate && \is_string($value)) {
            if (preg_match('/^%([^%]+)%$/', $value, $match)) {
                // we do this to deal with non string values (Boolean, integer, ...)
                // the preg_replace_callback converts them to strings
                return $this->dumpParameter($match[1]);
            } else {
                $replaceParameters = fn ($match) => "'.".$this->dumpParameter($match[2]).".'";

                $code = str_replace('%%', '%', preg_replace_callback('/(?<!%)(%)([^%]+)\1/', $replaceParameters, $this->export($value)));

                return $code;
            }
<<<<<<< Updated upstream
=======
        } elseif ($value instanceof \UnitEnum) {
            return sprintf('\%s::%s', $value::class, $value->name);
        } elseif ($value instanceof AbstractArgument) {
            throw new RuntimeException($value->getTextWithContext());
>>>>>>> Stashed changes
        } elseif (\is_object($value) || \is_resource($value)) {
            throw new RuntimeException(sprintf('Unable to dump a service container if a parameter is an object or a resource, got "%s".', get_debug_type($value)));
        }

        return $this->export($value);
    }

    /**
     * Dumps a string to a literal (aka PHP Code) class value.
     *
     * @param string $class
     *
     * @return string
     *
     * @throws RuntimeException
     */
    private function dumpLiteralClass($class)
    {
        if (false !== strpos($class, '$')) {
            return sprintf('${($_ = %s) && false ?: "_"}', $class);
        }
        if (0 !== strpos($class, "'") || !preg_match('/^\'(?:\\\{2})?[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*(?:\\\{2}[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)*\'$/', $class)) {
            throw new RuntimeException(sprintf('Cannot dump definition because of invalid class name (%s).', $class ?: 'n/a'));
        }

        $class = substr(str_replace('\\\\', '\\', $class), 1, -1);

        return 0 === strpos($class, '\\') ? $class : '\\'.$class;
    }

    /**
     * Dumps a parameter.
     *
     * @param string $name
     *
     * @return string
     */
    private function dumpParameter($name)
    {
<<<<<<< Updated upstream
        $name = (string) $name;

        if ($this->container->isCompiled() && $this->container->hasParameter($name)) {
            $value = $this->container->getParameter($name);
            $dumpedValue = $this->dumpValue($value, false);
=======
        if (!$this->container->hasParameter($name) || ($this->dynamicParameters[$name] ?? false)) {
            return sprintf('$container->getParameter(%s)', $this->doExport($name));
        }
>>>>>>> Stashed changes

        $value = $this->container->getParameter($name);
        $dumpedValue = $this->dumpValue($value, false);

<<<<<<< Updated upstream
            if (!preg_match("/\\\$this->(?:getEnv\('(?:\w++:)*+\w++'\)|targetDirs\[\d++\])/", $dumpedValue)) {
                return sprintf('$this->parameters[%s]', $this->doExport($name));
            }
=======
        if (!$value || !\is_array($value)) {
            return $dumpedValue;
>>>>>>> Stashed changes
        }

        return sprintf('$container->parameters[%s]', $this->doExport($name));
    }

<<<<<<< Updated upstream
    /**
     * Gets a service call.
     *
     * @param string    $id
     * @param Reference $reference
     *
     * @return string
     */
    private function getServiceCall($id, Reference $reference = null)
=======
    private function getServiceCall(string $id, ?Reference $reference = null): string
>>>>>>> Stashed changes
    {
        while ($this->container->hasAlias($id)) {
            $id = (string) $this->container->getAlias($id);
        }
        $id = $this->container->normalizeId($id);

        if ('service_container' === $id) {
            return '$container';
        }

        if ($this->container->hasDefinition($id) && $definition = $this->container->getDefinition($id)) {
            if ($definition->isSynthetic()) {
                $code = sprintf('$container->get(%s%s)', $this->doExport($id), null !== $reference ? ', '.$reference->getInvalidBehavior() : '');
            } elseif (null !== $reference && ContainerInterface::IGNORE_ON_UNINITIALIZED_REFERENCE === $reference->getInvalidBehavior()) {
                $code = 'null';
                if (!$definition->isShared()) {
                    return $code;
                }
            } elseif ($this->isTrivialInstance($definition)) {
<<<<<<< Updated upstream
                $code = substr($this->addNewInstance($definition, '', '', $id), 8, -2);
                if ($definition->isShared()) {
                    $code = sprintf('$this->services[%s] = %s', $this->doExport($id), $code);
                }
                $code = "($code)";
            } elseif ($this->asFiles && $definition->isShared() && !$this->isHotPath($definition)) {
                $code = sprintf("\$this->load('%s.php')", $this->generateMethodName($id));
            } else {
                $code = sprintf('$this->%s()', $this->generateMethodName($id));
            }
        } elseif (null !== $reference && ContainerInterface::IGNORE_ON_UNINITIALIZED_REFERENCE === $reference->getInvalidBehavior()) {
            return 'null';
        } elseif (null !== $reference && ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE !== $reference->getInvalidBehavior()) {
            $code = sprintf('$this->get(%s, /* ContainerInterface::NULL_ON_INVALID_REFERENCE */ %d)', $this->doExport($id), ContainerInterface::NULL_ON_INVALID_REFERENCE);
=======
                if ($definition->hasErrors() && $e = $definition->getErrors()) {
                    return sprintf('throw new RuntimeException(%s)', $this->export(reset($e)));
                }
                $code = $this->addNewInstance($definition, '', $id);
                if ($definition->isShared() && !isset($this->singleUsePrivateIds[$id])) {
                    return sprintf('($container->%s[%s] ??= %s)', $definition->isPublic() ? 'services' : 'privates', $this->doExport($id), $code);
                }
                $code = "($code)";
            } else {
                $code = $this->asFiles && !$this->inlineFactories && !$this->isHotPath($definition) ? "\$container->load('%s')" : 'self::%s($container)';
                $code = sprintf($code, $this->generateMethodName($id));

                if (!$definition->isShared()) {
                    $factory = sprintf('$container->factories%s[%s]', $definition->isPublic() ? '' : "['service_container']", $this->doExport($id));
                    $code = sprintf('(isset(%s) ? %1$s($container) : %s)', $factory, $code);
                }
            }
            if ($definition->isShared() && !isset($this->singleUsePrivateIds[$id])) {
                $code = sprintf('($container->%s[%s] ?? %s)', $definition->isPublic() ? 'services' : 'privates', $this->doExport($id), $code);
            }

            return $code;
        }
        if (null !== $reference && ContainerInterface::IGNORE_ON_UNINITIALIZED_REFERENCE === $reference->getInvalidBehavior()) {
            return 'null';
        }
        if (null !== $reference && ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE < $reference->getInvalidBehavior()) {
            $code = sprintf('$container->get(%s, ContainerInterface::NULL_ON_INVALID_REFERENCE)', $this->doExport($id));
>>>>>>> Stashed changes
        } else {
            $code = sprintf('$container->get(%s)', $this->doExport($id));
        }

<<<<<<< Updated upstream
        // The following is PHP 5.5 syntax for what could be written as "(\$this->services['$id'] ?? $code)" on PHP>=7.0

        return sprintf("\${(\$_ = isset(\$this->services[%s]) ? \$this->services[%1\$s] : %s) && false ?: '_'}", $this->doExport($id), $code);
=======
        return sprintf('($container->services[%s] ?? %s)', $this->doExport($id), $code);
>>>>>>> Stashed changes
    }

    /**
     * Initializes the method names map to avoid conflicts with the Container methods.
     *
     * @param string $class the container base class
     */
<<<<<<< Updated upstream
    private function initializeMethodNamesMap($class)
=======
    private function initializeMethodNamesMap(string $class): void
>>>>>>> Stashed changes
    {
        $this->serviceIdToMethodNameMap = [];
        $this->usedMethodNames = [];

        if ($reflectionClass = $this->container->getReflectionClass($class)) {
            foreach ($reflectionClass->getMethods() as $method) {
                $this->usedMethodNames[strtolower($method->getName())] = true;
            }
        }
    }

    /**
     * Convert a service id to a valid PHP method name.
     *
     * @param string $id
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    private function generateMethodName($id)
    {
        if (isset($this->serviceIdToMethodNameMap[$id])) {
            return $this->serviceIdToMethodNameMap[$id];
        }

        $i = strrpos($id, '\\');
        $name = Container::camelize(false !== $i && isset($id[1 + $i]) ? substr($id, 1 + $i) : $id);
        $name = preg_replace('/[^a-zA-Z0-9_\x7f-\xff]/', '', $name);
        $methodName = 'get'.$name.'Service';
        $suffix = 1;

        while (isset($this->usedMethodNames[strtolower($methodName)])) {
            ++$suffix;
            $methodName = 'get'.$name.$suffix.'Service';
        }

        $this->serviceIdToMethodNameMap[$id] = $methodName;
        $this->usedMethodNames[strtolower($methodName)] = true;

        return $methodName;
    }

    /**
     * Returns the next name to use.
     *
     * @return string
     */
    private function getNextVariableName()
    {
        $firstChars = self::FIRST_CHARS;
        $firstCharsLength = \strlen($firstChars);
        $nonFirstChars = self::NON_FIRST_CHARS;
        $nonFirstCharsLength = \strlen($nonFirstChars);

        while (true) {
            $name = '';
            $i = $this->variableCount;

            if ('' === $name) {
                $name .= $firstChars[$i % $firstCharsLength];
                $i = (int) ($i / $firstCharsLength);
            }

            while ($i > 0) {
                --$i;
                $name .= $nonFirstChars[$i % $nonFirstCharsLength];
                $i = (int) ($i / $nonFirstCharsLength);
            }

            ++$this->variableCount;

            // check that the name is not reserved
            if (\in_array($name, $this->reservedVariables, true)) {
                continue;
            }

            return $name;
        }
    }

    private function getExpressionLanguage()
    {
<<<<<<< Updated upstream
        if (null === $this->expressionLanguage) {
            if (!class_exists('Symfony\Component\ExpressionLanguage\ExpressionLanguage')) {
                throw new RuntimeException('Unable to use expressions as the Symfony ExpressionLanguage component is not installed.');
=======
        if (!isset($this->expressionLanguage)) {
            if (!class_exists(\Symfony\Component\ExpressionLanguage\ExpressionLanguage::class)) {
                throw new LogicException('Unable to use expressions as the Symfony ExpressionLanguage component is not installed. Try running "composer require symfony/expression-language".');
>>>>>>> Stashed changes
            }
            $providers = $this->container->getExpressionLanguageProviders();
            $this->expressionLanguage = new ExpressionLanguage(null, $providers, function ($arg) {
                $id = '""' === substr_replace($arg, '', 1, -1) ? stripcslashes(substr($arg, 1, -1)) : null;

                if (null !== $id && ($this->container->hasAlias($id) || $this->container->hasDefinition($id))) {
                    return $this->getServiceCall($id);
                }

                return sprintf('$container->get(%s)', $arg);
            });

            if ($this->container->isTrackingResources()) {
                foreach ($providers as $provider) {
                    $this->container->addObjectResource($provider);
                }
            }
        }

        return $this->expressionLanguage;
    }

    private function isHotPath(Definition $definition)
    {
        return $this->hotPathTag && $definition->hasTag($this->hotPathTag) && !$definition->isDeprecated();
    }

<<<<<<< Updated upstream
    private function export($value)
=======
    private function isSingleUsePrivateNode(ServiceReferenceGraphNode $node): bool
    {
        if ($node->getValue()->isPublic()) {
            return false;
        }
        $ids = [];
        foreach ($node->getInEdges() as $edge) {
            if (!$value = $edge->getSourceNode()->getValue()) {
                continue;
            }
            if ($edge->isLazy() || !$value instanceof Definition || !$value->isShared()) {
                return false;
            }
            $ids[$edge->getSourceNode()->getId()] = true;
        }

        return 1 === \count($ids);
    }

    private function export(mixed $value): mixed
>>>>>>> Stashed changes
    {
        if (null !== $this->targetDirRegex && \is_string($value) && preg_match($this->targetDirRegex, $value, $matches, PREG_OFFSET_CAPTURE)) {
            $prefix = $matches[0][1] ? $this->doExport(substr($value, 0, $matches[0][1]), true).'.' : '';
<<<<<<< Updated upstream
            $suffix = $matches[0][1] + \strlen($matches[0][0]);
            $suffix = isset($value[$suffix]) ? '.'.$this->doExport(substr($value, $suffix), true) : '';
            $dirname = $this->asFiles ? '$this->containerDir' : '__DIR__';
            $offset = 1 + $this->targetDirMaxMatches - \count($matches);

            if ($this->asFiles || 0 < $offset) {
                $dirname = sprintf('$this->targetDirs[%d]', $offset);
=======

            if ('\\' === \DIRECTORY_SEPARATOR && isset($value[$suffix])) {
                $cookie = '\\'.random_int(100000, \PHP_INT_MAX);
                $suffix = '.'.$this->doExport(str_replace('\\', $cookie, substr($value, $suffix)), true);
                $suffix = str_replace('\\'.$cookie, "'.\\DIRECTORY_SEPARATOR.'", $suffix);
            } else {
                $suffix = isset($value[$suffix]) ? '.'.$this->doExport(substr($value, $suffix), true) : '';
            }

            $dirname = $this->asFiles ? '$container->containerDir' : '__DIR__';
            $offset = 2 + $this->targetDirMaxMatches - \count($matches);

            if (0 < $offset) {
                $dirname = sprintf('\dirname(__DIR__, %d)', $offset + (int) $this->asFiles);
            } elseif ($this->asFiles) {
                $dirname = "\$container->targetDir.''"; // empty string concatenation on purpose
>>>>>>> Stashed changes
            }

            if ($prefix || $suffix) {
                return sprintf('(%s%s%s)', $prefix, $dirname, $suffix);
            }

            return $dirname;
        }

        return $this->doExport($value, true);
    }

<<<<<<< Updated upstream
    private function doExport($value, $resolveEnv = false)
=======
    private function doExport(mixed $value, bool $resolveEnv = false): mixed
>>>>>>> Stashed changes
    {
        if (\is_string($value) && false !== strpos($value, "\n")) {
            $cleanParts = explode("\n", $value);
            $cleanParts = array_map(fn ($part) => var_export($part, true), $cleanParts);
            $export = implode('."\n".', $cleanParts);
        } else {
            $export = var_export($value, true);
        }

        if ($resolveEnv && "'" === $export[0] && $export !== $resolvedExport = $this->container->resolveEnvPlaceholders($export, "'.\$container->getEnv('string:%s').'")) {
            $export = $resolvedExport;
            if (".''" === substr($export, -3)) {
                $export = substr($export, 0, -3);
                if ("'" === $export[1]) {
                    $export = substr_replace($export, '', 23, 7);
                }
            }
            if ("'" === $export[1]) {
                $export = substr($export, 3);
            }
        }

        return $export;
    }
<<<<<<< Updated upstream
=======

    private function getAutoloadFile(): ?string
    {
        $file = null;

        foreach (spl_autoload_functions() as $autoloader) {
            if (!\is_array($autoloader)) {
                continue;
            }

            if ($autoloader[0] instanceof DebugClassLoader) {
                $autoloader = $autoloader[0]->getClassLoader();
            }

            if (!\is_array($autoloader) || !$autoloader[0] instanceof ClassLoader || !$autoloader[0]->findFile(__CLASS__)) {
                continue;
            }

            foreach (get_declared_classes() as $class) {
                if (str_starts_with($class, 'ComposerAutoloaderInit') && $class::getLoader() === $autoloader[0]) {
                    $file = \dirname((new \ReflectionClass($class))->getFileName(), 2).'/autoload.php';

                    if (null !== $this->targetDirRegex && preg_match($this->targetDirRegex.'A', $file)) {
                        return $file;
                    }
                }
            }
        }

        return $file;
    }

    private function getClasses(Definition $definition, string $id): array
    {
        $classes = [];
        $resolve = $this->container->getParameterBag()->resolveValue(...);

        while ($definition instanceof Definition) {
            foreach ($definition->getTag($this->preloadTags[0]) as $tag) {
                if (!isset($tag['class'])) {
                    throw new InvalidArgumentException(sprintf('Missing attribute "class" on tag "%s" for service "%s".', $this->preloadTags[0], $id));
                }

                $classes[] = trim($tag['class'], '\\');
            }

            if ($class = $definition->getClass()) {
                $classes[] = trim($resolve($class), '\\');
            }
            $factory = $definition->getFactory();

            if (!\is_array($factory)) {
                $factory = [$factory];
            }

            if (\is_string($factory[0])) {
                $factory[0] = $resolve($factory[0]);

                if (false !== $i = strrpos($factory[0], '::')) {
                    $factory[0] = substr($factory[0], 0, $i);
                }
                $classes[] = trim($factory[0], '\\');
            }

            $definition = $factory[0];
        }

        return $classes;
    }

    private function isProxyCandidate(Definition $definition, ?bool &$asGhostObject, string $id): ?Definition
    {
        $asGhostObject = false;

        if (['Closure', 'fromCallable'] === $definition->getFactory()) {
            return null;
        }

        if (!$definition->isLazy() || !$this->hasProxyDumper) {
            return null;
        }

        return $this->getProxyDumper()->isProxyCandidate($definition, $asGhostObject, $id) ? $definition : null;
    }

    /**
     * Removes comments from a PHP source string.
     *
     * We don't use the PHP php_strip_whitespace() function
     * as we want the content to be readable and well-formatted.
     */
    private static function stripComments(string $source): string
    {
        if (!\function_exists('token_get_all')) {
            return $source;
        }

        $rawChunk = '';
        $output = '';
        $tokens = token_get_all($source);
        $ignoreSpace = false;
        for ($i = 0; isset($tokens[$i]); ++$i) {
            $token = $tokens[$i];
            if (!isset($token[1]) || 'b"' === $token) {
                $rawChunk .= $token;
            } elseif (\T_START_HEREDOC === $token[0]) {
                $output .= $rawChunk.$token[1];
                do {
                    $token = $tokens[++$i];
                    $output .= isset($token[1]) && 'b"' !== $token ? $token[1] : $token;
                } while (\T_END_HEREDOC !== $token[0]);
                $rawChunk = '';
            } elseif (\T_WHITESPACE === $token[0]) {
                if ($ignoreSpace) {
                    $ignoreSpace = false;

                    continue;
                }

                // replace multiple new lines with a single newline
                $rawChunk .= preg_replace(['/\n{2,}/S'], "\n", $token[1]);
            } elseif (\in_array($token[0], [\T_COMMENT, \T_DOC_COMMENT])) {
                if (!\in_array($rawChunk[\strlen($rawChunk) - 1], [' ', "\n", "\r", "\t"], true)) {
                    $rawChunk .= ' ';
                }
                $ignoreSpace = true;
            } else {
                $rawChunk .= $token[1];

                // The PHP-open tag already has a new-line
                if (\T_OPEN_TAG === $token[0]) {
                    $ignoreSpace = true;
                } else {
                    $ignoreSpace = false;
                }
            }
        }

        $output .= $rawChunk;

        unset($tokens, $rawChunk);
        gc_mem_caches();

        return $output;
    }
>>>>>>> Stashed changes
}
