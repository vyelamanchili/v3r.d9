<?php
<<<<<<< Updated upstream
=======

declare(strict_types=1);

>>>>>>> Stashed changes
namespace GuzzleHttp\Promise;

/**
 * A promise that has been rejected.
 *
 * Thenning off of this promise will invoke the onRejected callback
 * immediately and ignore other callbacks.
 *
 * @final
 */
class RejectedPromise implements PromiseInterface
{
    private $reason;

    /**
     * @param mixed $reason
     */
    public function __construct($reason)
    {
        if (method_exists($reason, 'then')) {
            throw new \InvalidArgumentException(
                'You cannot create a RejectedPromise with a promise.');
        }

        $this->reason = $reason;
    }

    public function then(
        callable $onFulfilled = null,
        callable $onRejected = null
    ): PromiseInterface {
        // If there's no onRejected callback then just return self.
        if (!$onRejected) {
            return $this;
        }

        $queue = queue();
        $reason = $this->reason;
        $p = new Promise([$queue, 'run']);
<<<<<<< Updated upstream
        $queue->add(static function () use ($p, $reason, $onRejected) {
            if ($p->getState() === self::PENDING) {
=======
        $queue->add(static function () use ($p, $reason, $onRejected): void {
            if (Is::pending($p)) {
>>>>>>> Stashed changes
                try {
                    // Return a resolved promise if onRejected does not throw.
                    $p->resolve($onRejected($reason));
                } catch (\Throwable $e) {
                    // onRejected threw, so return a rejected promise.
                    $p->reject($e);
                }
            }
        });

        return $p;
    }

    public function otherwise(callable $onRejected): PromiseInterface
    {
        return $this->then(null, $onRejected);
    }

    public function wait(bool $unwrap = true)
    {
        if ($unwrap) {
            throw exception_for($this->reason);
        }
    }

    public function getState(): string
    {
        return self::REJECTED;
    }

    public function resolve($value): void
    {
        throw new \LogicException('Cannot resolve a rejected promise');
    }

    public function reject($reason): void
    {
        if ($reason !== $this->reason) {
            throw new \LogicException('Cannot reject a rejected promise');
        }
    }

    public function cancel(): void
    {
        // pass
    }
}
