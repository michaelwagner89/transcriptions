<?php

namespace Laracasts\Transcriptions;

use Traversable;

class Lines extends Collection  {

    public function asHtml():string {
        $formattedLines = array_map(static fn(Line $line) => $line->toAnchorTag(), $this->items);

        return (new static($formattedLines))->__toString();
    }

    public function __toString(): string {
        return implode("\n", $this->items);
    }
}