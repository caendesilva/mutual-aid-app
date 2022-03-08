<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

/**
 * A simple component to aid in beta testing by showing system notices,
 * such as information about database resets or todo-lists.
 * 
 * @deprecated as it will be removed in production
 */
class NoticeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return string
     */
    public function __invoke(): string
    {
        if (file_exists(base_path('notices.txt'))) {
            $lines = explode("\n", file_get_contents(base_path('notices.txt')));
            $buffer[] = "<ol>\n";
            foreach ($lines as $line) {
                if (empty($line)) {
                    continue;
                }
                $buffer[] = "<li>$line</li>\n";
            }
            $buffer[] = "</ol>\n";
            return implode("\n", $buffer);
        }
        return '';
    }
}
