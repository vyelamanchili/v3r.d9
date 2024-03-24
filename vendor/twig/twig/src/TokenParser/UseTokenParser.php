<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\TokenParser;

use Twig\Error\SyntaxError;
use Twig\Node\Expression\ConstantExpression;
use Twig\Node\Node;
use Twig\Token;

/**
 * Imports blocks defined in another template into the current template.
 *
 *    {% extends "base.html" %}
 *
 *    {% use "blocks.html" %}
 *
 *    {% block title %}{% endblock %}
 *    {% block content %}{% endblock %}
 *
 * @see https://twig.symfony.com/doc/templates.html#horizontal-reuse for details.
 *
<<<<<<< Updated upstream
 * @final
=======
 * @internal
>>>>>>> Stashed changes
 */
class UseTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
        $template = $this->parser->getExpressionParser()->parseExpression();
        $stream = $this->parser->getStream();

        if (!$template instanceof ConstantExpression) {
            throw new SyntaxError('The template references in a "use" statement must be a string.', $stream->getCurrent()->getLine(), $stream->getSourceContext());
        }

        $targets = [];
        if ($stream->nextIf('with')) {
<<<<<<< Updated upstream
            do {
                $name = $stream->expect(Token::NAME_TYPE)->getValue();
=======
            while (true) {
                $name = $stream->expect(/* Token::NAME_TYPE */ 5)->getValue();
>>>>>>> Stashed changes

                $alias = $name;
                if ($stream->nextIf('as')) {
                    $alias = $stream->expect(Token::NAME_TYPE)->getValue();
                }

                $targets[$name] = new ConstantExpression($alias, -1);

                if (!$stream->nextIf(Token::PUNCTUATION_TYPE, ',')) {
                    break;
                }
            }
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        $this->parser->addTrait(new Node(['template' => $template, 'targets' => new Node($targets)]));

        return new Node();
    }

    public function getTag(): string
    {
        return 'use';
    }
}
