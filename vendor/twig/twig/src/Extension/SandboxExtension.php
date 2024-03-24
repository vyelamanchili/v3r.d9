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

use Twig\NodeVisitor\SandboxNodeVisitor;
use Twig\Sandbox\SecurityPolicyInterface;
use Twig\TokenParser\SandboxTokenParser;

/**
 * @final
 */
class SandboxExtension extends AbstractExtension
{
    protected $sandboxedGlobally;
    protected $sandboxed;
    protected $policy;

    public function __construct(SecurityPolicyInterface $policy, $sandboxed = false)
    {
        $this->policy = $policy;
        $this->sandboxedGlobally = $sandboxed;
    }

    public function getTokenParsers(): array
    {
        return [new SandboxTokenParser()];
    }

    public function getNodeVisitors(): array
    {
        return [new SandboxNodeVisitor()];
    }

    public function enableSandbox(): void
    {
        $this->sandboxed = true;
    }

    public function disableSandbox(): void
    {
        $this->sandboxed = false;
    }

    public function isSandboxed(): bool
    {
        return $this->sandboxedGlobally || $this->sandboxed;
    }

    public function isSandboxedGlobally(): bool
    {
        return $this->sandboxedGlobally;
    }

    public function setSecurityPolicy(SecurityPolicyInterface $policy)
    {
        $this->policy = $policy;
    }

    public function getSecurityPolicy(): SecurityPolicyInterface
    {
        return $this->policy;
    }

    public function checkSecurity($tags, $filters, $functions): void
    {
        if ($this->isSandboxed()) {
            $this->policy->checkSecurity($tags, $filters, $functions);
        }
    }

<<<<<<< Updated upstream
    public function checkMethodAllowed($obj, $method)
=======
    public function checkMethodAllowed($obj, $method, int $lineno = -1, Source $source = null): void
>>>>>>> Stashed changes
    {
        if ($this->isSandboxed()) {
            $this->policy->checkMethodAllowed($obj, $method);
        }
    }

<<<<<<< Updated upstream
    public function checkPropertyAllowed($obj, $method)
=======
    public function checkPropertyAllowed($obj, $property, int $lineno = -1, Source $source = null): void
>>>>>>> Stashed changes
    {
        if ($this->isSandboxed()) {
            $this->policy->checkPropertyAllowed($obj, $method);
        }
    }

    public function ensureToStringAllowed($obj)
    {
        if ($this->isSandboxed() && \is_object($obj) && method_exists($obj, '__toString')) {
            $this->policy->checkMethodAllowed($obj, '__toString');
        }

        return $obj;
    }

    public function getName()
    {
        return 'sandbox';
    }
}
