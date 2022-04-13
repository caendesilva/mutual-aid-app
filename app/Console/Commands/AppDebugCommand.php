<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppDebugCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Mutual Aid App Debug Screen');
        $this->line('');

        $this->line('App env: ' . env('APP_ENV'));
        $this->line('');

        $this->line('Git Branch: ' . \App\Core\Services\VersionService::gitBranch() . '/' . app('git.branch'));
        $this->line('Git Version: ' . \App\Core\Services\VersionService::gitVersion() . '/' . app('git.version'));
        $this->line('Git Commit: ' . \App\Core\Services\VersionService::gitCommit());
        $this->line('Git Diff: ' . \App\Core\Services\VersionService::gitDiff());
    }
}
