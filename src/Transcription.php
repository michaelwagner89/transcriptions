<?php

namespace Laracasts\Transcriptions;

class Transcription {

    protected array $lines;

    public function __construct(array $lines) {
        $this->lines = self::discardInvalidLines($lines);
    }

    public static function load(string $path): self {
        return new static(file($path));
    }


    public function lines(): Lines {

        $lines = array_chunk($this->lines, 3);
        return new Lines(array_map(static fn($line) => new Line(...$line), $lines));
    }

    public function __toString(): string {
        return implode('', $this->lines);
    }

    private static function discardInvalidLines(array $lines): array {
        return array_slice(array_filter(array_map('trim', $lines)), 1);
    }
}