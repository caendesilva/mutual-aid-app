<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Throwable;

class Footer extends Component
{
    public string $gitStatus = "";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->gitStatus = $this->getGitStatus();
    }

    /**
     * Get the branch status
     * @return string
     */
    private function getGitStatus(): string
    {
        $anchorStartTag = '<a href="https://github.com/caendesilva/mutual-aid-app" class="text-indigo-700">';
        try {
            $status = shell_exec('git status -bs --porcelain');

            if (!str_contains($status, '[')) {
                // @todo add branch check as it returns Master for all branches
                return "Up to date with {$anchorStartTag}Origin/Master</a>.";
            }

            $status = substr($status, 0, strpos($status, ']') + 1);

            $status = str_replace('## ', '', $status);

            $status = explode('...', $status);

            $branch = ucfirst($status[0]);

            $status = explode(' [', $status[1]);
            $status[1] = rtrim($status[1], ']');

            $originBranch = ucwords($status[0], '/');

            $diff = explode(' ', $status[1]);
            $diffVerb = $diff[0];
            $diffCount = $diff[1];

            $commits = $diffCount <= 1 ? 'commit' : 'commits';

            return "On branch $branch. $diffCount $commits $diffVerb $anchorStartTag $originBranch</a>.";
        } catch (Throwable) {
            return "";
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.footer');
    }
}
