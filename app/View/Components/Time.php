<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

/**
 * Creates a HTML <Time> element from a Carbon instance
 */
class Time extends Component
{
    /**
     * The ISO 8601 date
     * @see https://www.iso.org/iso-8601-date-and-time-format.html
     * @var string
     */
    public string $iso;

    /**
     * The RFC 2822 date.
     * Note that we are not following the RFC completely as we remove the seconds and change the Timezone format from O to e
     * @see https://datatracker.ietf.org/doc/html/rfc2822
     * @var string
     */
    public string $rfc;

    /**
     * The date displayed to the user
     * @var string
     */
    public string $date;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    /**
     * @param Carbon $carbon the Carbon instance
     * @param bool $niceDate should the time be converted to a human friendly date?
     */
    public function __construct(Carbon $carbon, bool $niceDate = false)
    {
        $this->iso = $carbon->format('c');
        $this->rfc = $carbon->format('D, d M Y H:i e'); // Equivalent to 'r' up until the seconds

        $this->date = $carbon->format('Y-m-d H:i');
        
        if ($niceDate) {
            if ($carbon->isToday()) {
                $this->date = 'Today at ' . $carbon->format('g:ia');
            } elseif ($carbon->isYesterday()) {
                $this->date = 'Yesterday at ' . $carbon->format('g:ia');
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.time');
    }
}
