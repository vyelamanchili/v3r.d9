<?php
<<<<<<< Updated upstream
=======

declare(strict_types=1);

>>>>>>> Stashed changes
namespace GuzzleHttp\Psr7;

use Psr\Http\Message\StreamInterface;

/**
<<<<<<< Updated upstream
 * Stream decorator that prevents a stream from being seeked
=======
 * Stream decorator that prevents a stream from being seeked.
>>>>>>> Stashed changes
 */
final class NoSeekStream implements StreamInterface
{
    use StreamDecoratorTrait;

    /** @var StreamInterface */
    private $stream;

    public function seek($offset, $whence = SEEK_SET): void
    {
        throw new \RuntimeException('Cannot seek a NoSeekStream');
    }

    public function isSeekable(): bool
    {
        return false;
    }
}
