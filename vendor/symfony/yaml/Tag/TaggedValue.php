<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Yaml\Tag;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 * @author Guilhem N. <egetick@gmail.com>
 */
final class TaggedValue
{
    private string $tag;
    private mixed $value;

<<<<<<< Updated upstream
    /**
     * @param string $tag
     * @param mixed  $value
     */
    public function __construct($tag, $value)
=======
    public function __construct(string $tag, mixed $value)
>>>>>>> Stashed changes
    {
        $this->tag = $tag;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

<<<<<<< Updated upstream
    /**
     * @return mixed
     */
    public function getValue()
=======
    public function getValue(): mixed
>>>>>>> Stashed changes
    {
        return $this->value;
    }
}
