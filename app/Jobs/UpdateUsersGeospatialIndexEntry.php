<?php

namespace App\Jobs;

use App\Core\LocationService;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

/**
 * Set or update the user's GPS coordinates in the Geospatial Index.
 * Gets called when the user's location is updated.
 */
class UpdateUsersGeospatialIndexEntry
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // If the user has set a location use that for the search, else use the area code
        $search = !empty($this->user->location) ? $this->user->location : $this->user->area;

        // Try to find the position from the search
        $coordinates = LocationService::findPositionFromSearch($search);

        // Update the user's location entry
        DB::table('geospatial_index')
            ->updateOrInsert(['for' => 'user', 'model_id' => $this->user->id], [
                    'latitude' => round($coordinates['latitude'], 5),
                    'longitude' => round($coordinates['longitude'], 5)
                ]);
    }
}
