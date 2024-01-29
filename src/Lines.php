<?php

namespace Laracasts\Transcriptions;

use Traversable;

class Lines implements \Countable, \IteratorAggregate {

    public function __construct(protected array $lines) {
    }

    public function asHtml():string {
        $formattedLines = array_map(static fn(Line $line) => $line->toAnchorTag(), $this->lines);

        return (new static($formattedLines))->__toString();
    }

    public function __toString(): string {
        return implode("\n", $this->lines);
    }

    #[\Override] public function count(): int {
        return count($this->lines);
    }

    #[\Override] public function getIterator(): Traversable {
        return new \ArrayIterator($this->lines);
    }
}