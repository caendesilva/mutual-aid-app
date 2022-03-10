<?php

namespace App\Core;

use App\Models\User;
use DB;
use Kolirt\Openstreetmap\Facade\Openstreetmap as OSM;

/**
 * Contains services regarding locations.
 */
class LocationService
{
    /**
     * Return the latitude and longitude from a search using the OpenStreetMap API.
     * Null safe (in terms of it handling null results gracefully).
     *
     * @param string|null $search
     * @return array $coordinates
     */
    public static function findPositionFromSearch(?string $search = null): array
    {
        if (!isset($search)) {
            return [
                'latitude' => 0,
                'longitude' => 0
            ];
        }

        $result = OSM::search($search, 1);

        return [
            'latitude' => $result[0]->lat ?? 0,
            'longitude' => $result[0]->lon ?? 0
        ];
    }

    /**
     * Retrieves the user's position from the geospatial index.
     * If it is not set, but the user 
     * @return [type]
     */
    public static function getUserPositionFromGeospatialIndex(User $user): array
    {
        $result = DB::table('geospatial_index')
            ->where('for', 'user')
            ->where('model_id', $user->id)
            ->select(['latitude', 'longitude'])
            ->first();

        if (empty($result)) {
            return [
                'latitude' => 0,
                'longitude' => 0
            ];
        }

        return [
            'latitude' => $result->latitude,
            'longitude' => $result->longitude
        ];
    }
}
