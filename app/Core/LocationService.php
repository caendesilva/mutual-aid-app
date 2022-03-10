<?php

namespace App\Core;

use Kolirt\Openstreetmap\Facade\Openstreetmap as OSM;

/**
 * Contains services regarding locations.
 */
class LocationService
{
    /**
     * Return the latitude and longitude from a search using the OpenStreetMap API
     *
     * @param string $search
     * @return array $coordinates
     */
    public static function findPositionFromSearch(string $search): array
    {
        $result = OSM::search($search, 1);

        return [
            'latitude' => $result[0]->lat ?? 0,
            'longitude' => $result[0]->lon ?? 0
        ];
    }
}
