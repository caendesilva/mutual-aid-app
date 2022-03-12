<?php

namespace App\Core;

use DB;
use App\Models\User;
use App\Models\Listing;
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

    /**
     * Get a collection of models sorted by their relative distance
     * 
     * @param string $for The model to base results on (the search origin)
     *                  Currently only the User model is supported as the location
     *                  attribute is not yet set up.
     * @param string $find Class constant of the model type to search for
     * @param int $limitResults maximum amount of results to return
     * @param int $limitDistance the maximum distance in kilometers
     * 
     * @return [type]
     */
    public static function getGeospatialRecordCollection(User|Listing $for, string $find = Listing::class, int $limitResults  = 36, int $limitDistance = 10000)
    {
        if (!$for instanceof \App\Models\User) {
            throw new \Exception('Currently only User origins are supported.', 1);
        }

        $latitude = (float) $for->position['latitude'];
        $longitude = (float) $for->position['longitude'];

        return DB::table('geospatial_index')
            ->selectRaw(
                '
                *, 
                    (
                    6371 * acos(
                        cos(
                        radians(?)
                        ) * cos(
                        radians(latitude)
                        ) * cos(
                        radians(longitude) - radians(?)
                        ) + sin(
                        radians(?)
                        ) * sin(
                        radians(latitude)
                        )
                    )
                    ) AS `distance`
            ',
                [$latitude, $longitude, $latitude]
            )
            ->orderBy('distance')
            ->limit($limitResults)
            ->having('distance', '<=', $limitDistance)
            ->get();
    }
}
