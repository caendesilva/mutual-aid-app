<?php

namespace App\Core;

use Exception;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

/**
 *  Render a Markdown section to HTML
 */
class MarkdownSection
{
    /**
     * @throws Exception if the file does not exist
     */
    public static function parse(string $markdownPath): string
    {
        $file = Jetstream::localizedMarkdownPath('content/' . $markdownPath . '.md');
        if (!file_exists($file)) {
            throw new Exception("File '$markdownPath' not found!");
        }
        return '<div class="prose">' . Str::markdown(file_get_contents($file)) . '</div>';
    }
}
