<?php

namespace Tests;

use Laracasts\Transcriptions\Line;
use Laracasts\Transcriptions\Transcription;
use PHPUnit\Framework\TestCase;

class TranscriptionTest extends TestCase {


    /** @test */
    public function it_loads_a_vtt_file_as_a_string(): void {

        $path = __DIR__ .'/stubs/basic-example.vtt';
        $transcription = Transcription::load($path);

        $this->assertStringContainsString('00:00:03.210 --> 00:00:04.110', $transcription);
        $this->assertStringContainsString('example of a VTT file.', $transcription);
    }

    /** @test */
    public function it_can_convert_to_an_array_of_lines_objects() {
        $path = __DIR__ .'/stubs/basic-example.vtt';
        $transcription = Transcription::load($path);
        $lines = $transcription->lines();
        $this->assertCount(2, $lines);
        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_the_vtt_file(): void {
        $path = __DIR__ .'/stubs/basic-example.vtt';
        $transcription = Transcription::load($path);

        $this->assertStringNotContainsString('WEBVTT', $transcription);
        $this->assertCount(2, $transcription->lines());
    }

    /** @test */
    public function it_render_the_lines_to_html() {
        $path = __DIR__ .'/stubs/basic-example.vtt';
        $transcription = Transcription::load($path);

        $expected = <<<EOT
<a href="?time=00:03">Here is a</a>
<a href="?time=00:04">example of a VTT file.</a>
EOT;

        $this->assertEquals($expected, $transcription->htmlLines());

    }
}