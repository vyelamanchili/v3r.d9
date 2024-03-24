<?php
<<<<<<< Updated upstream
=======

declare(strict_types=1);

>>>>>>> Stashed changes
namespace GuzzleHttp\Promise;

/**
 * Represents a promise that iterates over many promises and invokes
 * side-effect functions in the process.
 *
 * @final
 */
class EachPromise implements PromisorInterface
{
    private $pending = [];

    /** @var \Iterator */
    private $iterable;

    /** @var callable|int */
    private $concurrency;

    /** @var callable */
    private $onFulfilled;

    /** @var callable */
    private $onRejected;

    /** @var Promise */
    private $aggregate;

    /** @var bool */
    private $mutex;

    /**
     * Configuration hash can include the following key value pairs:
     *
     * - fulfilled: (callable) Invoked when a promise fulfills. The function
     *   is invoked with three arguments: the fulfillment value, the index
     *   position from the iterable list of the promise, and the aggregate
     *   promise that manages all of the promises. The aggregate promise may
     *   be resolved from within the callback to short-circuit the promise.
     * - rejected: (callable) Invoked when a promise is rejected. The
     *   function is invoked with three arguments: the rejection reason, the
     *   index position from the iterable list of the promise, and the
     *   aggregate promise that manages all of the promises. The aggregate
     *   promise may be resolved from within the callback to short-circuit
     *   the promise.
     * - concurrency: (integer) Pass this configuration option to limit the
     *   allowed number of outstanding concurrently executing promises,
     *   creating a capped pool of promises. There is no limit by default.
     *
     * @param mixed    $iterable Promises or values to iterate.
     * @param array    $config   Configuration options
     */
    public function __construct($iterable, array $config = [])
    {
        $this->iterable = iter_for($iterable);

        if (isset($config['concurrency'])) {
            $this->concurrency = $config['concurrency'];
        }

        if (isset($config['fulfilled'])) {
            $this->onFulfilled = $config['fulfilled'];
        }

        if (isset($config['rejected'])) {
            $this->onRejected = $config['rejected'];
        }
    }

<<<<<<< Updated upstream
    public function promise()
=======
    /** @psalm-suppress InvalidNullableReturnType */
    public function promise(): PromiseInterface
>>>>>>> Stashed changes
    {
        if ($this->aggregate) {
            return $this->aggregate;
        }

        try {
            $this->createPromise();
            $this->iterable->rewind();
            $this->refillPending();
        } catch (\Throwable $e) {
            $this->aggregate->reject($e);
        }

<<<<<<< Updated upstream
=======
        /**
         * @psalm-suppress NullableReturnStatement
         */
>>>>>>> Stashed changes
        return $this->aggregate;
    }

    private function createPromise(): void
    {
        $this->mutex = false;
<<<<<<< Updated upstream
        $this->aggregate = new Promise(function () {
            reset($this->pending);
            if (empty($this->pending) && !$this->iterable->valid()) {
                $this->aggregate->resolve(null);
=======
        $this->aggregate = new Promise(function (): void {
            if ($this->checkIfFinished()) {
>>>>>>> Stashed changes
                return;
            }

            // Consume a potentially fluctuating list of promises while
            // ensuring that indexes are maintained (precluding array_shift).
            while ($promise = current($this->pending)) {
                next($this->pending);
                $promise->wait();
                if ($this->aggregate->getState() !== PromiseInterface::PENDING) {
                    return;
                }
            }
        });

        // Clear the references when the promise is resolved.
        $clearFn = function (): void {
            $this->iterable = $this->concurrency = $this->pending = null;
            $this->onFulfilled = $this->onRejected = null;
        };

        $this->aggregate->then($clearFn, $clearFn);
    }

    private function refillPending(): void
    {
        if (!$this->concurrency) {
            // Add all pending promises.
            while ($this->addPending() && $this->advanceIterator()) {
            }

            return;
        }

        // Add only up to N pending promises.
        $concurrency = is_callable($this->concurrency)
            ? ($this->concurrency)(count($this->pending))
            : $this->concurrency;
        $concurrency = max($concurrency - count($this->pending), 0);
        // Concurrency may be set to 0 to disallow new promises.
        if (!$concurrency) {
            return;
        }
        // Add the first pending promise.
        $this->addPending();
        // Note this is special handling for concurrency=1 so that we do
        // not advance the iterator after adding the first promise. This
        // helps work around issues with generators that might not have the
        // next value to yield until promise callbacks are called.
        while (--$concurrency
            && $this->advanceIterator()
            && $this->addPending()) {
        }
    }

    private function addPending(): bool
    {
        if (!$this->iterable || !$this->iterable->valid()) {
            return false;
        }

        $promise = promise_for($this->iterable->current());
        $idx = $this->iterable->key();

        $this->pending[$idx] = $promise->then(
<<<<<<< Updated upstream
            function ($value) use ($idx) {
                if ($this->onFulfilled) {
                    call_user_func(
                        $this->onFulfilled, $value, $idx, $this->aggregate
=======
            function ($value) use ($idx, $key): void {
                if ($this->onFulfilled) {
                    ($this->onFulfilled)(
                        $value,
                        $key,
                        $this->aggregate
>>>>>>> Stashed changes
                    );
                }
                $this->step($idx);
            },
<<<<<<< Updated upstream
            function ($reason) use ($idx) {
                if ($this->onRejected) {
                    call_user_func(
                        $this->onRejected, $reason, $idx, $this->aggregate
=======
            function ($reason) use ($idx, $key): void {
                if ($this->onRejected) {
                    ($this->onRejected)(
                        $reason,
                        $key,
                        $this->aggregate
>>>>>>> Stashed changes
                    );
                }
                $this->step($idx);
            }
        );

        return true;
    }

    private function advanceIterator(): bool
    {
        // Place a lock on the iterator so that we ensure to not recurse,
        // preventing fatal generator errors.
        if ($this->mutex) {
            return false;
        }

        $this->mutex = true;

        try {
            $this->iterable->next();
            $this->mutex = false;

            return true;
        } catch (\Throwable $e) {
            $this->aggregate->reject($e);
            $this->mutex = false;

            return false;
        }
    }

    private function step(int $idx): void
    {
        // If the promise was already resolved, then ignore this step.
        if ($this->aggregate->getState() !== PromiseInterface::PENDING) {
            return;
        }

        unset($this->pending[$idx]);

        // Only refill pending promises if we are not locked, preventing the
        // EachPromise to recursively invoke the provided iterator, which
        // cause a fatal error: "Cannot resume an already running generator"
        if ($this->advanceIterator() && !$this->checkIfFinished()) {
            // Add more pending promises if possible.
            $this->refillPending();
        }
    }

    private function checkIfFinished(): bool
    {
        if (!$this->pending && !$this->iterable->valid()) {
            // Resolve the promise if there's nothing left to do.
            $this->aggregate->resolve(null);

            return true;
        }

        return false;
    }
}
