<?php
<<<<<<< Updated upstream
=======

declare(strict_types=1);

>>>>>>> Stashed changes
namespace GuzzleHttp\Promise;

/**
 * Interface used with classes that return a promise.
 */
interface PromisorInterface
{
    /**
     * Returns a promise.
     */
    public function promise(): PromiseInterface;
}
