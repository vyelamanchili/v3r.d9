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

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Provides helpers to display a table.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Саша Стаменковић <umpirsky@gmail.com>
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 * @author Max Grigorian <maxakawizard@gmail.com>
 */
class Table
{
<<<<<<< Updated upstream
    /**
     * Table headers.
     */
    private $headers = [];

    /**
     * Table rows.
     */
    private $rows = [];

    /**
     * Column widths cache.
     */
    private $effectiveColumnWidths = [];

    /**
     * Number of columns cache.
     *
     * @var int
     */
    private $numberOfColumns;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var TableStyle
     */
    private $style;

    /**
     * @var array
     */
    private $columnStyles = [];

    /**
     * User set column widths.
     *
     * @var array
     */
    private $columnWidths = [];

    private static $styles;
=======
    private const SEPARATOR_TOP = 0;
    private const SEPARATOR_TOP_BOTTOM = 1;
    private const SEPARATOR_MID = 2;
    private const SEPARATOR_BOTTOM = 3;
    private const BORDER_OUTSIDE = 0;
    private const BORDER_INSIDE = 1;
    private const DISPLAY_ORIENTATION_DEFAULT = 'default';
    private const DISPLAY_ORIENTATION_HORIZONTAL = 'horizontal';
    private const DISPLAY_ORIENTATION_VERTICAL = 'vertical';

    private ?string $headerTitle = null;
    private ?string $footerTitle = null;
    private array $headers = [];
    private array $rows = [];
    private array $effectiveColumnWidths = [];
    private int $numberOfColumns;
    private OutputInterface $output;
    private TableStyle $style;
    private array $columnStyles = [];
    private array $columnWidths = [];
    private array $columnMaxWidths = [];
    private bool $rendered = false;
    private string $displayOrientation = self::DISPLAY_ORIENTATION_DEFAULT;

    private static array $styles;
>>>>>>> Stashed changes

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;

        self::$styles ??= self::initStyles();

        $this->setStyle('default');
    }

    /**
     * Sets a style definition.
     *
<<<<<<< Updated upstream
     * @param string     $name  The style name
     * @param TableStyle $style A TableStyle instance
=======
     * @return void
>>>>>>> Stashed changes
     */
    public static function setStyleDefinition(string $name, TableStyle $style)
    {
        self::$styles ??= self::initStyles();

        self::$styles[$name] = $style;
    }

    /**
     * Gets a style definition by name.
     */
    public static function getStyleDefinition(string $name): TableStyle
    {
        self::$styles ??= self::initStyles();

        return self::$styles[$name] ?? throw new InvalidArgumentException(sprintf('Style "%s" is not defined.', $name));
    }

    /**
     * Sets table style.
     *
     * @return $this
     */
    public function setStyle(TableStyle|string $name): static
    {
        $this->style = $this->resolveStyle($name);

        return $this;
    }

    /**
     * Gets the current table style.
     */
    public function getStyle(): TableStyle
    {
        return $this->style;
    }

    /**
     * Sets table column style.
     *
     * @param TableStyle|string $name The style name or a TableStyle instance
     *
     * @return $this
     */
    public function setColumnStyle(int $columnIndex, TableStyle|string $name): static
    {
        $this->columnStyles[$columnIndex] = $this->resolveStyle($name);

        return $this;
    }

    /**
     * Gets the current style for a column.
     *
     * If style was not set, it returns the global table style.
     */
    public function getColumnStyle(int $columnIndex): TableStyle
    {
        if (isset($this->columnStyles[$columnIndex])) {
            return $this->columnStyles[$columnIndex];
        }

        return $this->getStyle();
    }

    /**
     * Sets the minimum width of a column.
     *
     * @return $this
     */
    public function setColumnWidth(int $columnIndex, int $width): static
    {
        $this->columnWidths[$columnIndex] = $width;

        return $this;
    }

    /**
     * Sets the minimum width of all columns.
     *
     * @return $this
     */
    public function setColumnWidths(array $widths): static
    {
        $this->columnWidths = [];
        foreach ($widths as $index => $width) {
            $this->setColumnWidth($index, $width);
        }

        return $this;
    }

<<<<<<< Updated upstream
    public function setHeaders(array $headers)
=======
    /**
     * Sets the maximum width of a column.
     *
     * Any cell within this column which contents exceeds the specified width will be wrapped into multiple lines, while
     * formatted strings are preserved.
     *
     * @return $this
     */
    public function setColumnMaxWidth(int $columnIndex, int $width): static
    {
        if (!$this->output->getFormatter() instanceof WrappableOutputFormatterInterface) {
            throw new \LogicException(sprintf('Setting a maximum column width is only supported when using a "%s" formatter, got "%s".', WrappableOutputFormatterInterface::class, get_debug_type($this->output->getFormatter())));
        }

        $this->columnMaxWidths[$columnIndex] = $width;

        return $this;
    }

    /**
     * @return $this
     */
    public function setHeaders(array $headers): static
>>>>>>> Stashed changes
    {
        $headers = array_values($headers);
        if ($headers && !\is_array($headers[0])) {
            $headers = [$headers];
        }

        $this->headers = $headers;

        return $this;
    }

    /**
     * @return $this
     */
    public function setRows(array $rows)
    {
        $this->rows = [];

        return $this->addRows($rows);
    }

    /**
     * @return $this
     */
    public function addRows(array $rows): static
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function addRow(TableSeparator|array $row): static
    {
        if ($row instanceof TableSeparator) {
            $this->rows[] = $row;

            return $this;
        }

        $this->rows[] = array_values($row);

        return $this;
    }

<<<<<<< Updated upstream
    public function setRow($column, array $row)
=======
    /**
     * Adds a row to the table, and re-renders the table.
     *
     * @return $this
     */
    public function appendRow(TableSeparator|array $row): static
    {
        if (!$this->output instanceof ConsoleSectionOutput) {
            throw new RuntimeException(sprintf('Output should be an instance of "%s" when calling "%s".', ConsoleSectionOutput::class, __METHOD__));
        }

        if ($this->rendered) {
            $this->output->clear($this->calculateRowCount());
        }

        $this->addRow($row);
        $this->render();

        return $this;
    }

    /**
     * @return $this
     */
    public function setRow(int|string $column, array $row): static
>>>>>>> Stashed changes
    {
        $this->rows[$column] = $row;

        return $this;
    }

<<<<<<< Updated upstream
=======
    /**
     * @return $this
     */
    public function setHeaderTitle(?string $title): static
    {
        $this->headerTitle = $title;

        return $this;
    }

    /**
     * @return $this
     */
    public function setFooterTitle(?string $title): static
    {
        $this->footerTitle = $title;

        return $this;
    }

    /**
     * @return $this
     */
    public function setHorizontal(bool $horizontal = true): static
    {
        $this->displayOrientation = $horizontal ? self::DISPLAY_ORIENTATION_HORIZONTAL : self::DISPLAY_ORIENTATION_DEFAULT;

        return $this;
    }

    /**
     * @return $this
     */
    public function setVertical(bool $vertical = true): static
    {
        $this->displayOrientation = $vertical ? self::DISPLAY_ORIENTATION_VERTICAL : self::DISPLAY_ORIENTATION_DEFAULT;

        return $this;
    }

>>>>>>> Stashed changes
    /**
     * Renders table to output.
     *
     * Example:
     *
     *     +---------------+-----------------------+------------------+
     *     | ISBN          | Title                 | Author           |
     *     +---------------+-----------------------+------------------+
     *     | 99921-58-10-7 | Divine Comedy         | Dante Alighieri  |
     *     | 9971-5-0210-0 | A Tale of Two Cities  | Charles Dickens  |
     *     | 960-425-059-0 | The Lord of the Rings | J. R. R. Tolkien |
     *     +---------------+-----------------------+------------------+
     *
     * @return void
     */
    public function render()
    {
<<<<<<< Updated upstream
        $this->calculateNumberOfColumns();
        $rows = $this->buildTableRows($this->rows);
        $headers = $this->buildTableRows($this->headers);
=======
        $divider = new TableSeparator();
        $isCellWithColspan = static fn ($cell) => $cell instanceof TableCell && $cell->getColspan() >= 2;

        $horizontal = self::DISPLAY_ORIENTATION_HORIZONTAL === $this->displayOrientation;
        $vertical = self::DISPLAY_ORIENTATION_VERTICAL === $this->displayOrientation;

        $rows = [];
        if ($horizontal) {
            foreach ($this->headers[0] ?? [] as $i => $header) {
                $rows[$i] = [$header];
                foreach ($this->rows as $row) {
                    if ($row instanceof TableSeparator) {
                        continue;
                    }
                    if (isset($row[$i])) {
                        $rows[$i][] = $row[$i];
                    } elseif ($isCellWithColspan($rows[$i][0])) {
                        // Noop, there is a "title"
                    } else {
                        $rows[$i][] = null;
                    }
                }
            }
        } elseif ($vertical) {
            $formatter = $this->output->getFormatter();
            $maxHeaderLength = array_reduce($this->headers[0] ?? [], static fn ($max, $header) => max($max, Helper::width(Helper::removeDecoration($formatter, $header))), 0);

            foreach ($this->rows as $row) {
                if ($row instanceof TableSeparator) {
                    continue;
                }

                if ($rows) {
                    $rows[] = [$divider];
                }

                $containsColspan = false;
                foreach ($row as $cell) {
                    if ($containsColspan = $isCellWithColspan($cell)) {
                        break;
                    }
                }

                $headers = $this->headers[0] ?? [];
                $maxRows = max(\count($headers), \count($row));
                for ($i = 0; $i < $maxRows; ++$i) {
                    $cell = (string) ($row[$i] ?? '');

                    $eol = str_contains($cell, "\r\n") ? "\r\n" : "\n";
                    $parts = explode($eol, $cell);
                    foreach ($parts as $idx => $part) {
                        if ($headers && !$containsColspan) {
                            if (0 === $idx) {
                                $rows[] = [sprintf(
                                    '<comment>%s</>: %s',
                                    str_pad($headers[$i] ?? '', $maxHeaderLength, ' ', \STR_PAD_LEFT),
                                    $part
                                )];
                            } else {
                                $rows[] = [sprintf(
                                    '%s  %s',
                                    str_pad('', $maxHeaderLength, ' ', \STR_PAD_LEFT),
                                    $part
                                )];
                            }
                        } elseif ('' !== $cell) {
                            $rows[] = [$part];
                        }
                    }
                }
            }
        } else {
            $rows = array_merge($this->headers, [$divider], $this->rows);
        }

        $this->calculateNumberOfColumns($rows);
>>>>>>> Stashed changes

        $this->calculateColumnsWidth(array_merge($headers, $rows));

<<<<<<< Updated upstream
        $this->renderRowSeparator();
        if (!empty($headers)) {
            foreach ($headers as $header) {
                $this->renderRow($header, $this->style->getCellHeaderFormat());
                $this->renderRowSeparator();
=======
        $isHeader = !$horizontal;
        $isFirstRow = $horizontal;
        $hasTitle = (bool) $this->headerTitle;

        foreach ($rowGroups as $rowGroup) {
            $isHeaderSeparatorRendered = false;

            foreach ($rowGroup as $row) {
                if ($divider === $row) {
                    $isHeader = false;
                    $isFirstRow = true;

                    continue;
                }

                if ($row instanceof TableSeparator) {
                    $this->renderRowSeparator();

                    continue;
                }

                if (!$row) {
                    continue;
                }

                if ($isHeader && !$isHeaderSeparatorRendered) {
                    $this->renderRowSeparator(
                        self::SEPARATOR_TOP,
                        $hasTitle ? $this->headerTitle : null,
                        $hasTitle ? $this->style->getHeaderTitleFormat() : null
                    );
                    $hasTitle = false;
                    $isHeaderSeparatorRendered = true;
                }

                if ($isFirstRow) {
                    $this->renderRowSeparator(
                        $horizontal ? self::SEPARATOR_TOP : self::SEPARATOR_TOP_BOTTOM,
                        $hasTitle ? $this->headerTitle : null,
                        $hasTitle ? $this->style->getHeaderTitleFormat() : null
                    );
                    $isFirstRow = false;
                    $hasTitle = false;
                }

                if ($vertical) {
                    $isHeader = false;
                    $isFirstRow = false;
                }

                if ($horizontal) {
                    $this->renderRow($row, $this->style->getCellRowFormat(), $this->style->getCellHeaderFormat());
                } else {
                    $this->renderRow($row, $isHeader ? $this->style->getCellHeaderFormat() : $this->style->getCellRowFormat());
                }
>>>>>>> Stashed changes
            }
        }
        foreach ($rows as $row) {
            if ($row instanceof TableSeparator) {
                $this->renderRowSeparator();
            } else {
                $this->renderRow($row, $this->style->getCellRowFormat());
            }
        }
        if (!empty($rows)) {
            $this->renderRowSeparator();
        }

        $this->cleanup();
    }

    /**
     * Renders horizontal header separator.
     *
     * Example:
     *
     *     +-----+-----------+-------+
     */
<<<<<<< Updated upstream
    private function renderRowSeparator()
=======
    private function renderRowSeparator(int $type = self::SEPARATOR_MID, ?string $title = null, ?string $titleFormat = null): void
>>>>>>> Stashed changes
    {
        if (!$count = $this->numberOfColumns) {
            return;
        }

        if (!$this->style->getHorizontalBorderChar() && !$this->style->getCrossingChar()) {
            return;
        }

        $markup = $this->style->getCrossingChar();
        for ($column = 0; $column < $count; ++$column) {
<<<<<<< Updated upstream
            $markup .= str_repeat($this->style->getHorizontalBorderChar(), $this->effectiveColumnWidths[$column]).$this->style->getCrossingChar();
=======
            $markup .= str_repeat($horizontal, $this->effectiveColumnWidths[$column]);
            $markup .= $column === $count - 1 ? $rightChar : $midChar;
        }

        if (null !== $title) {
            $titleLength = Helper::width(Helper::removeDecoration($formatter = $this->output->getFormatter(), $formattedTitle = sprintf($titleFormat, $title)));
            $markupLength = Helper::width($markup);
            if ($titleLength > $limit = $markupLength - 4) {
                $titleLength = $limit;
                $formatLength = Helper::width(Helper::removeDecoration($formatter, sprintf($titleFormat, '')));
                $formattedTitle = sprintf($titleFormat, Helper::substr($title, 0, $limit - $formatLength - 3).'...');
            }

            $titleStart = intdiv($markupLength - $titleLength, 2);
            if (false === mb_detect_encoding($markup, null, true)) {
                $markup = substr_replace($markup, $formattedTitle, $titleStart, $titleLength);
            } else {
                $markup = mb_substr($markup, 0, $titleStart).$formattedTitle.mb_substr($markup, $titleStart + $titleLength);
            }
>>>>>>> Stashed changes
        }

        $this->output->writeln(sprintf($this->style->getBorderFormat(), $markup));
    }

    /**
     * Renders vertical column separator.
     */
    private function renderColumnSeparator()
    {
        return sprintf($this->style->getBorderFormat(), $this->style->getVerticalBorderChar());
    }

    /**
     * Renders table row.
     *
     * Example:
     *
     *     | 9971-5-0210-0 | A Tale of Two Cities  | Charles Dickens  |
     *
     * @param string $cellFormat
     */
<<<<<<< Updated upstream
    private function renderRow(array $row, $cellFormat)
    {
        if (empty($row)) {
            return;
        }

        $rowContent = $this->renderColumnSeparator();
        foreach ($this->getRowColumns($row) as $column) {
            $rowContent .= $this->renderCell($row, $column, $cellFormat);
            $rowContent .= $this->renderColumnSeparator();
=======
    private function renderRow(array $row, string $cellFormat, ?string $firstCellFormat = null): void
    {
        $rowContent = $this->renderColumnSeparator(self::BORDER_OUTSIDE);
        $columns = $this->getRowColumns($row);
        $last = \count($columns) - 1;
        foreach ($columns as $i => $column) {
            if ($firstCellFormat && 0 === $i) {
                $rowContent .= $this->renderCell($row, $column, $firstCellFormat);
            } else {
                $rowContent .= $this->renderCell($row, $column, $cellFormat);
            }
            $rowContent .= $this->renderColumnSeparator($last === $i ? self::BORDER_OUTSIDE : self::BORDER_INSIDE);
>>>>>>> Stashed changes
        }
        $this->output->writeln($rowContent);
    }

    /**
     * Renders table cell with padding.
     *
     * @param int    $column
     * @param string $cellFormat
     */
    private function renderCell(array $row, $column, $cellFormat)
    {
        $cell = isset($row[$column]) ? $row[$column] : '';
        $width = $this->effectiveColumnWidths[$column];
        if ($cell instanceof TableCell && $cell->getColspan() > 1) {
            // add the width of the following columns(numbers of colspan).
            foreach (range($column + 1, $column + $cell->getColspan() - 1) as $nextColumn) {
                $width += $this->getColumnSeparatorWidth() + $this->effectiveColumnWidths[$nextColumn];
            }
        }

        // str_pad won't work properly with multi-byte strings, we need to fix the padding
        if (false !== $encoding = mb_detect_encoding($cell, null, true)) {
            $width += \strlen($cell) - mb_strwidth($cell, $encoding);
        }

        $style = $this->getColumnStyle($column);

        if ($cell instanceof TableSeparator) {
            return sprintf($style->getBorderFormat(), str_repeat($style->getHorizontalBorderChar(), $width));
        }

        $width += Helper::length($cell) - Helper::length(Helper::removeDecoration($this->output->getFormatter(), $cell));
        $content = sprintf($style->getCellRowContentFormat(), $cell);

        $padType = $style->getPadType();
        if ($cell instanceof TableCell && $cell->getStyle() instanceof TableCellStyle) {
            $isNotStyledByTag = !preg_match('/^<(\w+|(\w+=[\w,]+;?)*)>.+<\/(\w+|(\w+=\w+;?)*)?>$/', $cell);
            if ($isNotStyledByTag) {
                $cellFormat = $cell->getStyle()->getCellFormat();
                if (!\is_string($cellFormat)) {
                    $tag = http_build_query($cell->getStyle()->getTagOptions(), '', ';');
                    $cellFormat = '<'.$tag.'>%s</>';
                }

                if (str_contains($content, '</>')) {
                    $content = str_replace('</>', '', $content);
                    $width -= 3;
                }
                if (str_contains($content, '<fg=default;bg=default>')) {
                    $content = str_replace('<fg=default;bg=default>', '', $content);
                    $width -= \strlen('<fg=default;bg=default>');
                }
            }

            $padType = $cell->getStyle()->getPadByAlign();
        }

        return sprintf($cellFormat, str_pad($content, $width, $style->getPaddingChar(), $padType));
    }

    /**
     * Calculate number of columns for this table.
     */
<<<<<<< Updated upstream
    private function calculateNumberOfColumns()
=======
    private function calculateNumberOfColumns(array $rows): void
>>>>>>> Stashed changes
    {
        if (null !== $this->numberOfColumns) {
            return;
        }

        $columns = [0];
        foreach (array_merge($this->headers, $this->rows) as $row) {
            if ($row instanceof TableSeparator) {
                continue;
            }

            $columns[] = $this->getNumberOfColumns($row);
        }

        $this->numberOfColumns = max($columns);
    }

    private function buildTableRows($rows)
    {
        $unmergedRows = [];
        for ($rowKey = 0; $rowKey < \count($rows); ++$rowKey) {
            $rows = $this->fillNextRows($rows, $rowKey);

            // Remove any new line breaks and replace it with a new line
            foreach ($rows[$rowKey] as $column => $cell) {
<<<<<<< Updated upstream
                if (!strstr($cell, "\n")) {
                    continue;
                }
                $lines = explode("\n", str_replace("\n", "<fg=default;bg=default>\n</>", $cell));
=======
                $colspan = $cell instanceof TableCell ? $cell->getColspan() : 1;

                if (isset($this->columnMaxWidths[$column]) && Helper::width(Helper::removeDecoration($formatter, $cell)) > $this->columnMaxWidths[$column]) {
                    $cell = $formatter->formatAndWrap($cell, $this->columnMaxWidths[$column] * $colspan);
                }
                if (!str_contains($cell ?? '', "\n")) {
                    continue;
                }
                $eol = str_contains($cell ?? '', "\r\n") ? "\r\n" : "\n";
                $escaped = implode($eol, array_map(OutputFormatter::escapeTrailingBackslash(...), explode($eol, $cell)));
                $cell = $cell instanceof TableCell ? new TableCell($escaped, ['colspan' => $cell->getColspan()]) : $escaped;
                $lines = explode($eol, str_replace($eol, '<fg=default;bg=default></>'.$eol, $cell));
>>>>>>> Stashed changes
                foreach ($lines as $lineKey => $line) {
                    if ($cell instanceof TableCell) {
                        $line = new TableCell($line, ['colspan' => $cell->getColspan()]);
                    }
                    if (0 === $lineKey) {
                        $rows[$rowKey][$column] = $line;
                    } else {
                        $unmergedRows[$rowKey][$lineKey][$column] = $line;
                    }
                }
            }
        }

        $tableRows = [];
        foreach ($rows as $rowKey => $row) {
            $tableRows[] = $this->fillCells($row);
            if (isset($unmergedRows[$rowKey])) {
                $tableRows = array_merge($tableRows, $unmergedRows[$rowKey]);
            }
        }

<<<<<<< Updated upstream
        return $tableRows;
=======
        if ($this->rows) {
            ++$numberOfRows; // Add row for footer separator
        }

        return $numberOfRows;
>>>>>>> Stashed changes
    }

    /**
     * fill rows that contains rowspan > 1.
     *
     * @param int $line
     *
     * @return array
     *
     * @throws InvalidArgumentException
     */
    private function fillNextRows(array $rows, $line)
    {
        $unmergedRows = [];
        foreach ($rows[$line] as $column => $cell) {
<<<<<<< Updated upstream
            if (null !== $cell && !$cell instanceof TableCell && !is_scalar($cell) && !(\is_object($cell) && method_exists($cell, '__toString'))) {
                throw new InvalidArgumentException(sprintf('A cell must be a TableCell, a scalar or an object implementing "__toString()", "%s" given.', \gettype($cell)));
=======
            if (null !== $cell && !$cell instanceof TableCell && !\is_scalar($cell) && !$cell instanceof \Stringable) {
                throw new InvalidArgumentException(sprintf('A cell must be a TableCell, a scalar or an object implementing "__toString()", "%s" given.', get_debug_type($cell)));
>>>>>>> Stashed changes
            }
            if ($cell instanceof TableCell && $cell->getRowspan() > 1) {
                $nbLines = $cell->getRowspan() - 1;
                $lines = [$cell];
                if (str_contains($cell, "\n")) {
                    $eol = str_contains($cell, "\r\n") ? "\r\n" : "\n";
                    $lines = explode($eol, str_replace($eol, '<fg=default;bg=default>'.$eol.'</>', $cell));
                    $nbLines = \count($lines) > $nbLines ? substr_count($cell, $eol) : $nbLines;

                    $rows[$line][$column] = new TableCell($lines[0], ['colspan' => $cell->getColspan(), 'style' => $cell->getStyle()]);
                    unset($lines[0]);
                }

                // create a two dimensional array (rowspan x colspan)
                $unmergedRows = array_replace_recursive(array_fill($line + 1, $nbLines, []), $unmergedRows);
                foreach ($unmergedRows as $unmergedRowKey => $unmergedRow) {
<<<<<<< Updated upstream
                    $value = isset($lines[$unmergedRowKey - $line]) ? $lines[$unmergedRowKey - $line] : '';
                    $unmergedRows[$unmergedRowKey][$column] = new TableCell($value, ['colspan' => $cell->getColspan()]);
=======
                    $value = $lines[$unmergedRowKey - $line] ?? '';
                    $unmergedRows[$unmergedRowKey][$column] = new TableCell($value, ['colspan' => $cell->getColspan(), 'style' => $cell->getStyle()]);
>>>>>>> Stashed changes
                    if ($nbLines === $unmergedRowKey - $line) {
                        break;
                    }
                }
            }
        }

        foreach ($unmergedRows as $unmergedRowKey => $unmergedRow) {
            // we need to know if $unmergedRow will be merged or inserted into $rows
            if (isset($rows[$unmergedRowKey]) && \is_array($rows[$unmergedRowKey]) && ($this->getNumberOfColumns($rows[$unmergedRowKey]) + $this->getNumberOfColumns($unmergedRows[$unmergedRowKey]) <= $this->numberOfColumns)) {
                foreach ($unmergedRow as $cellKey => $cell) {
                    // insert cell into row at cellKey position
                    array_splice($rows[$unmergedRowKey], $cellKey, 0, [$cell]);
                }
            } else {
                $row = $this->copyRow($rows, $unmergedRowKey - 1);
                foreach ($unmergedRow as $column => $cell) {
                    if (!empty($cell)) {
                        $row[$column] = $unmergedRow[$column];
                    }
                }
                array_splice($rows, $unmergedRowKey, 0, [$row]);
            }
        }

        return $rows;
    }

    /**
     * fill cells for a row that contains colspan > 1.
     *
     * @return array
     */
<<<<<<< Updated upstream
    private function fillCells($row)
=======
    private function fillCells(iterable $row): iterable
>>>>>>> Stashed changes
    {
        $newRow = [];
        foreach ($row as $column => $cell) {
            $newRow[] = $cell;
            if ($cell instanceof TableCell && $cell->getColspan() > 1) {
                foreach (range($column + 1, $column + $cell->getColspan() - 1) as $position) {
                    // insert empty value at column position
                    $newRow[] = '';
                }
            }
        }

        return $newRow ?: $row;
    }

    /**
     * @param int $line
     *
     * @return array
     */
    private function copyRow(array $rows, $line)
    {
        $row = $rows[$line];
        foreach ($row as $cellKey => $cellValue) {
            $row[$cellKey] = '';
            if ($cellValue instanceof TableCell) {
                $row[$cellKey] = new TableCell('', ['colspan' => $cellValue->getColspan()]);
            }
        }

        return $row;
    }

    /**
     * Gets number of columns by row.
     *
     * @return int
     */
    private function getNumberOfColumns(array $row)
    {
        $columns = \count($row);
        foreach ($row as $column) {
            $columns += $column instanceof TableCell ? ($column->getColspan() - 1) : 0;
        }

        return $columns;
    }

    /**
     * Gets list of columns for the given row.
     *
     * @return array
     */
    private function getRowColumns(array $row)
    {
        $columns = range(0, $this->numberOfColumns - 1);
        foreach ($row as $cellKey => $cell) {
            if ($cell instanceof TableCell && $cell->getColspan() > 1) {
                // exclude grouped columns.
                $columns = array_diff($columns, range($cellKey + 1, $cellKey + $cell->getColspan() - 1));
            }
        }

        return $columns;
    }

    /**
     * Calculates columns widths.
     */
<<<<<<< Updated upstream
    private function calculateColumnsWidth(array $rows)
=======
    private function calculateColumnsWidth(iterable $groups): void
>>>>>>> Stashed changes
    {
        for ($column = 0; $column < $this->numberOfColumns; ++$column) {
            $lengths = [];
            foreach ($rows as $row) {
                if ($row instanceof TableSeparator) {
                    continue;
                }

<<<<<<< Updated upstream
                foreach ($row as $i => $cell) {
                    if ($cell instanceof TableCell) {
                        $textContent = Helper::removeDecoration($this->output->getFormatter(), $cell);
                        $textLength = Helper::strlen($textContent);
                        if ($textLength > 0) {
                            $contentColumns = str_split($textContent, ceil($textLength / $cell->getColspan()));
                            foreach ($contentColumns as $position => $content) {
                                $row[$i + $position] = $content;
=======
                    foreach ($row as $i => $cell) {
                        if ($cell instanceof TableCell) {
                            $textContent = Helper::removeDecoration($this->output->getFormatter(), $cell);
                            $textLength = Helper::width($textContent);
                            if ($textLength > 0) {
                                $contentColumns = mb_str_split($textContent, ceil($textLength / $cell->getColspan()));
                                foreach ($contentColumns as $position => $content) {
                                    $row[$i + $position] = $content;
                                }
>>>>>>> Stashed changes
                            }
                        }
                    }
                }

                $lengths[] = $this->getCellWidth($row, $column);
            }

            $this->effectiveColumnWidths[$column] = max($lengths) + Helper::width($this->style->getCellRowContentFormat()) - 2;
        }
    }

    /**
     * Gets column width.
     *
     * @return int
     */
    private function getColumnSeparatorWidth()
    {
<<<<<<< Updated upstream
        return Helper::strlen(sprintf($this->style->getBorderFormat(), $this->style->getVerticalBorderChar()));
=======
        return Helper::width(sprintf($this->style->getBorderFormat(), $this->style->getBorderChars()[3]));
>>>>>>> Stashed changes
    }

    /**
     * Gets cell width.
     *
     * @param int $column
     *
     * @return int
     */
    private function getCellWidth(array $row, $column)
    {
        $cellWidth = 0;

        if (isset($row[$column])) {
            $cell = $row[$column];
            $cellWidth = Helper::width(Helper::removeDecoration($this->output->getFormatter(), $cell));
        }

        $columnWidth = isset($this->columnWidths[$column]) ? $this->columnWidths[$column] : 0;

        return max($cellWidth, $columnWidth);
    }

    /**
     * Called after rendering to cleanup cache data.
     */
    private function cleanup(): void
    {
        $this->effectiveColumnWidths = [];
        unset($this->numberOfColumns);
    }

<<<<<<< Updated upstream
    private static function initStyles()
=======
    /**
     * @return array<string, TableStyle>
     */
    private static function initStyles(): array
>>>>>>> Stashed changes
    {
        $borderless = new TableStyle();
        $borderless
            ->setHorizontalBorderChar('=')
            ->setVerticalBorderChar(' ')
            ->setCrossingChar(' ')
        ;

        $compact = new TableStyle();
        $compact
            ->setHorizontalBorderChar('')
            ->setVerticalBorderChar(' ')
            ->setCrossingChar('')
            ->setCellRowContentFormat('%s')
        ;

        $styleGuide = new TableStyle();
        $styleGuide
            ->setHorizontalBorderChar('-')
            ->setVerticalBorderChar(' ')
            ->setCrossingChar(' ')
            ->setCellHeaderFormat('%s')
        ;

        return [
            'default' => new TableStyle(),
            'borderless' => $borderless,
            'compact' => $compact,
            'symfony-style-guide' => $styleGuide,
        ];
    }

<<<<<<< Updated upstream
    private function resolveStyle($name)
=======
    private function resolveStyle(TableStyle|string $name): TableStyle
>>>>>>> Stashed changes
    {
        if ($name instanceof TableStyle) {
            return $name;
        }

        return self::$styles[$name] ?? throw new InvalidArgumentException(sprintf('Style "%s" is not defined.', $name));
    }
}
