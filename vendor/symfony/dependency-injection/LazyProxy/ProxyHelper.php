<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\LazyProxy;

trigger_deprecation('symfony/dependency-injection', '6.2', 'The "%s" class is deprecated, use "%s" instead.', ProxyHelper::class, \Symfony\Component\VarExporter\ProxyHelper::class);

/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @deprecated since Symfony 6.2, use VarExporter's ProxyHelper instead
 */
class ProxyHelper
{
    /**
     * @return string|null The FQCN or builtin name of the type hint, or null when the type hint references an invalid self|parent context
     */
<<<<<<< Updated upstream
    public static function getTypeHint(\ReflectionFunctionAbstract $r, \ReflectionParameter $p = null, $noBuiltin = false)
=======
    public static function getTypeHint(\ReflectionFunctionAbstract $r, ?\ReflectionParameter $p = null, bool $noBuiltin = false): ?string
>>>>>>> Stashed changes
    {
        if ($p instanceof \ReflectionParameter) {
            if (method_exists($p, 'getType')) {
                $type = $p->getType();
            } elseif (preg_match('/^(?:[^ ]++ ){4}([a-zA-Z_\x7F-\xFF][^ ]++)/', $p, $type)) {
                $name = $type = $type[1];

                if ('callable' === $name || 'array' === $name) {
                    return $noBuiltin ? null : $name;
                }
            }
        } else {
            $type = method_exists($r, 'getReturnType') ? $r->getReturnType() : null;
        }
        if (!$type) {
            return null;
        }
        if (!\is_string($type)) {
            $name = $type instanceof \ReflectionNamedType ? $type->getName() : $type->__toString();

            if ($type->isBuiltin()) {
                return $noBuiltin ? null : $name;
            }
        }
        $lcName = strtolower($name);
        $prefix = $noBuiltin ? '' : '\\';

        if ('self' !== $lcName && 'parent' !== $lcName) {
            return $prefix.$name;
        }
        if (!$r instanceof \ReflectionMethod) {
            return null;
        }
        if ('self' === $lcName) {
            return $prefix.$r->getDeclaringClass()->name;
        }

<<<<<<< Updated upstream
        return ($parent = $r->getDeclaringClass()->getParentClass()) ? $prefix.$parent->name : null;
=======
        sort($types);

        return $types ? implode($glue, $types) : null;
>>>>>>> Stashed changes
    }
}
