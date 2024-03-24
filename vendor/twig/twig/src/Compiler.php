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

use Twig\Node\ModuleNode;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Compiler implements \Twig_CompilerInterface
{
    protected $lastLine;
    protected $source;
    protected $indentation;
    protected $env;
    protected $debugInfo = [];
    protected $sourceOffset;
    protected $sourceLine;
    protected $filename;
    private $varNameSalt = 0;

    public function __construct(Environment $env)
    {
        $this->env = $env;
    }

<<<<<<< Updated upstream
    /**
     * @deprecated since 1.25 (to be removed in 2.0)
     */
    public function getFilename()
    {
        @trigger_error(sprintf('The %s() method is deprecated since version 1.25 and will be removed in 2.0.', __FUNCTION__), E_USER_DEPRECATED);

        return $this->filename;
    }

    /**
     * Returns the environment instance related to this compiler.
     *
     * @return Environment
     */
    public function getEnvironment()
=======
    public function getEnvironment(): Environment
>>>>>>> Stashed changes
    {
        return $this->env;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return $this
     */
<<<<<<< Updated upstream
    public function compile(\Twig_NodeInterface $node, $indentation = 0)
=======
    public function reset(int $indentation = 0)
>>>>>>> Stashed changes
    {
        $this->lastLine = null;
        $this->source = '';
        $this->debugInfo = [];
        $this->sourceOffset = 0;
        // source code starts at 1 (as we then increment it when we encounter new lines)
        $this->sourceLine = 1;
        $this->indentation = $indentation;
        $this->varNameSalt = 0;

<<<<<<< Updated upstream
        if ($node instanceof ModuleNode) {
            // to be removed in 2.0
            $this->filename = $node->getTemplateName();
        }

=======
        return $this;
    }

    /**
     * @return $this
     */
    public function compile(Node $node, int $indentation = 0)
    {
        $this->reset($indentation);
>>>>>>> Stashed changes
        $node->compile($this);

        return $this;
    }

<<<<<<< Updated upstream
    public function subcompile(\Twig_NodeInterface $node, $raw = true)
=======
    /**
     * @return $this
     */
    public function subcompile(Node $node, bool $raw = true)
>>>>>>> Stashed changes
    {
        if (false === $raw) {
            $this->source .= str_repeat(' ', $this->indentation * 4);
        }

        $node->compile($this);

        return $this;
    }

    /**
     * Adds a raw string to the compiled code.
     *
     * @return $this
     */
    public function raw(string $string)
    {
        $this->source .= $string;

        return $this;
    }

    /**
     * Writes a string to the compiled code by adding indentation.
     *
     * @return $this
     */
    public function write()
    {
        $strings = \func_get_args();
        foreach ($strings as $string) {
            $this->source .= str_repeat(' ', $this->indentation * 4).$string;
        }

        return $this;
    }

    /**
     * Appends an indentation to the current PHP code after compilation.
     *
     * @return $this
     *
     * @deprecated since 1.27 (to be removed in 2.0).
     */
    public function addIndentation()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use write(\'\') instead.', E_USER_DEPRECATED);

        $this->source .= str_repeat(' ', $this->indentation * 4);

        return $this;
    }

    /**
     * Adds a quoted string to the compiled code.
     *
     * @return $this
     */
    public function string(string $value)
    {
        $this->source .= sprintf('"%s"', addcslashes($value, "\0\t\"\$\\"));

        return $this;
    }

    /**
     * Returns a PHP representation of a given value.
     *
     * @return $this
     */
    public function repr($value)
    {
        if (\is_int($value) || \is_float($value)) {
            if (false !== $locale = setlocale(LC_NUMERIC, '0')) {
                setlocale(LC_NUMERIC, 'C');
            }

            $this->raw(var_export($value, true));

            if (false !== $locale) {
                setlocale(LC_NUMERIC, $locale);
            }
        } elseif (null === $value) {
            $this->raw('null');
        } elseif (\is_bool($value)) {
            $this->raw($value ? 'true' : 'false');
        } elseif (\is_array($value)) {
            $this->raw('[');
            $first = true;
            foreach ($value as $key => $v) {
                if (!$first) {
                    $this->raw(', ');
                }
                $first = false;
                $this->repr($key);
                $this->raw(' => ');
                $this->repr($v);
            }
            $this->raw(']');
        } else {
            $this->string($value);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function addDebugInfo(\Twig_NodeInterface $node)
    {
        if ($node->getTemplateLine() != $this->lastLine) {
            $this->write(sprintf("// line %d\n", $node->getTemplateLine()));

            // when mbstring.func_overload is set to 2
            // mb_substr_count() replaces substr_count()
            // but they have different signatures!
            if (((int) ini_get('mbstring.func_overload')) & 2) {
                @trigger_error('Support for having "mbstring.func_overload" different from 0 is deprecated version 1.29 and will be removed in 2.0.', E_USER_DEPRECATED);

                // this is much slower than the "right" version
                $this->sourceLine += mb_substr_count(mb_substr($this->source, $this->sourceOffset), "\n");
            } else {
                $this->sourceLine += substr_count($this->source, "\n", $this->sourceOffset);
            }
            $this->sourceOffset = \strlen($this->source);
            $this->debugInfo[$this->sourceLine] = $node->getTemplateLine();

            $this->lastLine = $node->getTemplateLine();
        }

        return $this;
    }

    public function getDebugInfo(): array
    {
        ksort($this->debugInfo);

        return $this->debugInfo;
    }

    /**
     * @return $this
     */
    public function indent(int $step = 1)
    {
        $this->indentation += $step;

        return $this;
    }

    /**
     * @return $this
     *
     * @throws \LogicException When trying to outdent too much so the indentation would become negative
     */
    public function outdent(int $step = 1)
    {
        // can't outdent by more steps than the current indentation level
        if ($this->indentation < $step) {
            throw new \LogicException('Unable to call outdent() as the indentation would become negative.');
        }

        $this->indentation -= $step;

        return $this;
    }

    public function getVarName(): string
    {
        return sprintf('__internal_%s', hash('sha256', __METHOD__.$this->varNameSalt++));
    }
}
