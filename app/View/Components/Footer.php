<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    protected string $deployment_name;
    protected array $git_info;

    public string $name;
    public string $version;

    public function __construct()
    {
        $this->deployment_name = config('app.deployment_name', 'production');

        $this->git_info = [
            'branch' => \App\Core\Services\VersionService::gitBranch(),
            'version' => \App\Core\Services\VersionService::gitVersion(),
            'commit' => \App\Core\Services\VersionService::gitCommit(),
            'diff' => \App\Core\Services\VersionService::gitDiff(),
        ];

        if ($this->deployment_name === 'local' || $this->deployment_name === 'canary') {
            $this->name = 'United States Mutual Aid App - ' . ucwords($this->deployment_name) . ' Deployment';
            $this->version = $this->git_info['version'] . '-' . $this->git_info['commit'] . ' - ' . $this->git_info['diff'];
        } else {
            $this->name = 'United States Mutual Aid App';
            $this->version = app('git.version');
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
