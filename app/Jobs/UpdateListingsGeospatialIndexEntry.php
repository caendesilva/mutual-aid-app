<?php

namespace App\Jobs;

use App\Core\LocationService;
use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

/**
 * Set or update the listing's GPS coordinates in the Geospatial Index.
 * Gets called when the listing's location is updated.
 */
class UpdateListingsGeospatialIndexEntry
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Listing $listing;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Try to find the position from the search
        $coordinates = LocationService::findPositionFromSearch($this->listing->location);

		// @todo if coordinates can't be found, add metadata to mark it as invalid to not run again

        // Update the listing's location entry
        DB::table('geospatial_index')
            ->updateOrInsert(['for' => 'listing', 'model_id' => $this->listing->id], [
                    'latitude' => round($coordinates['latitude'], 5),
                    'longitude' => round($coordinates['longitude'], 5)
                ]);
    }
}
