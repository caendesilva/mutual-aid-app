<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CanaryBanner extends Component
{
    protected bool $show = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->show = config('app.deployment_name', 'production') === 'canary';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return $this->show ? view('components.canary-banner') : '';
    }
}
