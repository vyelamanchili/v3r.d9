<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Yaml\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\CI\GithubActionReporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Completion\CompletionInput;
use Symfony\Component\Console\Completion\CompletionSuggestions;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Yaml;

/**
 * Validates YAML files syntax and outputs encountered errors.
 *
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 * @author Robin Chalas <robin.chalas@gmail.com>
 */
#[AsCommand(name: 'lint:yaml', description: 'Lint a YAML file and outputs encountered errors')]
class LintCommand extends Command
{
    private Parser $parser;
    private ?string $format = null;
    private bool $displayCorrectFiles;
    private ?\Closure $directoryIteratorProvider;
    private ?\Closure $isReadableProvider;

<<<<<<< Updated upstream
    private $parser;
    private $format;
    private $displayCorrectFiles;
    private $directoryIteratorProvider;
    private $isReadableProvider;

    public function __construct($name = null, $directoryIteratorProvider = null, $isReadableProvider = null)
=======
    public function __construct(?string $name = null, ?callable $directoryIteratorProvider = null, ?callable $isReadableProvider = null)
>>>>>>> Stashed changes
    {
        parent::__construct($name);

        $this->directoryIteratorProvider = null === $directoryIteratorProvider ? null : $directoryIteratorProvider(...);
        $this->isReadableProvider = null === $isReadableProvider ? null : $isReadableProvider(...);
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this
<<<<<<< Updated upstream
            ->setDescription('Lints a file and outputs encountered errors')
            ->addArgument('filename', null, 'A file or a directory or STDIN')
            ->addOption('format', null, InputOption::VALUE_REQUIRED, 'The output format', 'txt')
            ->addOption('parse-tags', null, InputOption::VALUE_NONE, 'Parse custom tags')
=======
            ->addArgument('filename', InputArgument::IS_ARRAY, 'A file, a directory or "-" for reading from STDIN')
            ->addOption('format', null, InputOption::VALUE_REQUIRED, sprintf('The output format ("%s")', implode('", "', $this->getAvailableFormatOptions())))
            ->addOption('exclude', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Path(s) to exclude')
            ->addOption('parse-tags', null, InputOption::VALUE_NEGATABLE, 'Parse custom tags', null)
>>>>>>> Stashed changes
            ->setHelp(<<<EOF
The <info>%command.name%</info> command lints a YAML file and outputs to STDOUT
the first encountered syntax error.

You can validates YAML contents passed from STDIN:

  <info>cat filename | php %command.full_name%</info>

You can also validate the syntax of a file:

  <info>php %command.full_name% filename</info>

Or of a whole directory:

  <info>php %command.full_name% dirname</info>
  <info>php %command.full_name% dirname --format=json</info>

You can also exclude one or more specific files:

  <info>php %command.full_name% dirname --exclude="dirname/foo.yaml" --exclude="dirname/bar.yaml"</info>

EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
<<<<<<< Updated upstream
        $filename = $input->getArgument('filename');
=======
        $filenames = (array) $input->getArgument('filename');
        $excludes = $input->getOption('exclude');
>>>>>>> Stashed changes
        $this->format = $input->getOption('format');
        $flags = $input->getOption('parse-tags');

        if (null === $this->format) {
            // Autodetect format according to CI environment
            $this->format = class_exists(GithubActionReporter::class) && GithubActionReporter::isGithubActionEnvironment() ? 'github' : 'txt';
        }

        $flags = $flags ? Yaml::PARSE_CUSTOM_TAGS : 0;

        $this->displayCorrectFiles = $output->isVerbose();

<<<<<<< Updated upstream
        if (!$filename) {
            if (!$stdin = $this->getStdin()) {
                throw new RuntimeException('Please provide a filename or pipe file content to STDIN.');
            }

            return $this->display($io, [$this->validate($stdin, $flags)]);
=======
        if (['-'] === $filenames) {
            return $this->display($io, [$this->validate(file_get_contents('php://stdin'), $flags)]);
        }

        if (!$filenames) {
            throw new RuntimeException('Please provide a filename or pipe file content to STDIN.');
>>>>>>> Stashed changes
        }

        if (!$this->isReadable($filename)) {
            throw new RuntimeException(sprintf('File or directory "%s" is not readable.', $filename));
        }

<<<<<<< Updated upstream
        $filesInfo = [];
        foreach ($this->getFiles($filename) as $file) {
            $filesInfo[] = $this->validate(file_get_contents($file), $flags, $file);
=======
            foreach ($this->getFiles($filename) as $file) {
                if (!\in_array($file->getPathname(), $excludes, true)) {
                    $filesInfo[] = $this->validate(file_get_contents($file), $flags, $file);
                }
            }
>>>>>>> Stashed changes
        }

        return $this->display($io, $filesInfo);
    }

<<<<<<< Updated upstream
    private function validate($content, $flags, $file = null)
=======
    private function validate(string $content, int $flags, ?string $file = null): array
>>>>>>> Stashed changes
    {
        $prevErrorHandler = set_error_handler(function ($level, $message, $file, $line) use (&$prevErrorHandler) {
            if (E_USER_DEPRECATED === $level) {
                throw new ParseException($message, $this->getParser()->getRealCurrentLineNb() + 1);
            }

            return $prevErrorHandler ? $prevErrorHandler($level, $message, $file, $line) : false;
        });

        try {
            $this->getParser()->parse($content, Yaml::PARSE_CONSTANT | $flags);
        } catch (ParseException $e) {
            return ['file' => $file, 'line' => $e->getParsedLine(), 'valid' => false, 'message' => $e->getMessage()];
        } finally {
            restore_error_handler();
        }

        return ['file' => $file, 'valid' => true];
    }

    private function display(SymfonyStyle $io, array $files)
    {
        return match ($this->format) {
            'txt' => $this->displayTxt($io, $files),
            'json' => $this->displayJson($io, $files),
            'github' => $this->displayTxt($io, $files, true),
            default => throw new InvalidArgumentException(sprintf('Supported formats are "%s".', implode('", "', $this->getAvailableFormatOptions()))),
        };
    }

<<<<<<< Updated upstream
    private function displayTxt(SymfonyStyle $io, array $filesInfo)
=======
    private function displayTxt(SymfonyStyle $io, array $filesInfo, bool $errorAsGithubAnnotations = false): int
>>>>>>> Stashed changes
    {
        $countFiles = \count($filesInfo);
        $erroredFiles = 0;

        if ($errorAsGithubAnnotations) {
            $githubReporter = new GithubActionReporter($io);
        }

        foreach ($filesInfo as $info) {
            if ($info['valid'] && $this->displayCorrectFiles) {
                $io->comment('<info>OK</info>'.($info['file'] ? sprintf(' in %s', $info['file']) : ''));
            } elseif (!$info['valid']) {
                ++$erroredFiles;
                $io->text('<error> ERROR </error>'.($info['file'] ? sprintf(' in %s', $info['file']) : ''));
                $io->text(sprintf('<error> >> %s</error>', $info['message']));
<<<<<<< Updated upstream
=======

                if (str_contains($info['message'], 'PARSE_CUSTOM_TAGS')) {
                    $suggestTagOption = true;
                }

                if ($errorAsGithubAnnotations) {
                    $githubReporter->error($info['message'], $info['file'] ?? 'php://stdin', $info['line']);
                }
>>>>>>> Stashed changes
            }
        }

        if (0 === $erroredFiles) {
            $io->success(sprintf('All %d YAML files contain valid syntax.', $countFiles));
        } else {
            $io->warning(sprintf('%d YAML files have valid syntax and %d contain errors.', $countFiles - $erroredFiles, $erroredFiles));
        }

        return min($erroredFiles, 1);
    }

    private function displayJson(SymfonyStyle $io, array $filesInfo)
    {
        $errors = 0;

        array_walk($filesInfo, function (&$v) use (&$errors) {
            $v['file'] = (string) $v['file'];
            if (!$v['valid']) {
                ++$errors;
            }
<<<<<<< Updated upstream
=======

            if (isset($v['message']) && str_contains($v['message'], 'PARSE_CUSTOM_TAGS')) {
                $v['message'] .= ' Use the --parse-tags option if you want parse custom tags.';
            }
>>>>>>> Stashed changes
        });

        $io->writeln(json_encode($filesInfo, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return min($errors, 1);
    }

    private function getFiles($fileOrDirectory)
    {
        if (is_file($fileOrDirectory)) {
            yield new \SplFileInfo($fileOrDirectory);

            return;
        }

        foreach ($this->getDirectoryIterator($fileOrDirectory) as $file) {
            if (!\in_array($file->getExtension(), ['yml', 'yaml'])) {
                continue;
            }

            yield $file;
        }
    }

    /**
     * @return string|null
     */
    private function getStdin()
    {
        if (0 !== ftell(STDIN)) {
            return null;
        }

        $inputs = '';
        while (!feof(STDIN)) {
            $inputs .= fread(STDIN, 1024);
        }

        return $inputs;
    }

    private function getParser()
    {
        return $this->parser ??= new Parser();
    }

    private function getDirectoryIterator($directory)
    {
        $default = fn ($directory) => new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::FOLLOW_SYMLINKS),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        if (null !== $this->directoryIteratorProvider) {
            return \call_user_func($this->directoryIteratorProvider, $directory, $default);
        }

        return $default($directory);
    }

    private function isReadable($fileOrDirectory)
    {
        $default = is_readable(...);

        if (null !== $this->isReadableProvider) {
            return \call_user_func($this->isReadableProvider, $fileOrDirectory, $default);
        }

        return $default($fileOrDirectory);
    }

    public function complete(CompletionInput $input, CompletionSuggestions $suggestions): void
    {
        if ($input->mustSuggestOptionValuesFor('format')) {
            $suggestions->suggestValues($this->getAvailableFormatOptions());
        }
    }

    private function getAvailableFormatOptions(): array
    {
        return ['txt', 'json', 'github'];
    }
}
