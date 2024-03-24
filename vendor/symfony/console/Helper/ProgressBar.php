<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Terminal;

/**
 * The ProgressBar provides helpers to display progress output.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Chris Jones <leeked@gmail.com>
 */
final class ProgressBar
{
<<<<<<< Updated upstream
    private $barWidth = 28;
    private $barChar;
    private $emptyBarChar = '-';
    private $progressChar = '>';
    private $format;
    private $internalFormat;
    private $redrawFreq = 1;
    private $output;
    private $step = 0;
    private $max;
    private $startTime;
    private $stepWidth;
    private $percent = 0.0;
    private $formatLineCount;
    private $messages = [];
    private $overwrite = true;
    private $terminal;
    private $firstRun = true;

    private static $formatters;
    private static $formats;
=======
    public const FORMAT_VERBOSE = 'verbose';
    public const FORMAT_VERY_VERBOSE = 'very_verbose';
    public const FORMAT_DEBUG = 'debug';
    public const FORMAT_NORMAL = 'normal';

    private const FORMAT_VERBOSE_NOMAX = 'verbose_nomax';
    private const FORMAT_VERY_VERBOSE_NOMAX = 'very_verbose_nomax';
    private const FORMAT_DEBUG_NOMAX = 'debug_nomax';
    private const FORMAT_NORMAL_NOMAX = 'normal_nomax';

    private int $barWidth = 28;
    private string $barChar;
    private string $emptyBarChar = '-';
    private string $progressChar = '>';
    private ?string $format = null;
    private ?string $internalFormat = null;
    private ?int $redrawFreq = 1;
    private int $writeCount = 0;
    private float $lastWriteTime = 0;
    private float $minSecondsBetweenRedraws = 0;
    private float $maxSecondsBetweenRedraws = 1;
    private OutputInterface $output;
    private int $step = 0;
    private int $startingStep = 0;
    private ?int $max = null;
    private int $startTime;
    private int $stepWidth;
    private float $percent = 0.0;
    private array $messages = [];
    private bool $overwrite = true;
    private Terminal $terminal;
    private ?string $previousMessage = null;
    private Cursor $cursor;
    private array $placeholders = [];

    private static array $formatters;
    private static array $formats;
>>>>>>> Stashed changes

    /**
     * @param OutputInterface $output An OutputInterface instance
     * @param int             $max    Maximum steps (0 if unknown)
     */
<<<<<<< Updated upstream
    public function __construct(OutputInterface $output, $max = 0)
=======
    public function __construct(OutputInterface $output, int $max = 0, float $minSecondsBetweenRedraws = 1 / 25)
>>>>>>> Stashed changes
    {
        if ($output instanceof ConsoleOutputInterface) {
            $output = $output->getErrorOutput();
        }

        $this->output = $output;
        $this->setMaxSteps($max);
        $this->terminal = new Terminal();

        if (!$this->output->isDecorated()) {
            // disable overwrite when output does not support ANSI codes.
            $this->overwrite = false;

            // set a reasonable redraw frequency so output isn't flooded
            $this->setRedrawFrequency($max / 10);
        }

        $this->startTime = time();
        $this->cursor = new Cursor($output);
    }

    /**
     * Sets a placeholder formatter for a given name, globally for all instances of ProgressBar.
     *
     * This method also allow you to override an existing placeholder.
     *
     * @param string                       $name     The placeholder name (including the delimiter char like %)
     * @param callable(ProgressBar):string $callable A PHP callable
     */
    public static function setPlaceholderFormatterDefinition($name, callable $callable)
    {
        self::$formatters ??= self::initPlaceholderFormatters();

        self::$formatters[$name] = $callable;
    }

    /**
     * Gets the placeholder formatter for a given name.
     *
     * @param string $name The placeholder name (including the delimiter char like %)
     */
    public static function getPlaceholderFormatterDefinition($name)
    {
        self::$formatters ??= self::initPlaceholderFormatters();

        return isset(self::$formatters[$name]) ? self::$formatters[$name] : null;
    }

    /**
     * Sets a placeholder formatter for a given name, for this instance only.
     *
     * @param callable(ProgressBar):string $callable A PHP callable
     */
    public function setPlaceholderFormatter(string $name, callable $callable): void
    {
        $this->placeholders[$name] = $callable;
    }

    /**
     * Gets the placeholder formatter for a given name.
     *
     * @param string $name The placeholder name (including the delimiter char like %)
     */
    public function getPlaceholderFormatter(string $name): ?callable
    {
        return $this->placeholders[$name] ?? $this::getPlaceholderFormatterDefinition($name);
    }

    /**
     * Sets a format for a given name.
     *
     * This method also allow you to override an existing format.
     *
     * @param string $name   The format name
     * @param string $format A format string
     */
    public static function setFormatDefinition($name, $format)
    {
        self::$formats ??= self::initFormats();

        self::$formats[$name] = $format;
    }

    /**
     * Gets the format for a given name.
     *
     * @param string $name The format name
     */
    public static function getFormatDefinition($name)
    {
        self::$formats ??= self::initFormats();

        return isset(self::$formats[$name]) ? self::$formats[$name] : null;
    }

    /**
     * Associates a text with a named placeholder.
     *
     * The text is displayed when the progress bar is rendered but only
     * when the corresponding placeholder is part of the custom format line
     * (by wrapping the name with %).
     *
     * @param string $message The text to associate with the placeholder
     * @param string $name    The name of the placeholder
     */
<<<<<<< Updated upstream
    public function setMessage($message, $name = 'message')
=======
    public function setMessage(string $message, string $name = 'message'): void
>>>>>>> Stashed changes
    {
        $this->messages[$name] = $message;
    }

<<<<<<< Updated upstream
    public function getMessage($name = 'message')
=======
    public function getMessage(string $name = 'message'): string
>>>>>>> Stashed changes
    {
        return $this->messages[$name];
    }

    /**
     * Gets the progress bar start time.
     *
     * @return int The progress bar start time
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Gets the progress bar maximal steps.
     *
     * @return int The progress bar max steps
     */
    public function getMaxSteps()
    {
        return $this->max;
    }

    /**
     * Gets the current step position.
     *
     * @return int The progress bar step
     */
    public function getProgress()
    {
        return $this->step;
    }

    /**
     * Gets the progress bar step width.
     *
     * @return int The progress bar step width
     */
    private function getStepWidth()
    {
        return $this->stepWidth;
    }

    /**
     * Gets the current progress bar percent.
     *
     * @return float The current progress bar percent
     */
    public function getProgressPercent()
    {
        return $this->percent;
    }

<<<<<<< Updated upstream
    /**
     * Sets the progress bar width.
     *
     * @param int $size The progress bar size
     */
    public function setBarWidth($size)
=======
    public function getBarOffset(): float
    {
        return floor($this->max ? $this->percent * $this->barWidth : (null === $this->redrawFreq ? (int) (min(5, $this->barWidth / 15) * $this->writeCount) : $this->step) % $this->barWidth);
    }

    public function getEstimated(): float
    {
        if (0 === $this->step || $this->step === $this->startingStep) {
            return 0;
        }

        return round((time() - $this->startTime) / ($this->step - $this->startingStep) * $this->max);
    }

    public function getRemaining(): float
    {
        if (!$this->step) {
            return 0;
        }

        return round((time() - $this->startTime) / ($this->step - $this->startingStep) * ($this->max - $this->step));
    }

    public function setBarWidth(int $size): void
>>>>>>> Stashed changes
    {
        $this->barWidth = max(1, (int) $size);
    }

    /**
     * Gets the progress bar width.
     *
     * @return int The progress bar size
     */
    public function getBarWidth()
    {
        return $this->barWidth;
    }

<<<<<<< Updated upstream
    /**
     * Sets the bar character.
     *
     * @param string $char A character
     */
    public function setBarCharacter($char)
=======
    public function setBarCharacter(string $char): void
>>>>>>> Stashed changes
    {
        $this->barChar = $char;
    }

    /**
     * Gets the bar character.
     *
     * @return string A character
     */
    public function getBarCharacter()
    {
        return $this->barChar ?? ($this->max ? '=' : $this->emptyBarChar);
    }

<<<<<<< Updated upstream
    /**
     * Sets the empty bar character.
     *
     * @param string $char A character
     */
    public function setEmptyBarCharacter($char)
=======
    public function setEmptyBarCharacter(string $char): void
>>>>>>> Stashed changes
    {
        $this->emptyBarChar = $char;
    }

    /**
     * Gets the empty bar character.
     *
     * @return string A character
     */
    public function getEmptyBarCharacter()
    {
        return $this->emptyBarChar;
    }

<<<<<<< Updated upstream
    /**
     * Sets the progress bar character.
     *
     * @param string $char A character
     */
    public function setProgressCharacter($char)
=======
    public function setProgressCharacter(string $char): void
>>>>>>> Stashed changes
    {
        $this->progressChar = $char;
    }

    /**
     * Gets the progress bar character.
     *
     * @return string A character
     */
    public function getProgressCharacter()
    {
        return $this->progressChar;
    }

<<<<<<< Updated upstream
=======
    public function setFormat(string $format): void
    {
        $this->format = null;
        $this->internalFormat = $format;
    }

>>>>>>> Stashed changes
    /**
     * Sets the progress bar format.
     *
     * @param string $format The format
     */
<<<<<<< Updated upstream
    public function setFormat($format)
=======
    public function setRedrawFrequency(?int $freq): void
>>>>>>> Stashed changes
    {
        $this->format = null;
        $this->internalFormat = $format;
    }

    /**
     * Sets the redraw frequency.
     *
<<<<<<< Updated upstream
     * @param int|float $freq The frequency in steps
     */
    public function setRedrawFrequency($freq)
=======
     * @template TKey
     * @template TValue
     *
     * @param iterable<TKey, TValue> $iterable
     * @param int|null               $max      Number of steps to complete the bar (0 if indeterminate), if null it will be inferred from $iterable
     *
     * @return iterable<TKey, TValue>
     */
    public function iterate(iterable $iterable, ?int $max = null): iterable
>>>>>>> Stashed changes
    {
        $this->redrawFreq = max((int) $freq, 1);
    }

    /**
     * Starts the progress output.
     *
     * @param int|null $max     Number of steps to complete the bar (0 if indeterminate), null to leave unchanged
     * @param int      $startAt The starting point of the bar (useful e.g. when resuming a previously started bar)
     */
<<<<<<< Updated upstream
    public function start($max = null)
=======
    public function start(?int $max = null, int $startAt = 0): void
>>>>>>> Stashed changes
    {
        $this->startTime = time();
        $this->step = $startAt;
        $this->startingStep = $startAt;

        $startAt > 0 ? $this->setProgress($startAt) : $this->percent = 0.0;

        if (null !== $max) {
            $this->setMaxSteps($max);
        }

        $this->display();
    }

    /**
     * Advances the progress output X steps.
     *
     * @param int $step Number of steps to advance
     */
<<<<<<< Updated upstream
    public function advance($step = 1)
=======
    public function advance(int $step = 1): void
>>>>>>> Stashed changes
    {
        $this->setProgress($this->step + $step);
    }

    /**
     * Sets whether to overwrite the progressbar, false for new line.
     *
     * @param bool $overwrite
     */
<<<<<<< Updated upstream
    public function setOverwrite($overwrite)
=======
    public function setOverwrite(bool $overwrite): void
>>>>>>> Stashed changes
    {
        $this->overwrite = (bool) $overwrite;
    }

<<<<<<< Updated upstream
    /**
     * Sets the current progress.
     *
     * @param int $step The current progress
     */
    public function setProgress($step)
=======
    public function setProgress(int $step): void
>>>>>>> Stashed changes
    {
        $step = (int) $step;

        if ($this->max && $step > $this->max) {
            $this->max = $step;
        } elseif ($step < 0) {
            $step = 0;
        }

        $prevPeriod = (int) ($this->step / $this->redrawFreq);
        $currPeriod = (int) ($step / $this->redrawFreq);
        $this->step = $step;
        $this->percent = $this->max ? (float) $this->step / $this->max : 0;
        if ($prevPeriod !== $currPeriod || $this->max === $step) {
            $this->display();
        }
    }

<<<<<<< Updated upstream
=======
    public function setMaxSteps(int $max): void
    {
        $this->format = null;
        $this->max = max(0, $max);
        $this->stepWidth = $this->max ? Helper::width((string) $this->max) : 4;
    }

>>>>>>> Stashed changes
    /**
     * Finishes the progress output.
     */
    public function finish()
    {
        if (!$this->max) {
            $this->max = $this->step;
        }

        if ($this->step === $this->max && !$this->overwrite) {
            // prevent double 100% output
            return;
        }

        $this->setProgress($this->max);
    }

    /**
     * Outputs the current progress string.
     */
    public function display()
    {
        if (OutputInterface::VERBOSITY_QUIET === $this->output->getVerbosity()) {
            return;
        }

        if (null === $this->format) {
            $this->setRealFormat($this->internalFormat ?: $this->determineBestFormat());
        }

        $this->overwrite($this->buildLine());
    }

    /**
     * Removes the progress bar from the current line.
     *
     * This is useful if you wish to write some output
     * while a progress bar is running.
     * Call display() to show the progress bar again.
     */
    public function clear()
    {
        if (!$this->overwrite) {
            return;
        }

        if (null === $this->format) {
            $this->setRealFormat($this->internalFormat ?: $this->determineBestFormat());
        }

        $this->overwrite('');
    }

<<<<<<< Updated upstream
    /**
     * Sets the progress bar format.
     *
     * @param string $format The format
     */
    private function setRealFormat($format)
=======
    private function setRealFormat(string $format): void
>>>>>>> Stashed changes
    {
        // try to use the _nomax variant if available
        if (!$this->max && null !== self::getFormatDefinition($format.'_nomax')) {
            $this->format = self::getFormatDefinition($format.'_nomax');
        } elseif (null !== self::getFormatDefinition($format)) {
            $this->format = self::getFormatDefinition($format);
        } else {
            $this->format = $format;
        }
    }

    /**
     * Sets the progress bar maximal steps.
     *
     * @param int $max The progress bar max steps
     */
    private function setMaxSteps($max)
    {
        $this->max = max(0, (int) $max);
        $this->stepWidth = $this->max ? Helper::strlen($this->max) : 4;
    }

    /**
     * Overwrites a previous message to the output.
     *
     * @param string $message The message
     */
    private function overwrite($message)
    {
        if ($this->overwrite) {
<<<<<<< Updated upstream
            if (!$this->firstRun) {
                // Erase previous lines
                if ($this->formatLineCount > 0) {
                    $message = str_repeat("\x1B[1A\x1B[2K", $this->formatLineCount).$message;
=======
            if (null !== $this->previousMessage) {
                if ($this->output instanceof ConsoleSectionOutput) {
                    $messageLines = explode("\n", $this->previousMessage);
                    $lineCount = \count($messageLines);
                    foreach ($messageLines as $messageLine) {
                        $messageLineLength = Helper::width(Helper::removeDecoration($this->output->getFormatter(), $messageLine));
                        if ($messageLineLength > $this->terminal->getWidth()) {
                            $lineCount += floor($messageLineLength / $this->terminal->getWidth());
                        }
                    }
                    $this->output->clear($lineCount);
                } else {
                    $lineCount = substr_count($this->previousMessage, "\n");
                    for ($i = 0; $i < $lineCount; ++$i) {
                        $this->cursor->moveToColumn(1);
                        $this->cursor->clearLine();
                        $this->cursor->moveUp();
                    }

                    $this->cursor->moveToColumn(1);
                    $this->cursor->clearLine();
>>>>>>> Stashed changes
                }

                // Move the cursor to the beginning of the line and erase the line
                $message = "\x0D\x1B[2K$message";
            }
        } elseif ($this->step > 0) {
            $message = PHP_EOL.$message;
        }

        $this->firstRun = false;

        $this->output->write($message);
    }

    private function determineBestFormat()
    {
        return match ($this->output->getVerbosity()) {
            // OutputInterface::VERBOSITY_QUIET: display is disabled anyway
            OutputInterface::VERBOSITY_VERBOSE => $this->max ? self::FORMAT_VERBOSE : self::FORMAT_VERBOSE_NOMAX,
            OutputInterface::VERBOSITY_VERY_VERBOSE => $this->max ? self::FORMAT_VERY_VERBOSE : self::FORMAT_VERY_VERBOSE_NOMAX,
            OutputInterface::VERBOSITY_DEBUG => $this->max ? self::FORMAT_DEBUG : self::FORMAT_DEBUG_NOMAX,
            default => $this->max ? self::FORMAT_NORMAL : self::FORMAT_NORMAL_NOMAX,
        };
    }

    private static function initPlaceholderFormatters()
    {
        return [
            'bar' => function (self $bar, OutputInterface $output) {
                $completeBars = floor($bar->getMaxSteps() > 0 ? $bar->getProgressPercent() * $bar->getBarWidth() : $bar->getProgress() % $bar->getBarWidth());
                $display = str_repeat($bar->getBarCharacter(), $completeBars);
                if ($completeBars < $bar->getBarWidth()) {
                    $emptyBars = $bar->getBarWidth() - $completeBars - Helper::length(Helper::removeDecoration($output->getFormatter(), $bar->getProgressCharacter()));
                    $display .= $bar->getProgressCharacter().str_repeat($bar->getEmptyBarCharacter(), $emptyBars);
                }

                return $display;
            },
            'elapsed' => fn (self $bar) => Helper::formatTime(time() - $bar->getStartTime(), 2),
            'remaining' => function (self $bar) {
                if (!$bar->getMaxSteps()) {
                    throw new LogicException('Unable to display the remaining time if the maximum number of steps is not set.');
                }

                return Helper::formatTime($bar->getRemaining(), 2);
            },
            'estimated' => function (self $bar) {
                if (!$bar->getMaxSteps()) {
                    throw new LogicException('Unable to display the estimated time if the maximum number of steps is not set.');
                }

<<<<<<< Updated upstream
                if (!$bar->getProgress()) {
                    $estimated = 0;
                } else {
                    $estimated = round((time() - $bar->getStartTime()) / $bar->getProgress() * $bar->getMaxSteps());
                }

                return Helper::formatTime($estimated);
            },
            'memory' => function (self $bar) {
                return Helper::formatMemory(memory_get_usage(true));
            },
            'current' => function (self $bar) {
                return str_pad($bar->getProgress(), $bar->getStepWidth(), ' ', STR_PAD_LEFT);
            },
            'max' => function (self $bar) {
                return $bar->getMaxSteps();
            },
            'percent' => function (self $bar) {
                return floor($bar->getProgressPercent() * 100);
=======
                return Helper::formatTime($bar->getEstimated(), 2);
>>>>>>> Stashed changes
            },
            'memory' => fn (self $bar) => Helper::formatMemory(memory_get_usage(true)),
            'current' => fn (self $bar) => str_pad($bar->getProgress(), $bar->getStepWidth(), ' ', \STR_PAD_LEFT),
            'max' => fn (self $bar) => $bar->getMaxSteps(),
            'percent' => fn (self $bar) => floor($bar->getProgressPercent() * 100),
        ];
    }

    private static function initFormats()
    {
        return [
            self::FORMAT_NORMAL => ' %current%/%max% [%bar%] %percent:3s%%',
            self::FORMAT_NORMAL_NOMAX => ' %current% [%bar%]',

            self::FORMAT_VERBOSE => ' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%',
            self::FORMAT_VERBOSE_NOMAX => ' %current% [%bar%] %elapsed:6s%',

            self::FORMAT_VERY_VERBOSE => ' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s%',
            self::FORMAT_VERY_VERBOSE_NOMAX => ' %current% [%bar%] %elapsed:6s%',

            self::FORMAT_DEBUG => ' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%',
            self::FORMAT_DEBUG_NOMAX => ' %current% [%bar%] %elapsed:6s% %memory:6s%',
        ];
    }

    /**
     * @return string
     */
    private function buildLine()
    {
        \assert(null !== $this->format);

        $regex = "{%([a-z\-_]+)(?:\:([^%]+))?%}i";
        $callback = function ($matches) {
<<<<<<< Updated upstream
            if ($formatter = $this::getPlaceholderFormatterDefinition($matches[1])) {
                $text = \call_user_func($formatter, $this, $this->output);
=======
            if ($formatter = $this->getPlaceholderFormatter($matches[1])) {
                $text = $formatter($this, $this->output);
>>>>>>> Stashed changes
            } elseif (isset($this->messages[$matches[1]])) {
                $text = $this->messages[$matches[1]];
            } else {
                return $matches[0];
            }

            if (isset($matches[2])) {
                $text = sprintf('%'.$matches[2], $text);
            }

            return $text;
        };
        $line = preg_replace_callback($regex, $callback, $this->format);

        // gets string length for each sub line with multiline format
        $linesLength = array_map(fn ($subLine) => Helper::width(Helper::removeDecoration($this->output->getFormatter(), rtrim($subLine, "\r"))), explode("\n", $line));

        $linesWidth = max($linesLength);

        $terminalWidth = $this->terminal->getWidth();
        if ($linesWidth <= $terminalWidth) {
            return $line;
        }

        $this->setBarWidth($this->barWidth - $linesWidth + $terminalWidth);

        return preg_replace_callback($regex, $callback, $this->format);
    }
}
