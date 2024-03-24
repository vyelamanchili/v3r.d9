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

namespace Twig\TokenParser;

use Twig\Node\Expression\AssignNameExpression;
use Twig\Node\ForNode;
use Twig\Token;

/**
 * Loops over each item of a sequence.
 *
 *   <ul>
 *    {% for user in users %}
 *      <li>{{ user.username|e }}</li>
 *    {% endfor %}
 *   </ul>
 *
<<<<<<< Updated upstream
 * @final
=======
 * @internal
>>>>>>> Stashed changes
 */
class ForTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        $targets = $this->parser->getExpressionParser()->parseAssignmentExpression();
        $stream->expect(Token::OPERATOR_TYPE, 'in');
        $seq = $this->parser->getExpressionParser()->parseExpression();

<<<<<<< Updated upstream
        $ifexpr = null;
        if ($stream->nextIf(Token::NAME_TYPE, 'if')) {
            $ifexpr = $this->parser->getExpressionParser()->parseExpression();
        }

        $stream->expect(Token::BLOCK_END_TYPE);
=======
        $stream->expect(/* Token::BLOCK_END_TYPE */ 3);
>>>>>>> Stashed changes
        $body = $this->parser->subparse([$this, 'decideForFork']);
        if ('else' == $stream->next()->getValue()) {
            $stream->expect(Token::BLOCK_END_TYPE);
            $else = $this->parser->subparse([$this, 'decideForEnd'], true);
        } else {
            $else = null;
        }
        $stream->expect(Token::BLOCK_END_TYPE);

        if (\count($targets) > 1) {
            $keyTarget = $targets->getNode(0);
            $keyTarget = new AssignNameExpression($keyTarget->getAttribute('name'), $keyTarget->getTemplateLine());
            $valueTarget = $targets->getNode(1);
        } else {
            $keyTarget = new AssignNameExpression('_key', $lineno);
            $valueTarget = $targets->getNode(0);
        }
        $valueTarget = new AssignNameExpression($valueTarget->getAttribute('name'), $valueTarget->getTemplateLine());

        return new ForNode($keyTarget, $valueTarget, $seq, null, $body, $else, $lineno, $this->getTag());
    }

    public function decideForFork(Token $token): bool
    {
        return $token->test(['else', 'endfor']);
    }

    public function decideForEnd(Token $token): bool
    {
        return $token->test('endfor');
    }

<<<<<<< Updated upstream
    // the loop variable cannot be used in the condition
    protected function checkLoopUsageCondition(TokenStream $stream, \Twig_NodeInterface $node)
    {
        if ($node instanceof GetAttrExpression && $node->getNode('node') instanceof NameExpression && 'loop' == $node->getNode('node')->getAttribute('name')) {
            throw new SyntaxError('The "loop" variable cannot be used in a looping condition.', $node->getTemplateLine(), $stream->getSourceContext());
        }

        foreach ($node as $n) {
            if (!$n) {
                continue;
            }

            $this->checkLoopUsageCondition($stream, $n);
        }
    }

    // check usage of non-defined loop-items
    // it does not catch all problems (for instance when a for is included into another or when the variable is used in an include)
    protected function checkLoopUsageBody(TokenStream $stream, \Twig_NodeInterface $node)
    {
        if ($node instanceof GetAttrExpression && $node->getNode('node') instanceof NameExpression && 'loop' == $node->getNode('node')->getAttribute('name')) {
            $attribute = $node->getNode('attribute');
            if ($attribute instanceof ConstantExpression && \in_array($attribute->getAttribute('value'), ['length', 'revindex0', 'revindex', 'last'])) {
                throw new SyntaxError(sprintf('The "loop.%s" variable is not defined when looping with a condition.', $attribute->getAttribute('value')), $node->getTemplateLine(), $stream->getSourceContext());
            }
        }

        // should check for parent.loop.XXX usage
        if ($node instanceof ForNode) {
            return;
        }

        foreach ($node as $n) {
            if (!$n) {
                continue;
            }

            $this->checkLoopUsageBody($stream, $n);
        }
    }

    public function getTag()
=======
    public function getTag(): string
>>>>>>> Stashed changes
    {
        return 'for';
    }
}
