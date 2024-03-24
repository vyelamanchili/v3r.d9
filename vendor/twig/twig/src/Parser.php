<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig;

use Twig\Error\SyntaxError;
use Twig\Node\BlockNode;
use Twig\Node\BlockReferenceNode;
use Twig\Node\BodyNode;
use Twig\Node\Expression\AbstractExpression;
use Twig\Node\MacroNode;
use Twig\Node\ModuleNode;
use Twig\Node\Node;
use Twig\Node\NodeCaptureInterface;
use Twig\Node\NodeOutputInterface;
use Twig\Node\PrintNode;
use Twig\Node\TextNode;
use Twig\NodeVisitor\NodeVisitorInterface;
use Twig\TokenParser\TokenParserInterface;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Parser implements \Twig_ParserInterface
{
<<<<<<< Updated upstream
    protected $stack = [];
    protected $stream;
    protected $parent;
    protected $handlers;
    protected $visitors;
    protected $expressionParser;
    protected $blocks;
    protected $blockStack;
    protected $macros;
    protected $env;
    protected $reservedMacroNames;
    protected $importedSymbols;
    protected $traits;
    protected $embeddedTemplates = [];
=======
    private $stack = [];
    private $stream;
    private $parent;
    private $visitors;
    private $expressionParser;
    private $blocks;
    private $blockStack;
    private $macros;
    private $env;
    private $importedSymbols;
    private $traits;
    private $embeddedTemplates = [];
>>>>>>> Stashed changes
    private $varNameSalt = 0;

    public function __construct(Environment $env)
    {
        $this->env = $env;
    }

<<<<<<< Updated upstream
    /**
     * @deprecated since 1.27 (to be removed in 2.0)
     */
    public function getEnvironment()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0.', E_USER_DEPRECATED);

        return $this->env;
    }

    public function getVarName()
=======
    public function getVarName(): string
>>>>>>> Stashed changes
    {
        return sprintf('__internal_%s', hash('sha256', __METHOD__.$this->stream->getSourceContext()->getCode().$this->varNameSalt++));
    }

    /**
     * @deprecated since 1.27 (to be removed in 2.0). Use $parser->getStream()->getSourceContext()->getPath() instead.
     */
    public function getFilename()
    {
        @trigger_error(sprintf('The "%s" method is deprecated since version 1.27 and will be removed in 2.0. Use $parser->getStream()->getSourceContext()->getPath() instead.', __METHOD__), E_USER_DEPRECATED);

        return $this->stream->getSourceContext()->getName();
    }

    public function parse(TokenStream $stream, $test = null, bool $dropNeedle = false): ModuleNode
    {
        // push all variables into the stack to keep the current state of the parser
        // using get_object_vars() instead of foreach would lead to https://bugs.php.net/71336
        // This hack can be removed when min version if PHP 7.0
        $vars = [];
        foreach ($this as $k => $v) {
            $vars[$k] = $v;
        }

        unset($vars['stack'], $vars['env'], $vars['handlers'], $vars['visitors'], $vars['expressionParser'], $vars['reservedMacroNames']);
        $this->stack[] = $vars;

<<<<<<< Updated upstream
        // tag handlers
        if (null === $this->handlers) {
            $this->handlers = $this->env->getTokenParsers();
            $this->handlers->setParser($this);
        }

=======
>>>>>>> Stashed changes
        // node visitors
        if (null === $this->visitors) {
            $this->visitors = $this->env->getNodeVisitors();
        }

        if (null === $this->expressionParser) {
            $this->expressionParser = new ExpressionParser($this, $this->env);
        }

        $this->stream = $stream;
        $this->parent = null;
        $this->blocks = [];
        $this->macros = [];
        $this->traits = [];
        $this->blockStack = [];
        $this->importedSymbols = [[]];
        $this->embeddedTemplates = [];
        $this->varNameSalt = 0;

        try {
            $body = $this->subparse($test, $dropNeedle);

            if (null !== $this->parent && null === $body = $this->filterBodyNodes($body)) {
                $body = new Node();
            }
        } catch (SyntaxError $e) {
            if (!$e->getSourceContext()) {
                $e->setSourceContext($this->stream->getSourceContext());
            }

            if (!$e->getTemplateLine()) {
                $e->setTemplateLine($this->stream->getCurrent()->getLine());
            }

            throw $e;
        }

        $node = new ModuleNode(new BodyNode([$body]), $this->parent, new Node($this->blocks), new Node($this->macros), new Node($this->traits), $this->embeddedTemplates, $stream->getSourceContext());

        $traverser = new NodeTraverser($this->env, $this->visitors);

        $node = $traverser->traverse($node);

        // restore previous stack so previous parse() call can resume working
        foreach (array_pop($this->stack) as $key => $val) {
            $this->$key = $val;
        }

        return $node;
    }

    public function subparse($test, bool $dropNeedle = false): Node
    {
        $lineno = $this->getCurrentToken()->getLine();
        $rv = [];
        while (!$this->stream->isEOF()) {
            switch ($this->getCurrentToken()->getType()) {
                case Token::TEXT_TYPE:
                    $token = $this->stream->next();
                    $rv[] = new TextNode($token->getValue(), $token->getLine());
                    break;

                case Token::VAR_START_TYPE:
                    $token = $this->stream->next();
                    $expr = $this->expressionParser->parseExpression();
                    $this->stream->expect(Token::VAR_END_TYPE);
                    $rv[] = new PrintNode($expr, $token->getLine());
                    break;

                case Token::BLOCK_START_TYPE:
                    $this->stream->next();
                    $token = $this->getCurrentToken();

                    if (Token::NAME_TYPE !== $token->getType()) {
                        throw new SyntaxError('A block must start with a tag name.', $token->getLine(), $this->stream->getSourceContext());
                    }

                    if (null !== $test && \call_user_func($test, $token)) {
                        if ($dropNeedle) {
                            $this->stream->next();
                        }

                        if (1 === \count($rv)) {
                            return $rv[0];
                        }

                        return new Node($rv, [], $lineno);
                    }

<<<<<<< Updated upstream
                    $subparser = $this->handlers->getTokenParser($token->getValue());
                    if (null === $subparser) {
=======
                    if (!$subparser = $this->env->getTokenParser($token->getValue())) {
>>>>>>> Stashed changes
                        if (null !== $test) {
                            $e = new SyntaxError(sprintf('Unexpected "%s" tag', $token->getValue()), $token->getLine(), $this->stream->getSourceContext());

                            if (\is_array($test) && isset($test[0]) && $test[0] instanceof TokenParserInterface) {
                                $e->appendMessage(sprintf(' (expecting closing tag for the "%s" tag defined near line %s).', $test[0]->getTag(), $lineno));
                            }
                        } else {
                            $e = new SyntaxError(sprintf('Unknown "%s" tag.', $token->getValue()), $token->getLine(), $this->stream->getSourceContext());
                            $e->addSuggestions($token->getValue(), array_keys($this->env->getTokenParsers()));
                        }

                        throw $e;
                    }

                    $this->stream->next();

<<<<<<< Updated upstream
=======
                    $subparser->setParser($this);
>>>>>>> Stashed changes
                    $node = $subparser->parse($token);
                    if (null !== $node) {
                        $rv[] = $node;
                    }
                    break;

                default:
                    throw new SyntaxError('Lexer or parser ended up in unsupported state.', $this->getCurrentToken()->getLine(), $this->stream->getSourceContext());
            }
        }

        if (1 === \count($rv)) {
            return $rv[0];
        }

        return new Node($rv, [], $lineno);
    }

<<<<<<< Updated upstream
    /**
     * @deprecated since 1.27 (to be removed in 2.0)
     */
    public function addHandler($name, $class)
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0.', E_USER_DEPRECATED);

        $this->handlers[$name] = $class;
    }

    /**
     * @deprecated since 1.27 (to be removed in 2.0)
     */
    public function addNodeVisitor(NodeVisitorInterface $visitor)
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0.', E_USER_DEPRECATED);

        $this->visitors[] = $visitor;
    }

    public function getBlockStack()
=======
    public function getBlockStack(): array
>>>>>>> Stashed changes
    {
        return $this->blockStack;
    }

    public function peekBlockStack()
    {
        return $this->blockStack[\count($this->blockStack) - 1] ?? null;
    }

    public function popBlockStack(): void
    {
        array_pop($this->blockStack);
    }

    public function pushBlockStack($name): void
    {
        $this->blockStack[] = $name;
    }

    public function hasBlock(string $name): bool
    {
        return isset($this->blocks[$name]);
    }

    public function getBlock(string $name): Node
    {
        return $this->blocks[$name];
    }

    public function setBlock(string $name, BlockNode $value): void
    {
        $this->blocks[$name] = new BodyNode([$value], [], $value->getTemplateLine());
    }

    public function hasMacro(string $name): bool
    {
        return isset($this->macros[$name]);
    }

    public function setMacro(string $name, MacroNode $node): void
    {
        if ($this->isReservedMacroName($name)) {
            throw new SyntaxError(sprintf('"%s" cannot be used as a macro name as it is a reserved keyword.', $name), $node->getTemplateLine(), $this->stream->getSourceContext());
        }

        $this->macros[$name] = $node;
    }

<<<<<<< Updated upstream
    public function isReservedMacroName($name)
    {
        if (null === $this->reservedMacroNames) {
            $this->reservedMacroNames = [];
            $r = new \ReflectionClass($this->env->getBaseTemplateClass());
            foreach ($r->getMethods() as $method) {
                $methodName = strtr($method->getName(), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz');

                if ('get' === substr($methodName, 0, 3) && isset($methodName[3])) {
                    $this->reservedMacroNames[] = substr($methodName, 3);
                }
            }
        }

        return \in_array(strtr($name, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), $this->reservedMacroNames);
    }

    public function addTrait($trait)
=======
    public function addTrait($trait): void
>>>>>>> Stashed changes
    {
        $this->traits[] = $trait;
    }

    public function hasTraits(): bool
    {
        return \count($this->traits) > 0;
    }

    public function embedTemplate(ModuleNode $template)
    {
        $template->setIndex(mt_rand());

        $this->embeddedTemplates[] = $template;
    }

    public function addImportedSymbol(string $type, string $alias, string $name = null, AbstractExpression $node = null): void
    {
        $this->importedSymbols[0][$type][$alias] = ['name' => $name, 'node' => $node];
    }

    public function getImportedSymbol(string $type, string $alias)
    {
        if (null !== $this->peekBlockStack()) {
            foreach ($this->importedSymbols as $functions) {
                if (isset($functions[$type][$alias])) {
                    if (\count($this->blockStack) > 1) {
                        return null;
                    }

                    return $functions[$type][$alias];
                }
            }
        } else {
            return isset($this->importedSymbols[0][$type][$alias]) ? $this->importedSymbols[0][$type][$alias] : null;
        }
    }

    public function isMainScope(): bool
    {
        return 1 === \count($this->importedSymbols);
    }

    public function pushLocalScope(): void
    {
        array_unshift($this->importedSymbols, []);
    }

    public function popLocalScope(): void
    {
        array_shift($this->importedSymbols);
    }

    public function getExpressionParser(): ExpressionParser
    {
        return $this->expressionParser;
    }

    public function getParent(): ?Node
    {
        return $this->parent;
    }

    public function setParent(?Node $parent): void
    {
        $this->parent = $parent;
    }

    public function getStream(): TokenStream
    {
        return $this->stream;
    }

    public function getCurrentToken(): Token
    {
        return $this->stream->getCurrent();
    }

<<<<<<< Updated upstream
    protected function filterBodyNodes(\Twig_NodeInterface $node)
=======
    private function filterBodyNodes(Node $node, bool $nested = false): ?Node
>>>>>>> Stashed changes
    {
        // check that the body does not contain non-empty output nodes
        if (
            ($node instanceof TextNode && !ctype_space($node->getAttribute('data')))
<<<<<<< Updated upstream
            ||
            (!$node instanceof TextNode && !$node instanceof BlockReferenceNode && $node instanceof NodeOutputInterface)
=======
            || (!$node instanceof TextNode && !$node instanceof BlockReferenceNode && $node instanceof NodeOutputInterface)
>>>>>>> Stashed changes
        ) {
            if (str_contains((string) $node, \chr(0xEF).\chr(0xBB).\chr(0xBF))) {
                $t = substr($node->getAttribute('data'), 3);
                if ('' === $t || ctype_space($t)) {
                    // bypass empty nodes starting with a BOM
                    return null;
                }
            }

            throw new SyntaxError('A template that extends another one cannot include content outside Twig blocks. Did you forget to put the content inside a {% block %} tag?', $node->getTemplateLine(), $this->stream->getSourceContext());
        }

        // bypass nodes that will "capture" the output
        if ($node instanceof NodeCaptureInterface) {
            return $node;
        }

<<<<<<< Updated upstream
        if ($node instanceof NodeOutputInterface) {
            return;
        }

=======
        // "block" tags that are not captured (see above) are only used for defining
        // the content of the block. In such a case, nesting it does not work as
        // expected as the definition is not part of the default template code flow.
        if ($nested && $node instanceof BlockReferenceNode) {
            throw new SyntaxError('A block definition cannot be nested under non-capturing nodes.', $node->getTemplateLine(), $this->stream->getSourceContext());
        }

        if ($node instanceof NodeOutputInterface) {
            return null;
        }

        // here, $nested means "being at the root level of a child template"
        // we need to discard the wrapping "Node" for the "body" node
        $nested = $nested || Node::class !== \get_class($node);
>>>>>>> Stashed changes
        foreach ($node as $k => $n) {
            if (null !== $n && null === $this->filterBodyNodes($n)) {
                $node->removeNode($k);
            }
        }

        return $node;
    }
}
