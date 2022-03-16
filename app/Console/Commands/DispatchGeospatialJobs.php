<?php

namespace App\Console\Commands;

use App\Jobs\UpdateListingsGeospatialIndexEntry;
use App\Models\Listing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DispatchGeospatialJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gsi:dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch Jobs to run geospatial indexing for all models without an entry.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Dispatching jobs to run geospatial indexing for listings');
        // Get all the listings that do not have a geospatial record
        $listings = DB::table('listings')->whereNotIn('id', function($query){
            $query->select('id')->from('geospatial_index')->where('for', 'listing');
        })->select('id')->get();

        if ($listings->count() < 1) {
            $this->warn('No records found!');
            return 1;
        }

        $this->line('Found ' . $listings->count() . ' listings without a geospatial record').

        $this->newLine(1);

        $this->withProgressBar($listings, function ($listing) {
            try {
                UpdateListingsGeospatialIndexEntry::dispatch(Listing::findOrFail($listing->id));
            } catch (\Throwable $th) {
                //throw $th;
            }
        });

        $this->newLine(2);

        $this->info('All done.');

        return 0;
    }
}
