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
     * @param string $markdownPath relative path to the Markdown file
     * @param string $classes optionally specify extra classes to add
     * @return string $html
     * @throws Exception if the file does not exist
     */
    public static function parse(string $markdownPath, string $classes = ''): string
    {
        $file = Jetstream::localizedMarkdownPath('content/' . $markdownPath . '.md');
        if (!file_exists($file)) {
            throw new Exception("File '$markdownPath' not found!");
        }
        return sprintf("<div class=\"prose %s\">%s</div>", $classes, Str::markdown(file_get_contents($file)));
    }
}
