<?php

namespace Laracasts\Transcriptions;

use Traversable;

class Lines extends Collection  {

    public function asHtml():string {
        return $this->map(static fn(Line $line) => $line->toAnchorTag());
    }

    public function __toString(): string {
        return implode("\n", $this->items);
    }
}