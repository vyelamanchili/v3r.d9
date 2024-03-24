<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Yaml;

use Symfony\Component\Yaml\Exception\DumpException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Tag\TaggedValue;

/**
 * Inline implements a YAML parser/dumper for the YAML inline syntax.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @internal
 */
class Inline
{
    const REGEX_QUOTED_STRING = '(?:"([^"\\\\]*+(?:\\\\.[^"\\\\]*+)*+)"|\'([^\']*+(?:\'\'[^\']*+)*+)\')';

    public static int $parsedLineNumber = -1;
    public static ?string $parsedFilename = null;

    private static bool $exceptionOnInvalidType = false;
    private static bool $objectSupport = false;
    private static bool $objectForMap = false;
    private static bool $constantSupport = false;

<<<<<<< Updated upstream
    /**
     * @param int         $flags
     * @param int|null    $parsedLineNumber
     * @param string|null $parsedFilename
     */
    public static function initialize($flags, $parsedLineNumber = null, $parsedFilename = null)
=======
    public static function initialize(int $flags, ?int $parsedLineNumber = null, ?string $parsedFilename = null): void
>>>>>>> Stashed changes
    {
        self::$exceptionOnInvalidType = (bool) (Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE & $flags);
        self::$objectSupport = (bool) (Yaml::PARSE_OBJECT & $flags);
        self::$objectForMap = (bool) (Yaml::PARSE_OBJECT_FOR_MAP & $flags);
        self::$constantSupport = (bool) (Yaml::PARSE_CONSTANT & $flags);
        self::$parsedFilename = $parsedFilename;

        if (null !== $parsedLineNumber) {
            self::$parsedLineNumber = $parsedLineNumber;
        }
    }

    /**
     * Converts a YAML string to a PHP value.
     *
     * @param int   $flags      A bit field of Yaml::PARSE_* constants to customize the YAML parser behavior
     * @param array $references Mapping of variable names to values
     *
     * @throws ParseException
     */
<<<<<<< Updated upstream
    public static function parse($value, $flags = 0, $references = [])
=======
    public static function parse(string $value, int $flags = 0, array &$references = []): mixed
>>>>>>> Stashed changes
    {
        if (\is_bool($flags)) {
            @trigger_error('Passing a boolean flag to toggle exception handling is deprecated since Symfony 3.1 and will be removed in 4.0. Use the Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE flag instead.', E_USER_DEPRECATED);

            if ($flags) {
                $flags = Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE;
            } else {
                $flags = 0;
            }
        }

        if (\func_num_args() >= 3 && !\is_array($references)) {
            @trigger_error('Passing a boolean flag to toggle object support is deprecated since Symfony 3.1 and will be removed in 4.0. Use the Yaml::PARSE_OBJECT flag instead.', E_USER_DEPRECATED);

            if ($references) {
                $flags |= Yaml::PARSE_OBJECT;
            }

            if (\func_num_args() >= 4) {
                @trigger_error('Passing a boolean flag to toggle object for map support is deprecated since Symfony 3.1 and will be removed in 4.0. Use the Yaml::PARSE_OBJECT_FOR_MAP flag instead.', E_USER_DEPRECATED);

                if (func_get_arg(3)) {
                    $flags |= Yaml::PARSE_OBJECT_FOR_MAP;
                }
            }

            if (\func_num_args() >= 5) {
                $references = func_get_arg(4);
            } else {
                $references = [];
            }
        }

        self::initialize($flags);

        $value = trim($value);

        if ('' === $value) {
            return '';
        }

<<<<<<< Updated upstream
        if (2 /* MB_OVERLOAD_STRING */ & (int) ini_get('mbstring.func_overload')) {
            $mbEncoding = mb_internal_encoding();
            mb_internal_encoding('ASCII');
        }

        try {
            $i = 0;
            $tag = self::parseTag($value, $i, $flags);
            switch ($value[$i]) {
                case '[':
                    $result = self::parseSequence($value, $flags, $i, $references);
                    ++$i;
                    break;
                case '{':
                    $result = self::parseMapping($value, $flags, $i, $references);
                    ++$i;
                    break;
                default:
                    $result = self::parseScalar($value, $flags, null, $i, null === $tag, $references);
            }

            // some comments are allowed at the end
            if (preg_replace('/\s+#.*$/A', '', substr($value, $i))) {
                throw new ParseException(sprintf('Unexpected characters near "%s".', substr($value, $i)), self::$parsedLineNumber + 1, $value, self::$parsedFilename);
            }

            if (null !== $tag) {
                return new TaggedValue($tag, $result);
            }
=======
        $i = 0;
        $tag = self::parseTag($value, $i, $flags);
        switch ($value[$i]) {
            case '[':
                $result = self::parseSequence($value, $flags, $i, $references);
                ++$i;
                break;
            case '{':
                $result = self::parseMapping($value, $flags, $i, $references);
                ++$i;
                break;
            default:
                $result = self::parseScalar($value, $flags, null, $i, true, $references);
        }

        // some comments are allowed at the end
        if (preg_replace('/\s*#.*$/A', '', substr($value, $i))) {
            throw new ParseException(sprintf('Unexpected characters near "%s".', substr($value, $i)), self::$parsedLineNumber + 1, $value, self::$parsedFilename);
        }
>>>>>>> Stashed changes

        if (null !== $tag && '' !== $tag) {
            return new TaggedValue($tag, $result);
        }

        return $result;
    }

    /**
     * Dumps a given PHP variable to a YAML string.
     *
     * @param mixed $value The PHP variable to convert
     * @param int   $flags A bit field of Yaml::DUMP_* constants to customize the dumped YAML string
     *
     * @throws DumpException When trying to dump PHP resource
     */
<<<<<<< Updated upstream
    public static function dump($value, $flags = 0)
=======
    public static function dump(mixed $value, int $flags = 0): string
>>>>>>> Stashed changes
    {
        if (\is_bool($flags)) {
            @trigger_error('Passing a boolean flag to toggle exception handling is deprecated since Symfony 3.1 and will be removed in 4.0. Use the Yaml::DUMP_EXCEPTION_ON_INVALID_TYPE flag instead.', E_USER_DEPRECATED);

            if ($flags) {
                $flags = Yaml::DUMP_EXCEPTION_ON_INVALID_TYPE;
            } else {
                $flags = 0;
            }
        }

        if (\func_num_args() >= 3) {
            @trigger_error('Passing a boolean flag to toggle object support is deprecated since Symfony 3.1 and will be removed in 4.0. Use the Yaml::DUMP_OBJECT flag instead.', E_USER_DEPRECATED);

            if (func_get_arg(2)) {
                $flags |= Yaml::DUMP_OBJECT;
            }
        }

        switch (true) {
            case \is_resource($value):
                if (Yaml::DUMP_EXCEPTION_ON_INVALID_TYPE & $flags) {
                    throw new DumpException(sprintf('Unable to dump PHP resources in a YAML file ("%s").', get_resource_type($value)));
                }

                return 'null';
            case $value instanceof \DateTimeInterface:
<<<<<<< Updated upstream
                return $value->format('c');
=======
                return $value->format(match (true) {
                    !$length = \strlen(rtrim($value->format('u'), '0')) => 'c',
                    $length < 4 => 'Y-m-d\TH:i:s.vP',
                    default => 'Y-m-d\TH:i:s.uP',
                });
            case $value instanceof \UnitEnum:
                return sprintf('!php/const %s::%s', $value::class, $value->name);
>>>>>>> Stashed changes
            case \is_object($value):
                if ($value instanceof TaggedValue) {
                    return '!'.$value->getTag().' '.self::dump($value->getValue(), $flags);
                }

                if (Yaml::DUMP_OBJECT & $flags) {
                    return '!php/object '.self::dump(serialize($value));
                }

                if (Yaml::DUMP_OBJECT_AS_MAP & $flags && ($value instanceof \stdClass || $value instanceof \ArrayObject)) {
<<<<<<< Updated upstream
                    return self::dumpArray($value, $flags & ~Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE);
=======
                    return self::dumpHashArray($value, $flags);
>>>>>>> Stashed changes
                }

                if (Yaml::DUMP_EXCEPTION_ON_INVALID_TYPE & $flags) {
                    throw new DumpException('Object support when dumping a YAML file has been disabled.');
                }

                return 'null';
            case \is_array($value):
                return self::dumpArray($value, $flags);
            case null === $value:
                return 'null';
            case true === $value:
                return 'true';
            case false === $value:
                return 'false';
            case ctype_digit($value):
                return \is_string($value) ? "'$value'" : (int) $value;
            case is_numeric($value):
                $locale = setlocale(LC_NUMERIC, 0);
                if (false !== $locale) {
                    setlocale(LC_NUMERIC, 'C');
                }
                if (\is_float($value)) {
                    $repr = (string) $value;
                    if (is_infinite($value)) {
                        $repr = str_ireplace('INF', '.Inf', $repr);
                    } elseif (floor($value) == $value && $repr == $value) {
                        // Preserve float data type since storing a whole number will result in integer value.
                        if (!str_contains($repr, 'E')) {
                            $repr .= '.0';
                        }
                    }
                } else {
                    $repr = \is_string($value) ? "'$value'" : (string) $value;
                }
                if (false !== $locale) {
                    setlocale(LC_NUMERIC, $locale);
                }

                return $repr;
            case '' == $value:
                return "''";
            case self::isBinaryString($value):
                return '!!binary '.base64_encode($value);
            case Escaper::requiresDoubleQuoting($value):
                return Escaper::escapeWithDoubleQuotes($value);
            case Escaper::requiresSingleQuoting($value):
                $singleQuoted = Escaper::escapeWithSingleQuotes($value);
                if (!str_contains($value, "'")) {
                    return $singleQuoted;
                }
                // Attempt double-quoting the string instead to see if it's more efficient.
                $doubleQuoted = Escaper::escapeWithDoubleQuotes($value);

                return \strlen($doubleQuoted) < \strlen($singleQuoted) ? $doubleQuoted : $singleQuoted;
            case Parser::preg_match('{^[0-9]+[_0-9]*$}', $value):
            case Parser::preg_match(self::getHexRegex(), $value):
            case Parser::preg_match(self::getTimestampRegex(), $value):
                return Escaper::escapeWithSingleQuotes($value);
            default:
                return $value;
        }
    }

    /**
     * Check if given array is hash or just normal indexed array.
<<<<<<< Updated upstream
     *
     * @internal
     *
     * @param array|\ArrayObject|\stdClass $value The PHP array or array-like object to check
     *
     * @return bool true if value is hash array, false otherwise
     */
    public static function isHash($value)
=======
     */
    public static function isHash(array|\ArrayObject|\stdClass $value): bool
>>>>>>> Stashed changes
    {
        if ($value instanceof \stdClass || $value instanceof \ArrayObject) {
            return true;
        }

        $expectedKey = 0;

        foreach ($value as $key => $val) {
            if ($key !== $expectedKey++) {
                return true;
            }
        }

        return false;
    }

    /**
     * Dumps a PHP array to a YAML string.
     *
     * @param array $value The PHP array to dump
     * @param int   $flags A bit field of Yaml::DUMP_* constants to customize the dumped YAML string
     */
    private static function dumpArray($value, $flags)
    {
        // array
        if (($value || Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE & $flags) && !self::isHash($value)) {
            $output = [];
            foreach ($value as $val) {
                $output[] = self::dump($val, $flags);
            }

            return sprintf('[%s]', implode(', ', $output));
        }

        return self::dumpHashArray($value, $flags);
    }

    /**
     * Dumps hash array to a YAML string.
     *
     * @param array|\ArrayObject|\stdClass $value The hash array to dump
     * @param int                          $flags A bit field of Yaml::DUMP_* constants to customize the dumped YAML string
     */
    private static function dumpHashArray(array|\ArrayObject|\stdClass $value, int $flags): string
    {
        $output = [];
        foreach ($value as $key => $val) {
            if (\is_int($key) && Yaml::DUMP_NUMERIC_KEY_AS_STRING & $flags) {
                $key = (string) $key;
            }

            $output[] = sprintf('%s: %s', self::dump($key, $flags), self::dump($val, $flags));
        }

        return sprintf('{ %s }', implode(', ', $output));
    }

    /**
     * Parses a YAML scalar.
     *
<<<<<<< Updated upstream
     * @param string   $scalar
     * @param int      $flags
     * @param string[] $delimiters
     * @param int      &$i
     * @param bool     $evaluate
     * @param array    $references
     *
     * @return string
     *
=======
>>>>>>> Stashed changes
     * @throws ParseException When malformed inline YAML string is parsed
     *
     * @internal
     */
<<<<<<< Updated upstream
    public static function parseScalar($scalar, $flags = 0, $delimiters = null, &$i = 0, $evaluate = true, $references = [], $legacyOmittedKeySupport = false)
=======
    public static function parseScalar(string $scalar, int $flags = 0, ?array $delimiters = null, int &$i = 0, bool $evaluate = true, array &$references = [], ?bool &$isQuoted = null): mixed
>>>>>>> Stashed changes
    {
        if (\in_array($scalar[$i], ['"', "'"], true)) {
            // quoted scalar
            $output = self::parseQuotedScalar($scalar, $i);

            if (null !== $delimiters) {
                $tmp = ltrim(substr($scalar, $i), ' ');
                if ('' === $tmp) {
                    throw new ParseException(sprintf('Unexpected end of line, expected one of "%s".', implode('', $delimiters)), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                }
                if (!\in_array($tmp[0], $delimiters)) {
                    throw new ParseException(sprintf('Unexpected characters (%s).', substr($scalar, $i)), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                }
            }
        } else {
            // "normal" string
            if (!$delimiters) {
                $output = substr($scalar, $i);
                $i += \strlen($output);

                // remove comments
                if (Parser::preg_match('/[ \t]+#/', $output, $match, PREG_OFFSET_CAPTURE)) {
                    $output = substr($output, 0, $match[0][1]);
                }
            } elseif (Parser::preg_match('/^(.'.($legacyOmittedKeySupport ? '+' : '*').'?)('.implode('|', $delimiters).')/', substr($scalar, $i), $match)) {
                $output = $match[1];
                $i += \strlen($output);
            } else {
                throw new ParseException(sprintf('Malformed inline YAML string: "%s".', $scalar), self::$parsedLineNumber + 1, null, self::$parsedFilename);
            }

            // a non-quoted string cannot start with @ or ` (reserved) nor with a scalar indicator (| or >)
            if ($output && ('@' === $output[0] || '`' === $output[0] || '|' === $output[0] || '>' === $output[0])) {
                throw new ParseException(sprintf('The reserved indicator "%s" cannot start a plain scalar; you need to quote the scalar.', $output[0]), self::$parsedLineNumber + 1, $output, self::$parsedFilename);
            }

            if ($output && '%' === $output[0]) {
                @trigger_error(self::getDeprecationMessage(sprintf('Not quoting the scalar "%s" starting with the "%%" indicator character is deprecated since Symfony 3.1 and will throw a ParseException in 4.0.', $output)), E_USER_DEPRECATED);
            }

            if ($evaluate) {
                $output = self::evaluateScalar($output, $flags, $references);
            }
        }

        return $output;
    }

    /**
     * Parses a YAML quoted scalar.
     *
     * @param string $scalar
     * @param int    &$i
     *
     * @return string
     *
     * @throws ParseException When malformed inline YAML string is parsed
     */
    private static function parseQuotedScalar($scalar, &$i)
    {
        if (!Parser::preg_match('/'.self::REGEX_QUOTED_STRING.'/Au', substr($scalar, $i), $match)) {
            throw new ParseException(sprintf('Malformed inline YAML string: "%s".', substr($scalar, $i)), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
        }

        $output = substr($match[0], 1, -1);

        $unescaper = new Unescaper();
        if ('"' == $scalar[$i]) {
            $output = $unescaper->unescapeDoubleQuotedString($output);
        } else {
            $output = $unescaper->unescapeSingleQuotedString($output);
        }

        $i += \strlen($match[0]);

        return $output;
    }

    /**
     * Parses a YAML sequence.
     *
     * @param string $sequence
     * @param int    $flags
     * @param int    &$i
     * @param array  $references
     *
     * @return array
     *
     * @throws ParseException When malformed inline YAML string is parsed
     */
    private static function parseSequence($sequence, $flags, &$i = 0, $references = [])
    {
        $output = [];
        $len = \strlen($sequence);
        ++$i;

        // [foo, bar, ...]
        while ($i < $len) {
            if (']' === $sequence[$i]) {
                return $output;
            }
            if (',' === $sequence[$i] || ' ' === $sequence[$i]) {
                ++$i;

                continue;
            }

            $tag = self::parseTag($sequence, $i, $flags);
            switch ($sequence[$i]) {
                case '[':
                    // nested sequence
                    $value = self::parseSequence($sequence, $flags, $i, $references);
                    break;
                case '{':
                    // nested mapping
                    $value = self::parseMapping($sequence, $flags, $i, $references);
                    break;
                default:
                    $isQuoted = \in_array($sequence[$i], ['"', "'"]);
                    $value = self::parseScalar($sequence, $flags, [',', ']'], $i, null === $tag, $references);

                    // the value can be an array if a reference has been resolved to an array var
                    if (\is_string($value) && !$isQuoted && str_contains($value, ': ')) {
                        // embedded mapping?
                        try {
                            $pos = 0;
                            $value = self::parseMapping('{'.$value.'}', $flags, $pos, $references);
                        } catch (\InvalidArgumentException) {
                            // no, it's not
                        }
                    }

                    --$i;
            }

            if (null !== $tag) {
                $value = new TaggedValue($tag, $value);
            }

            $output[] = $value;

            ++$i;
        }

        throw new ParseException(sprintf('Malformed inline YAML string: "%s".', $sequence), self::$parsedLineNumber + 1, null, self::$parsedFilename);
    }

    /**
     * Parses a YAML mapping.
     *
<<<<<<< Updated upstream
     * @param string $mapping
     * @param int    $flags
     * @param int    &$i
     * @param array  $references
     *
     * @return array|\stdClass
     *
     * @throws ParseException When malformed inline YAML string is parsed
     */
    private static function parseMapping($mapping, $flags, &$i = 0, $references = [])
=======
     * @throws ParseException When malformed inline YAML string is parsed
     */
    private static function parseMapping(string $mapping, int $flags, int &$i = 0, array &$references = []): array|\stdClass
>>>>>>> Stashed changes
    {
        $output = [];
        $len = \strlen($mapping);
        ++$i;
        $allowOverwrite = false;

        // {foo: bar, bar:foo, ...}
        while ($i < $len) {
            switch ($mapping[$i]) {
                case ' ':
                case ',':
                    ++$i;
                    continue 2;
                case '}':
                    if (self::$objectForMap) {
                        return (object) $output;
                    }

                    return $output;
            }

            // key
            $isKeyQuoted = \in_array($mapping[$i], ['"', "'"], true);
            $key = self::parseScalar($mapping, $flags, [':', ' '], $i, false, [], true);

<<<<<<< Updated upstream
            if ('!php/const' === $key) {
                $key .= self::parseScalar($mapping, $flags, [':', ' '], $i, false, [], true);
                if ('!php/const:' === $key && ':' !== $mapping[$i]) {
                    $key = '';
                    --$i;
                } else {
                    $key = self::evaluateScalar($key, $flags);
                }
=======
            if ('!php/const' === $key || '!php/enum' === $key) {
                $key .= ' '.self::parseScalar($mapping, $flags, [':'], $i, false);
                $key = self::evaluateScalar($key, $flags);
>>>>>>> Stashed changes
            }

            if (':' !== $key && false === $i = strpos($mapping, ':', $i)) {
                break;
            }

            if (':' === $key) {
                @trigger_error(self::getDeprecationMessage('Omitting the key of a mapping is deprecated and will throw a ParseException in 4.0.'), E_USER_DEPRECATED);
            }

            if (!$isKeyQuoted) {
                $evaluatedKey = self::evaluateScalar($key, $flags, $references);

                if ('' !== $key && $evaluatedKey !== $key && !\is_string($evaluatedKey) && !\is_int($evaluatedKey)) {
                    @trigger_error(self::getDeprecationMessage('Implicit casting of incompatible mapping keys to strings is deprecated since Symfony 3.3 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0. Quote your evaluable mapping keys instead.'), E_USER_DEPRECATED);
                }
            }

            if (':' !== $key && !$isKeyQuoted && (!isset($mapping[$i + 1]) || !\in_array($mapping[$i + 1], [' ', ',', '[', ']', '{', '}'], true))) {
                @trigger_error(self::getDeprecationMessage('Using a colon after an unquoted mapping key that is not followed by an indication character (i.e. " ", ",", "[", "]", "{", "}") is deprecated since Symfony 3.2 and will throw a ParseException in 4.0.'), E_USER_DEPRECATED);
            }

            if ('<<' === $key) {
                $allowOverwrite = true;
            }

            while ($i < $len) {
                if (':' === $mapping[$i] || ' ' === $mapping[$i]) {
                    ++$i;

                    continue;
                }

                $tag = self::parseTag($mapping, $i, $flags);
                switch ($mapping[$i]) {
                    case '[':
                        // nested sequence
                        $value = self::parseSequence($mapping, $flags, $i, $references);
                        // Spec: Keys MUST be unique; first one wins.
                        // Parser cannot abort this mapping earlier, since lines
                        // are processed sequentially.
                        // But overwriting is allowed when a merge node is used in current block.
                        if ('<<' === $key) {
                            foreach ($value as $parsedValue) {
                                $output += $parsedValue;
                            }
                        } elseif ($allowOverwrite || !isset($output[$key])) {
                            if (null !== $tag) {
                                $output[$key] = new TaggedValue($tag, $value);
                            } else {
                                $output[$key] = $value;
                            }
                        } elseif (isset($output[$key])) {
                            @trigger_error(self::getDeprecationMessage(sprintf('Duplicate key "%s" detected whilst parsing YAML. Silent handling of duplicate mapping keys in YAML is deprecated since Symfony 3.2 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0.', $key)), E_USER_DEPRECATED);
                        }
                        break;
                    case '{':
                        // nested mapping
                        $value = self::parseMapping($mapping, $flags, $i, $references);
                        // Spec: Keys MUST be unique; first one wins.
                        // Parser cannot abort this mapping earlier, since lines
                        // are processed sequentially.
                        // But overwriting is allowed when a merge node is used in current block.
                        if ('<<' === $key) {
                            $output += $value;
                        } elseif ($allowOverwrite || !isset($output[$key])) {
                            if (null !== $tag) {
                                $output[$key] = new TaggedValue($tag, $value);
                            } else {
                                $output[$key] = $value;
                            }
                        } elseif (isset($output[$key])) {
                            @trigger_error(self::getDeprecationMessage(sprintf('Duplicate key "%s" detected whilst parsing YAML. Silent handling of duplicate mapping keys in YAML is deprecated since Symfony 3.2 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0.', $key)), E_USER_DEPRECATED);
                        }
                        break;
                    default:
                        $value = self::parseScalar($mapping, $flags, [',', '}'], $i, null === $tag, $references);
                        // Spec: Keys MUST be unique; first one wins.
                        // Parser cannot abort this mapping earlier, since lines
                        // are processed sequentially.
                        // But overwriting is allowed when a merge node is used in current block.
                        if ('<<' === $key) {
                            $output += $value;
                        } elseif ($allowOverwrite || !isset($output[$key])) {
<<<<<<< Updated upstream
=======
                            if (!$isValueQuoted && \is_string($value) && '' !== $value && '&' === $value[0] && !self::isBinaryString($value) && Parser::preg_match(Parser::REFERENCE_PATTERN, $value, $matches)) {
                                $references[$matches['ref']] = $matches['value'];
                                $value = $matches['value'];
                            }

>>>>>>> Stashed changes
                            if (null !== $tag) {
                                $output[$key] = new TaggedValue($tag, $value);
                            } else {
                                $output[$key] = $value;
                            }
                        } elseif (isset($output[$key])) {
                            @trigger_error(self::getDeprecationMessage(sprintf('Duplicate key "%s" detected whilst parsing YAML. Silent handling of duplicate mapping keys in YAML is deprecated since Symfony 3.2 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0.', $key)), E_USER_DEPRECATED);
                        }
                        --$i;
                }
                ++$i;

                continue 2;
            }
        }

        throw new ParseException(sprintf('Malformed inline YAML string: "%s".', $mapping), self::$parsedLineNumber + 1, null, self::$parsedFilename);
    }

    /**
     * Evaluates scalars and replaces magic values.
     *
<<<<<<< Updated upstream
     * @param string $scalar
     * @param int    $flags
     * @param array  $references
     *
     * @return mixed The evaluated YAML string
     *
     * @throws ParseException when object parsing support was disabled and the parser detected a PHP object or when a reference could not be resolved
     */
    private static function evaluateScalar($scalar, $flags, $references = [])
=======
     * @throws ParseException when object parsing support was disabled and the parser detected a PHP object or when a reference could not be resolved
     */
    private static function evaluateScalar(string $scalar, int $flags, array &$references = [], ?bool &$isQuotedString = null): mixed
>>>>>>> Stashed changes
    {
        $scalar = trim($scalar);

        if (str_starts_with($scalar, '*')) {
            if (false !== $pos = strpos($scalar, '#')) {
                $value = substr($scalar, 1, $pos - 2);
            } else {
                $value = substr($scalar, 1);
            }

            // an unquoted *
            if (false === $value || '' === $value) {
                throw new ParseException('A reference must contain at least one character.', self::$parsedLineNumber + 1, $value, self::$parsedFilename);
            }

            if (!\array_key_exists($value, $references)) {
                throw new ParseException(sprintf('Reference "%s" does not exist.', $value), self::$parsedLineNumber + 1, $value, self::$parsedFilename);
            }

            return $references[$value];
        }

        $scalarLower = strtolower($scalar);

        switch (true) {
            case 'null' === $scalarLower:
            case '' === $scalar:
            case '~' === $scalar:
                return null;
            case 'true' === $scalarLower:
                return true;
            case 'false' === $scalarLower:
                return false;
            case '!' === $scalar[0]:
                switch (true) {
<<<<<<< Updated upstream
                    case 0 === strpos($scalar, '!str'):
                        @trigger_error(self::getDeprecationMessage('Support for the !str tag is deprecated since Symfony 3.4. Use the !!str tag instead.'), E_USER_DEPRECATED);

                        return (string) substr($scalar, 5);
                    case 0 === strpos($scalar, '!!str '):
                        return (string) substr($scalar, 6);
                    case 0 === strpos($scalar, '! '):
                        @trigger_error(self::getDeprecationMessage('Using the non-specific tag "!" is deprecated since Symfony 3.4 as its behavior will change in 4.0. It will force non-evaluating your values in 4.0. Use plain integers or !!float instead.'), E_USER_DEPRECATED);

                        return (int) self::parseScalar(substr($scalar, 2), $flags);
                    case 0 === strpos($scalar, '!php/object:'):
                        if (self::$objectSupport) {
                            @trigger_error(self::getDeprecationMessage('The !php/object: tag to indicate dumped PHP objects is deprecated since Symfony 3.4 and will be removed in 4.0. Use the !php/object (without the colon) tag instead.'), E_USER_DEPRECATED);
=======
                    case str_starts_with($scalar, '!!str '):
                        $s = (string) substr($scalar, 6);
>>>>>>> Stashed changes

                            return unserialize(substr($scalar, 12));
                        }

<<<<<<< Updated upstream
                        if (self::$exceptionOnInvalidType) {
                            throw new ParseException('Object support when parsing a YAML file has been disabled.', self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                        }

                        return null;
                    case 0 === strpos($scalar, '!!php/object:'):
                        if (self::$objectSupport) {
                            @trigger_error(self::getDeprecationMessage('The !!php/object: tag to indicate dumped PHP objects is deprecated since Symfony 3.1 and will be removed in 4.0. Use the !php/object (without the colon) tag instead.'), E_USER_DEPRECATED);

                            return unserialize(substr($scalar, 13));
                        }

                        if (self::$exceptionOnInvalidType) {
                            throw new ParseException('Object support when parsing a YAML file has been disabled.', self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                        }

                        return null;
                    case 0 === strpos($scalar, '!php/object'):
=======
                        return $s;
                    case str_starts_with($scalar, '! '):
                        return substr($scalar, 2);
                    case str_starts_with($scalar, '!php/object'):
>>>>>>> Stashed changes
                        if (self::$objectSupport) {
                            if (!isset($scalar[12])) {
                                throw new ParseException('Missing value for tag "!php/object".', self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                            }

                            return unserialize(self::parseScalar(substr($scalar, 12)));
                        }

                        if (self::$exceptionOnInvalidType) {
                            throw new ParseException('Object support when parsing a YAML file has been disabled.', self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                        }

                        return null;
<<<<<<< Updated upstream
                    case 0 === strpos($scalar, '!php/const:'):
                        if (self::$constantSupport) {
                            @trigger_error(self::getDeprecationMessage('The !php/const: tag to indicate dumped PHP constants is deprecated since Symfony 3.4 and will be removed in 4.0. Use the !php/const (without the colon) tag instead.'), E_USER_DEPRECATED);

                            if (\defined($const = substr($scalar, 11))) {
                                return \constant($const);
                            }

                            throw new ParseException(sprintf('The constant "%s" is not defined.', $const), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                        }
                        if (self::$exceptionOnInvalidType) {
                            throw new ParseException(sprintf('The string "%s" could not be parsed as a constant. Did you forget to pass the "Yaml::PARSE_CONSTANT" flag to the parser?', $scalar), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                        }

                        return null;
                    case 0 === strpos($scalar, '!php/const'):
=======
                    case str_starts_with($scalar, '!php/const'):
>>>>>>> Stashed changes
                        if (self::$constantSupport) {
                            if (!isset($scalar[11])) {
                                throw new ParseException('Missing value for tag "!php/const".', self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                            }

                            $i = 0;
                            if (\defined($const = self::parseScalar(substr($scalar, 11), 0, null, $i, false))) {
                                return \constant($const);
                            }

                            throw new ParseException(sprintf('The constant "%s" is not defined.', $const), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                        }
                        if (self::$exceptionOnInvalidType) {
                            throw new ParseException(sprintf('The string "%s" could not be parsed as a constant. Did you forget to pass the "Yaml::PARSE_CONSTANT" flag to the parser?', $scalar), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                        }

                        return null;
                    case str_starts_with($scalar, '!php/enum'):
                        if (self::$constantSupport) {
                            if (!isset($scalar[11])) {
                                throw new ParseException('Missing value for tag "!php/enum".', self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                            }

                            $i = 0;
                            $enum = self::parseScalar(substr($scalar, 10), 0, null, $i, false);
                            if ($useValue = str_ends_with($enum, '->value')) {
                                $enum = substr($enum, 0, -7);
                            }
                            if (!\defined($enum)) {
                                throw new ParseException(sprintf('The enum "%s" is not defined.', $enum), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                            }

                            $value = \constant($enum);

                            if (!$value instanceof \UnitEnum) {
                                throw new ParseException(sprintf('The string "%s" is not the name of a valid enum.', $enum), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                            }
                            if (!$useValue) {
                                return $value;
                            }
                            if (!$value instanceof \BackedEnum) {
                                throw new ParseException(sprintf('The enum "%s" defines no value next to its name.', $enum), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                            }

                            return $value->value;
                        }
                        if (self::$exceptionOnInvalidType) {
                            throw new ParseException(sprintf('The string "%s" could not be parsed as an enum. Did you forget to pass the "Yaml::PARSE_CONSTANT" flag to the parser?', $scalar), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
                        }

                        return null;
                    case str_starts_with($scalar, '!!float '):
                        return (float) substr($scalar, 8);
                    case str_starts_with($scalar, '!!binary '):
                        return self::evaluateBinaryScalar(substr($scalar, 9));
<<<<<<< Updated upstream
                    default:
                        @trigger_error(self::getDeprecationMessage(sprintf('Using the unquoted scalar value "%s" is deprecated since Symfony 3.3 and will be considered as a tagged value in 4.0. You must quote it.', $scalar)), E_USER_DEPRECATED);
=======
>>>>>>> Stashed changes
                }

                throw new ParseException(sprintf('The string "%s" could not be parsed as it uses an unsupported built-in tag.', $scalar), self::$parsedLineNumber, $scalar, self::$parsedFilename);
            case preg_match('/^(?:\+|-)?0o(?P<value>[0-7_]++)$/', $scalar, $matches):
                $value = str_replace('_', '', $matches['value']);

                if ('-' === $scalar[0]) {
                    return -octdec($value);
                }

                return octdec($value);
            case \in_array($scalar[0], ['+', '-', '.'], true) || is_numeric($scalar[0]):
                if (Parser::preg_match('{^[+-]?[0-9][0-9_]*$}', $scalar)) {
                    $scalar = str_replace('_', '', (string) $scalar);
                }

                switch (true) {
                    case ctype_digit($scalar):
<<<<<<< Updated upstream
                        if ('0' === $scalar[0]) {
                            return octdec(preg_replace('/[^0-7]/', '', $scalar));
                        }

                        $cast = (int) $scalar;

                        return ($scalar === (string) $cast) ? $cast : $scalar;
                    case '-' === $scalar[0] && ctype_digit(substr($scalar, 1)):
                        if ('0' === $scalar[1]) {
                            return -octdec(preg_replace('/[^0-7]/', '', substr($scalar, 1)));
                        }

=======
                    case '-' === $scalar[0] && ctype_digit(substr($scalar, 1)):
>>>>>>> Stashed changes
                        $cast = (int) $scalar;

                        return ($scalar === (string) $cast) ? $cast : $scalar;
                    case is_numeric($scalar):
                    case Parser::preg_match(self::getHexRegex(), $scalar):
                        $scalar = str_replace('_', '', $scalar);

                        return '0x' === $scalar[0].$scalar[1] ? hexdec($scalar) : (float) $scalar;
                    case '.inf' === $scalarLower:
                    case '.nan' === $scalarLower:
                        return -log(0);
                    case '-.inf' === $scalarLower:
                        return log(0);
                    case Parser::preg_match('/^(-|\+)?[0-9][0-9,]*(\.[0-9_]+)?$/', $scalar):
                    case Parser::preg_match('/^(-|\+)?[0-9][0-9_]*(\.[0-9_]+)?$/', $scalar):
<<<<<<< Updated upstream
                        if (false !== strpos($scalar, ',')) {
                            @trigger_error(self::getDeprecationMessage('Using the comma as a group separator for floats is deprecated since Symfony 3.2 and will be removed in 4.0.'), E_USER_DEPRECATED);
                        }
=======
                        return (float) str_replace('_', '', $scalar);
                    case Parser::preg_match(self::getTimestampRegex(), $scalar):
                        // When no timezone is provided in the parsed date, YAML spec says we must assume UTC.
                        $time = new \DateTimeImmutable($scalar, new \DateTimeZone('UTC'));
>>>>>>> Stashed changes

                        return (float) str_replace([',', '_'], '', $scalar);
                    case Parser::preg_match(self::getTimestampRegex(), $scalar):
                        if (Yaml::PARSE_DATETIME & $flags) {
                            // When no timezone is provided in the parsed date, YAML spec says we must assume UTC.
                            return new \DateTime($scalar, new \DateTimeZone('UTC'));
                        }

<<<<<<< Updated upstream
                        $timeZone = date_default_timezone_get();
                        date_default_timezone_set('UTC');
                        $time = strtotime($scalar);
                        date_default_timezone_set($timeZone);
=======
                        if ('' !== rtrim($time->format('u'), '0')) {
                            return (float) $time->format('U.u');
                        }

                        try {
                            if (false !== $scalar = $time->getTimestamp()) {
                                return $scalar;
                            }
                        } catch (\ValueError) {
                            // no-op
                        }
>>>>>>> Stashed changes

                        return $time;
                }
        }

        return (string) $scalar;
    }

    /**
     * @param string $value
     * @param int    &$i
     * @param int    $flags
     *
     * @return string|null
     */
    private static function parseTag($value, &$i, $flags)
    {
        if ('!' !== $value[$i]) {
            return null;
        }

        $tagLength = strcspn($value, " \t\n", $i + 1);
        $tag = substr($value, $i + 1, $tagLength);

        $nextOffset = $i + $tagLength + 1;
        $nextOffset += strspn($value, ' ', $nextOffset);

<<<<<<< Updated upstream
        // Is followed by a scalar
        if ((!isset($value[$nextOffset]) || !\in_array($value[$nextOffset], ['[', '{'], true)) && 'tagged' !== $tag) {
            // Manage non-whitelisted scalars in {@link self::evaluateScalar()}
=======
        if ('' === $tag && (!isset($value[$nextOffset]) || \in_array($value[$nextOffset], [']', '}', ','], true))) {
            throw new ParseException('Using the unquoted scalar value "!" is not supported. You must quote it.', self::$parsedLineNumber + 1, $value, self::$parsedFilename);
        }

        // Is followed by a scalar and is a built-in tag
        if ('' !== $tag && (!isset($value[$nextOffset]) || !\in_array($value[$nextOffset], ['[', '{'], true)) && ('!' === $tag[0] || \in_array($tag, ['str', 'php/const', 'php/enum', 'php/object'], true))) {
            // Manage in {@link self::evaluateScalar()}
>>>>>>> Stashed changes
            return null;
        }

        // Built-in tags
        if ($tag && '!' === $tag[0]) {
            throw new ParseException(sprintf('The built-in tag "!%s" is not implemented.', $tag), self::$parsedLineNumber + 1, $value, self::$parsedFilename);
        }

        if (Yaml::PARSE_CUSTOM_TAGS & $flags) {
            $i = $nextOffset;

            return $tag;
        }

        throw new ParseException(sprintf('Tags support is not enabled. Enable the `Yaml::PARSE_CUSTOM_TAGS` flag to use "!%s".', $tag), self::$parsedLineNumber + 1, $value, self::$parsedFilename);
    }

    /**
     * @param string $scalar
     *
     * @return string
     *
     * @internal
     */
    public static function evaluateBinaryScalar($scalar)
    {
        $parsedBinaryData = self::parseScalar(preg_replace('/\s/', '', $scalar));

        if (0 !== (\strlen($parsedBinaryData) % 4)) {
            throw new ParseException(sprintf('The normalized base64 encoded data (data without whitespace characters) length must be a multiple of four (%d bytes given).', \strlen($parsedBinaryData)), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
        }

        if (!Parser::preg_match('#^[A-Z0-9+/]+={0,2}$#i', $parsedBinaryData)) {
            throw new ParseException(sprintf('The base64 encoded data (%s) contains invalid characters.', $parsedBinaryData), self::$parsedLineNumber + 1, $scalar, self::$parsedFilename);
        }

        return base64_decode($parsedBinaryData, true);
    }

<<<<<<< Updated upstream
    private static function isBinaryString($value)
=======
    private static function isBinaryString(string $value): bool
>>>>>>> Stashed changes
    {
        return !preg_match('//u', $value) || preg_match('/[^\x00\x07-\x0d\x1B\x20-\xff]/', $value);
    }

    /**
     * Gets a regex that matches a YAML date.
     *
     * @see http://www.yaml.org/spec/1.2/spec.html#id2761573
     */
    private static function getTimestampRegex()
    {
        return <<<EOF
        ~^
        (?P<year>[0-9][0-9][0-9][0-9])
        -(?P<month>[0-9][0-9]?)
        -(?P<day>[0-9][0-9]?)
        (?:(?:[Tt]|[ \t]+)
        (?P<hour>[0-9][0-9]?)
        :(?P<minute>[0-9][0-9])
        :(?P<second>[0-9][0-9])
        (?:\.(?P<fraction>[0-9]*))?
        (?:[ \t]*(?P<tz>Z|(?P<tz_sign>[-+])(?P<tz_hour>[0-9][0-9]?)
        (?::(?P<tz_minute>[0-9][0-9]))?))?)?
        $~x
EOF;
    }

    /**
     * Gets a regex that matches a YAML number in hexadecimal notation.
     *
     * @return string
     */
    private static function getHexRegex()
    {
        return '~^0x[0-9a-f_]++$~i';
    }

    private static function getDeprecationMessage($message)
    {
        $message = rtrim($message, '.');

        if (null !== self::$parsedFilename) {
            $message .= ' in '.self::$parsedFilename;
        }

        if (-1 !== self::$parsedLineNumber) {
            $message .= ' on line '.(self::$parsedLineNumber + 1);
        }

        return $message.'.';
    }
}
