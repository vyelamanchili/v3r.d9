<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console;

use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\Console\Event\ConsoleSignalEvent;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;

/**
 * Contains all events dispatched by an Application.
 *
 * @author Francesco Levorato <git@flevour.net>
 */
final class ConsoleEvents
{
    /**
     * The COMMAND event allows you to attach listeners before any command is
     * executed by the console. It also allows you to modify the command, input and output
     * before they are handled to the command.
     *
     * @Event("Symfony\Component\Console\Event\ConsoleCommandEvent")
     */
    const COMMAND = 'console.command';

    /**
     * The SIGNAL event allows you to perform some actions
     * after the command execution was interrupted.
     *
     * @Event("Symfony\Component\Console\Event\ConsoleSignalEvent")
     */
    public const SIGNAL = 'console.signal';

    /**
     * The TERMINATE event allows you to attach listeners after a command is
     * executed by the console.
     *
     * @Event("Symfony\Component\Console\Event\ConsoleTerminateEvent")
     */
    const TERMINATE = 'console.terminate';

    /**
     * The EXCEPTION event occurs when an uncaught exception appears
     * while executing Command#run().
     *
     * This event allows you to deal with the exception or
     * to modify the thrown exception.
     *
     * @Event("Symfony\Component\Console\Event\ConsoleExceptionEvent")
     *
     * @deprecated The console.exception event is deprecated since version 3.3 and will be removed in 4.0. Use the console.error event instead.
     */
    const EXCEPTION = 'console.exception';

    /**
     * The ERROR event occurs when an uncaught exception or error appears.
     *
     * This event allows you to deal with the exception/error or
     * to modify the thrown exception.
     *
     * @Event("Symfony\Component\Console\Event\ConsoleErrorEvent")
     */
<<<<<<< Updated upstream
    const ERROR = 'console.error';
=======
    public const ERROR = 'console.error';

    /**
     * Event aliases.
     *
     * These aliases can be consumed by RegisterListenersPass.
     */
    public const ALIASES = [
        ConsoleCommandEvent::class => self::COMMAND,
        ConsoleErrorEvent::class => self::ERROR,
        ConsoleSignalEvent::class => self::SIGNAL,
        ConsoleTerminateEvent::class => self::TERMINATE,
    ];
>>>>>>> Stashed changes
}
