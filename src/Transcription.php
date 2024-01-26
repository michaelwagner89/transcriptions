<?php

namespace Laracasts\Transcriptions;

class Transcription {

    protected array $lines;

    public function __construct(array $lines) {
        $this->lines = self::discardInvalidLines(array_map('trim', $lines));
    }

    public static function load(string $path): self {
        return new static(file($path));
    }

    /**
     * @return Line[]
     */
    public function lines(): array {
        $lines = [];
        $count = count($this->lines);

        for($i=0; $i < $count; $i+=2) {
            $lines[] = new Line($this->lines[$i], $this->lines[$i + 1]);
        }

        return $lines;
    }

    public function __toString(): string {
        return implode('', $this->lines);
    }

    private static function discardInvalidLines(array $lines): array {
        return array_values(array_filter($lines, static fn($line) => Line::valid($line)));
    }

    public function htmlLines():string {
        $htmlLines = array_map(static fn(Line $line) => $line->toAnchorTag(), $this->lines());

        return implode("\n", $htmlLines);
    }
}