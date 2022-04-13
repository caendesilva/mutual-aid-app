<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheVersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache the version';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Caching version');
        $this->line('');
        $tag = \App\Core\Services\VersionService::gitVersion();
        $this->line('Found the following tag: ' . $tag);

        if ($this->confirm('Is this the correct version?', true)) {
            $this->setCache($tag);
        } else {
            $this->setCache($this->ask('Please enter the correct version:'));
        }
        
        return 0;
    }

    private function setCache($tag)
    {
        Cache::put('version', $tag);

        $this->info('Cached version: ' . $tag);
    }
}
