<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Extension;

use Twig\NodeVisitor\NodeVisitorInterface;
use Twig\TokenParser\TokenParserInterface;

/**
 * Internal class.
 *
 * This class is used by \Twig\Environment as a staging area and must not be used directly.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @internal
 */
class StagingExtension extends AbstractExtension
{
<<<<<<< Updated upstream
    protected $functions = [];
    protected $filters = [];
    protected $visitors = [];
    protected $tokenParsers = [];
    protected $globals = [];
    protected $tests = [];

    public function addFunction($name, $function)
=======
    private $functions = [];
    private $filters = [];
    private $visitors = [];
    private $tokenParsers = [];
    private $tests = [];

    public function addFunction(TwigFunction $function): void
>>>>>>> Stashed changes
    {
        if (isset($this->functions[$name])) {
            @trigger_error(sprintf('Overriding function "%s" that is already registered is deprecated since version 1.30 and won\'t be possible anymore in 2.0.', $name), E_USER_DEPRECATED);
        }

        $this->functions[$name] = $function;
    }

    public function getFunctions(): array
    {
        return $this->functions;
    }

<<<<<<< Updated upstream
    public function addFilter($name, $filter)
=======
    public function addFilter(TwigFilter $filter): void
>>>>>>> Stashed changes
    {
        if (isset($this->filters[$name])) {
            @trigger_error(sprintf('Overriding filter "%s" that is already registered is deprecated since version 1.30 and won\'t be possible anymore in 2.0.', $name), E_USER_DEPRECATED);
        }

        $this->filters[$name] = $filter;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function addNodeVisitor(NodeVisitorInterface $visitor): void
    {
        $this->visitors[] = $visitor;
    }

    public function getNodeVisitors(): array
    {
        return $this->visitors;
    }

    public function addTokenParser(TokenParserInterface $parser): void
    {
        if (isset($this->tokenParsers[$parser->getTag()])) {
            @trigger_error(sprintf('Overriding tag "%s" that is already registered is deprecated since version 1.30 and won\'t be possible anymore in 2.0.', $parser->getTag()), E_USER_DEPRECATED);
        }

        $this->tokenParsers[$parser->getTag()] = $parser;
    }

    public function getTokenParsers(): array
    {
        return $this->tokenParsers;
    }

<<<<<<< Updated upstream
    public function addGlobal($name, $value)
    {
        $this->globals[$name] = $value;
    }

    public function getGlobals()
=======
    public function addTest(TwigTest $test): void
>>>>>>> Stashed changes
    {
        return $this->globals;
    }

    public function addTest($name, $test)
    {
        if (isset($this->tests[$name])) {
            @trigger_error(sprintf('Overriding test "%s" that is already registered is deprecated since version 1.30 and won\'t be possible anymore in 2.0.', $name), E_USER_DEPRECATED);
        }

        $this->tests[$name] = $test;
    }

    public function getTests(): array
    {
        return $this->tests;
    }

    public function getName()
    {
        return 'staging';
    }
}
